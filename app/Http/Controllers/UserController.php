<?php

namespace App\Http\Controllers;

use App\Device;
use App\DeviceUser;
use App\User;
use App\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
// require_once app_path('Helpers/utils.php');

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $devices = Device::pluck('unique_number', 'id')->toArray();
        return view('users.create', compact('devices'));
    }

    public function store(Request $request)
    {
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->mobile),
            'user_type' => 'client',
            'profile_completed' => false
        ]);

        $user->save();

        if ($request->device_id > 0) {
            $deviceUser = new DeviceUser([
                'device_id' => $request->device_id,
                'user_id' => $user->id,
                'is_active' => true,
                'activation_date' => Date::now("+3:30"),
            ]);

            $deviceUser->save();
        }

        return redirect('admin/users');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $devices = Device::pluck('unique_number','id')->toArray();
        $deviceUser = DeviceUser::where('is_active', 1)->where('user_id', $user->id)->get();
        $device_id = $deviceUser->count() > 0 ? $deviceUser->first()->device_id : null;

        return view('users.edit', compact('user', 'devices', 'device_id'));
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);

        if ($request->device_id > 0) {

            $temp = DeviceUser::where('device_id', $request->device_id)->where('user_id', $user->id);
            if($temp->count() > 0)
                $temp->update(['is_active' => false, 'deactivation_date' => Date::now("+3:30")]);

            $deviceUser = new DeviceUser([
                'device_id' => $request->device_id,
                'user_id' => $user->id,
                'is_active' => true,
                'activation_date' => Date::now("+3:30"),
            ]);

            $deviceUser->save();
        }

        return redirect('admin/users');
    }

    public function destroy(User $user)
    {
        return redirect('admin/users');
    }

    public function history($userId)
    {
        $user = User::find($userId);
        $histories = UserLog::where('user_id', $userId)->orderBy('id', 'desc')->get(['action', 'created_at']);

        return view('users.history', compact('user', 'histories'));
    }

    public function clientLogin(Request $request)
    {
        if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->user_type == 'client') {
                $deviceUser = DeviceUser::where('user_id', '=', $user->id)->first();
                if ($deviceUser) {
                    session(['deviceId' => $deviceUser ? $deviceUser->device_id : 0]);
                    logAction('login', $deviceUser->device_id);
                    return redirect(route('client.home'));
                } else {
                    Auth::logout();
                    return redirect('/')->with('message', 'دستگاه متناظر با این کاربر تعریف نشده است.');
                }
            } else {
                Auth::logout();
                return redirect('/');
            }
        } else {
            return redirect('/')->with('message', 'اطلاعات ورودی نامعتبر است.');
        }
    }

    public function clientChangePassword()
    {
        $user = Auth::user();
        return view('client.changePass', compact('user'));
    }

    public function updatePassword($new, $confirm)
    {
        if ($new == $confirm) {
            $user = Auth::user();
            $user->update([
                'password' => Hash::make($new),
                'profile_completed' => true
            ]);

            logAction('change_password');

            return true;
        } else {
            return false;
        }
    }

    public function clientUpdatePassword(Request $request)
    {
        if ($request->has('oldPsw')) {
            try {
                $user = Auth::user();
                if (Hash::check($request->oldPsw, $user->password)) {
                    if ($this->updatePassword($request->newPassword, $request->confirm_newPassword)) {
                        return redirect(route('client.changePassword'))->with('message', 'رمز عبور با موفقیت تغییر یافت.')->with('type', 'success');
                    } else {
                        return redirect(route('client.changePassword'))->with('message', 'رمز عبور و تکرار آن همخوانی ندارد.')->with('type', 'danger');
                    }
                } else {
                    return redirect(route('client.changePassword'))->with('message', 'رمز عبور فعلی نادرست است.')->with('type', 'danger');
                }
            } catch (\Exception $exception) {
                return redirect(route('client.changePassword'))->with('message', $exception->getMessage())->with('type', 'danger');
            }
        }

        if ($this->updatePassword($request->newPassword, $request->confirm_newPassword)) {
            return redirect(route('client.home'));
        } else {
            return redirect(route('client.completeProfile'))->with('message', 'رمز عبور و تکرار آن همخوانی ندارد.');
        }
    }

    public function changePassword(Request $request)
    {
        if ($request->password == $request->password_confirmation) {
            $user = Auth::user();
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            logAction('change_password');

            return redirect(route('users.profile'))->with('message', 'رمز عبور با موفقیت تغییر یافت')->with('type', 'success');
        } else {
            return redirect(route('users.profile'))->with('message', 'رمز عبور با تکرار آن همخوانی ندارد')->with('type', 'danger');
        }
    }

    public function clientUpdateProfile(Request $request)
    {
        try {
            $this->updateProfileGeneral($request->name, $request->email, $request->mobile);
            return redirect(route('client.changePassword'))->with('message', 'اطلاعات کاربری با موفقیت تغییر یافت.')->with('type', 'success');
        } catch (\Exception $exception) {
            return redirect(route('client.changePassword'))->with('message', $exception->getMessage())->with('type', 'danger');
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function updateProfileGeneral($name, $email, $mobile)
    {
        $user = Auth::user();
        $user->update([
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
        ]);

        logAction('update_profile');
    }

    public function updateProfile(Request $request) // admin
    {
        try {
            $this->updateProfileGeneral($request->name, $request->email, $request->mobile);

            return redirect(route('users.profile'))->with('message', 'اطلاعات با موفقیت به روزرسانی شد.')->with('type', 'success');
        } catch (\Exception $exception) {
            return redirect(route('users.profile'))->with('message', $exception->getMessage())->with('type', 'danger');
        }
    }

    public function resetPassword($userId)
    {
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                $user->password = Hash::make($user->mobile);
                $user->profile_completed = false;
                $user->save();

                return redirect(route('users.edit', $userId))->with('message', 'رمز عبور با موفقیت به شماره موبایل کاربر تغییر یافت.')->with('type', 'success');
            } else {
                return redirect(route('users.edit', $userId))->with('message', 'کاربر نامعتبر')->with('type', 'success');
            }
        } else {
            return redirect(route('users.edit', $userId))->with('message', 'کاربر نامعتبر')->with('type', 'success');
        }
    }
}
