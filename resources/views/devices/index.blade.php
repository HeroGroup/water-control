@extends('layouts.admin', ['pageTitle' => 'دستگاه ها', 'newButton' => true, 'newButtonUrl' => 'devices/create', 'newButtonText' => 'اضافه کردن دستگاه'])
@section('content')
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>شماره دستگاه</th>
                <th>مالک</th>
                <th>کاربران</th>
                <th class="text-left">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($devices as $device)
                <tr>
                    <td>{{$device->unique_number}}</td>
                    <td>{{$device->owner}}</td>
                    <td>{{$device->userNames()}}</td>
                    <td class="text-left">
                        <div class="actions-lg">
                            <a class="btn btn-xs btn-primary" href="{{route('devices.status', $device->id)}}">
                                <i class="fa fa-fw fa-laptop"></i> <span>وضعیت دستگاه</span>
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{route('devices.changelog', $device->id)}}">
                                <i class="fa fa-fw fa-history"></i> <span>تاریخچه تغییرات</span>
                            </a>
                            <a class="btn btn-xs btn-success" href="{{route('devices.getRawData', $device->id)}}">
                                <i class="fa fa-fw fa-paperclip"></i> <span>دیتای ارسال شده</span>
                            </a>
                            <a class="btn btn-xs btn-info" href="{{route('devices.edit', $device->id)}}">
                                <i class="fa fa-fw fa-edit"></i><span>ویرایش</span>
                            </a>
                            <a class="btn btn-xs btn-danger" href="#" onclick="del()">
                                <i class="fa fa-fw fa-trash"></i><span>حذف</span>
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
                                        <a href="{{route('devices.status', $device->id)}}">
                                            <i class="fa fa-fw fa-laptop text-warning"></i> <span class="text-warning">وضعیت دستگاه</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('devices.changelog', $device->id)}}">
                                            <i class="fa fa-fw fa-history text-success"></i> <span class="text-success">تاریخچه تغییرات</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('devices.getRawData', $device->id)}}">
                                            <i class="fa fa-fw fa-paperclip text-primary"></i> <span class="text-primary">دیتای ارسال شده</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('devices.edit', $device->id)}}">
                                            <i class="fa fa-fw fa-edit text-dark"></i><span class="text-dark">ویرایش</span>
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
