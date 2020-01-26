@extends('layouts.admin', ['pageTitle' => 'کاربران', 'newButton' => true, 'newButtonUrl' => 'users/create', 'newButtonText' => 'اضافه کردن کاربر'])
@section('content')
    <div class="table-responsive">
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
                        <a class="btn btn-warning" href="{{route('users.history', $user->id)}}">
                            <i class="fa fa-fw fa-history"></i> تاریخچه فعالیت
                        </a>
                        <a class="btn btn-info" href="{{route('users.edit', $user->id)}}">
                            <i class="fa fa-fw fa-edit"></i> ویرایش
                        </a>
                        <a class="btn btn-danger" href="#" onclick="del()">
                            <i class="fa fa-fw fa-trash"></i> حذف
                        </a>
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
