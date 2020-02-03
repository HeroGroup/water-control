@extends('layouts.admin', ['pageTitle' => 'تاریخچه تغییرات دستگاه '.$device->unique_number])
@section('content')
    <style>
        th, td {
            text-align: center;
        }
    </style>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#changelog" data-toggle="tab">تغییرات</a></li>
        <li><a href="#users" data-toggle="tab">کاربران</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade in active" id="changelog">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>بازه زمانی ارسال دیتا</th>
                        <th>بازه زمانی جمع آوری دیتا</th>
                        <th>موقعیت مکانی میکروسوییچ ها</th>
                        <th>یازه زمانی دریافت دیتا توسط آلارم پنل</th>
                        <th>سطح هشدار</th>
                        <th>نوع هشدار</th>
                        <th>کاربر تغییر دهنده</th>
                        <th>زمان تغییر</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0 ?>
                    @foreach($changelog as $log)
                        <?php $i++ ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$log->level_meter_send_data_duration}}</td>
                            <td>{{$log->level_meter_gather_data_duration}}</td>
                            <td style="direction: ltr;">{{$log->level_meter_micro_switch_position}}</td>
                            <td>{{$log->alarm_panel_receive_data_duration}}</td>
                            <td>{{$log->alarm_level}}</td>
                            <td>{{$log->alarm_type}}</td>
                            <td class="text-success">{{$log->user ? $log->user->name : ''}}</td>
                            <td class="text-primary">{{jdate('H:i Y/m/j', strtotime($log->created_at))}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="users">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام کاربر</th>
                        <th>تاریخ فعالسازی</th>
                        <th>وضعیت کنونی</th>
                        <th>تاریغ غیرفعالسازی</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0 ?>
                    @foreach($deviceUsers as $deviceUser)
                        <?php $i++ ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$deviceUser->user ? $deviceUser->user->name : ''}}</td>
                            <td>{{$deviceUser->activation_date ? jdate('H:i Y/m/j', strtotime($deviceUser->activation_date)) : ''}}</td>
                            <td>
                                <div class="label {{$deviceUser->is_active ? 'label-success' : 'label-default'}}">
                                    {{$deviceUser->is_active ? 'فعال' : 'غیرفعال'}}
                                </div>
                            </td>
                            <td>{{$deviceUser->deactivation_date ? jdate('H:i Y/m/j', strtotime($deviceUser->deactivation_date)) : ''}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
