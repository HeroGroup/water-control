@extends('layouts.admin', ['pageTitle' => 'کاربران', 'newButton' => true, 'newButtonUrl' => 'users/create', 'newButtonText' => 'اضافه کردن کاربر'])
@section('content')
    @if(\Illuminate\Support\Facades\Session::has('message'))
        @component('components.alert', [
            'message' => \Illuminate\Support\Facades\Session::get('message'),
            'type' => \Illuminate\Support\Facades\Session::get('type')])
        @endcomponent
    @endif
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>نام</th>
                <th>شماره موبایل</th>
                <th>آدرس ایمیل</th>
                <th>نوع کاربری</th>
                <th class="text-left">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <div class="label {{$user->user_type == "admin" ? "label-primary" : "label-success"}}">
                            {{$user->user_type == "admin" ? "مدیر سیستم" : "کاربر دستگاه"}}
                        </div>
                    </td>
                    <td class="text-left">
                        <div class="actions-lg">
                            <a class="btn btn-xs btn-warning" href="{{route('users.history', $user->id)}}">
                                <i class="fa fa-fw fa-history"></i> تاریخچه فعالیت
                            </a>
                            <a class="btn btn-xs btn-success" href="{{route('users.edit', $user->id)}}">
                                <i class="fa fa-fw fa-edit"></i> ویرایش
                            </a>
                            <a class="btn btn-xs btn-info" href="{{route('users.sendNotification', $user->id)}}">
                                <i class="fa fa-fw fa-envelope-o"></i> ارسال پیام
                            </a>
                            <a class="btn btn-xs btn-danger" href="#" onclick="del()">
                                <i class="fa fa-fw fa-trash"></i> حذف
                            </a>
                        </div>
                        <div class="actions-sm">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    عملیات
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-left" role="menu">
                                    <li>
                                        <a href="{{route('users.history', $user->id)}}">
                                            <i class="fa fa-fw fa-history text-warning"></i> <span class="text-warning">تاریخچه فعالیت</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('users.edit', $user->id)}}">
                                            <i class="fa fa-fw fa-edit text-success"></i> <span class="text-success">ویرایش</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('users.sendNotification', $user->id)}}">
                                            <i class="fa fa-fw fa-envelope-o text-info"></i> <span class="text-info">ارسال پیام</span>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#" onclick="del()">
                                            <i class="fa fa-fw fa-trash text-danger"></i><span class="text-danger">حذف</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>

    <script>
        function del() {
            event.preventDefault();

            swal({
                text: "در حال حاضر امکان حذف وجود ندارد",
                icon: "warning",
                confirmButtonText: 'باشه'
            });
        }
    </script>
@endsection
