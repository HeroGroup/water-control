@extends('layouts.client', ['title' => 'تغییر رمز عبور'])
@section('content')
    <div class="container-login100" style="background-image: url('/images/drops.jpg');">
        <div class="wrap-login100 p-t-30 p-b-50">
            <h4>
                <span class="login100-form-title p-b-20 "> تغییر رمز عبور </span>
            </h4>
            <form action="{{route('client.updatePassword')}}" method="POST" class="login100-form validate-form p-b-33 p-t-5" style="padding:25px;">
                @csrf
                <label style="width:360px; font-size: 15px;">کلمه عبور جدید را وارد نمایید</label>
                <div class="wrap-input100 validate-input">
                    <input dir="ltr" class="input100" type="password" name="newPassword">
                    <span style="padding: 0px; margin-top: 0px;" class="focus-input100" ></span>
                </div>
                <label style="width:360px; font-size: 15px; margin-top: 10px;">کلمه عبور را مجددا وارد نمایید</label>
                <div class="wrap-input100 validate-input">
                    <input dir="ltr" class="input100" type="password" name="confirm_newPassword">
                    <span style="padding: 0px; margin-top: 0px;" class="focus-input100" ></span>
                </div>

                @if(\Illuminate\Support\Facades\Session::has('message'))
                    <div class="help-block text-right text-danger" style="padding: 5px;">
                        {{\Illuminate\Support\Facades\Session::get('message')}}
                    </div>
                @endif

                <div class="container-login100-form-btn m-t-32">
                    <button type="submit" class="button login100-form-btn">ثبت</button>
                </div>
            </form>
        </div>
    </div>
@endsection
