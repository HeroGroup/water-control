@extends('layouts.admin', ['pageTitle' => 'ویرایش اطلاعات دستگاه '.$device->unique_number])
@section('content')
    <div class="form-horizontal">
    {!! Form::model($device, array('route' => array('devices.update', $device), 'method' => 'PUT')) !!}
        @csrf
        <div class="form-group">
            <label for="unique_number" class="col-sm-2 control-label">شماره دستگاه</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="unique_number" name="unique_number" value="{{$device->unique_number}}">
            </div>
        </div>
        <div class="form-group">
            <label for="owner" class="col-sm-2 control-label">مالک</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="owner" name="owner" value="{{$device->owner}}">
            </div>
        </div>
        <div class="form-group">
            <label for="level_meter_send_data_duration" class="col-sm-2 control-label">بازه زمانی ارسال اطلاعات (ثانیه)</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" id="level_meter_send_data_duration" name="level_meter_send_data_duration" value="{{$device->level_meter_send_data_duration}}">
            </div>
        </div>
        <div class="form-group">
            <label for="level_meter_gather_data_duration" class="col-sm-2 control-label">بازه زمانی کنترل تغییر سطح آب (ثانیه)</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" id="level_meter_gather_data_duration" name="level_meter_gather_data_duration" value="{{$device->level_meter_gather_data_duration}}">
            </div>
        </div>
        <div class="form-group">
            <label for="level_meter_micro_switch_position" class="col-lg-2 control-label">موقعیت مکانی میکروسوییچ</label>
            <div class="col-lg-6">
                <input type="number" class="form-control" id="level_meter_micro_switch_position" name="level_meter_micro_switch_position" value="{{$device->level_meter_micro_switch_position}}">
                {{--<div class="row">--}}
                    {{--<label class="col-lg-3">میکروسوییچ شماره 1</label>--}}
                    {{--<div class="col-lg-6">--}}
                        {{--<div class="form-horizontal">--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-lg-1 control-label">قطعه</label>--}}
                                {{--<div class="col-lg-4">--}}
                                    {{--{!! Form::selectRange('part_1', 0, 1, $part1, array('class' => 'form-control')) !!}--}}
                                {{--</div>--}}
                                {{--<label class="col-lg-1 control-label">سطح</label>--}}
                                {{--<div class="col-lg-4">--}}
                                    {{--{!! Form::selectRange('level_1', 0, 9, $level1, array('class' => 'form-control')) !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<label class="col-lg-3">میکروسوییچ شماره 2</label>--}}
                    {{--<div class="col-lg-6">--}}
                        {{--<div class="form-horizontal">--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-lg-1 control-label">قطعه</label>--}}
                                {{--<div class="col-lg-4">--}}
                                    {{--{!! Form::selectRange('part_2', 0, 1, $part2, array('class' => 'form-control')) !!}--}}
                                {{--</div>--}}
                                {{--<label class="col-lg-1 control-label">سطح</label>--}}
                                {{--<div class="col-lg-4">--}}
                                    {{--{!! Form::selectRange('level_2', 0, 9, $level2, array('class' => 'form-control')) !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>

        <div class="form-group">
            <label for="alarm_panel_receive_data_duration" class="col-lg-2 control-label">بازه زمانی دریافت اطلاعات توسط آلارم پنل (ثانیه)</label>
            <div class="col-lg-6">
                <input type="number" class="form-control" id="alarm_panel_receive_data_duration" name="alarm_panel_receive_data_duration" value="{{$device->alarm_panel_receive_data_duration}}">
            </div>
        </div>
            <div class="form-group">
                <label for="user_id" class="col-sm-2 control-label">کاربر</label>
                <div class="col-sm-6">
                    {{--<select id="user_id" name="user_id[]" class="form-control" multiple>--}}
                        {{--@foreach($users as $user)--}}
                            {{--<option value="{{$user->id}}" @if(\App\DeviceUser::where([['device_id', $device->id],['user_id', $user->id]])->count() > 0) selected @endif>{{$user->mobile}} - {{$user->name}}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                    <table class="table" style="background-color: #c1c1c1; border-radius: 5px;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>نام</th>
                                <th>موبایل</th>
                                <th class="text-center">وضعیت</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    @if(\App\DeviceUser::where([['device_id', $device->id],['user_id', $user->id], ['is_active', true]])->count() > 0)
                                        <i class="fa fa-fw fa-circle text-success"></i>
                                    @else
                                        <i class="fa fa-fw fa-circle-o"></i>
                                    @endif
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->mobile}}</td>
                                <td class="text-center">
                                    @if(\App\DeviceUser::where([['device_id', $device->id],['user_id', $user->id], ['is_active', true]])->count() > 0)
                                        انتساب داده شده
                                    @else
                                        آزاد
                                    @endif
                                </td>
                                <td class="text-left">
                                    @if(\App\DeviceUser::where([['device_id', $device->id],['user_id', $user->id], ['is_active', true]])->count() > 0)
                                        <a class="btn btn-danger btn-sm" href="#" onclick="revokeUser('{{csrf_token()}}','{{$device->id}}','{{$user->id}}')">
                                            <i class="fa fa-fw fa-remove"></i> لغو
                                        </a>
                                    @else
                                        <a class="btn btn-info btn-sm" href="#" onclick="assignUser('{{csrf_token()}}', '{{$device->id}}', '{{$user->id}}')">
                                            <i class="fa fa-fw fa-check"></i> انتساب
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-primary" href="{{route('users.create')}}">
                        <i class="fa fa-fw fa-plus"></i> کاربر جدید
                    </a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6 text-left">
                    <a class="btn btn-default" href="{{route('devices.index')}}">انصراف</a>
                    <button type="submit" class="btn btn-success">ذخیره</button>
                </div>
            </div>
    {!! Form::close() !!}
    </div>
<script>
    function assignUser(csrf, deviceId, userId) {
        event.preventDefault();

        $.ajax('{{route('devices.assignUser')}}', {
            method: 'post',
            data: {
                _token: csrf,
                device_id: deviceId,
                user_id: userId
            },
            success: function(response) {
                if (response.status === 1)
                    window.location.reload();
                else
                    alert(response.message);
            }
        }).fail(function (err) {
            console.log(err);
            alert('خطایی رخ داده است');
        });
    }

    function revokeUser(csrf, deviceId, userId) {
        event.preventDefault();

        $.ajax('{{route('devices.revokeUser')}}', {
            method: 'post',
            data: {
                _token: csrf,
                device_id: deviceId,
                user_id: userId
            },
            success: function(response) {
                if (response.status === 1)
                    window.location.reload();
                else
                    alert(response.message);
            }
        }).fail(function (err) {
            console.log(err);
            alert('خطایی رخ داده است');
        });
    }
</script>
@endsection
