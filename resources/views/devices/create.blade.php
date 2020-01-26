@extends('layouts.admin', ['pageTitle' => 'اضافه کردن دستگاه'])
@section('content')
    <form class="form-horizontal" action="{{route('devices.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="unique_number" class="col-lg-2 control-label">شماره دستگاه</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" id="unique_number" name="unique_number">
            </div>
        </div>
        <div class="form-group">
            <label for="owner" class="col-lg-2 control-label">مالک</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" id="owner" name="owner">
            </div>
        </div>
        <div class="form-group">
            <label for="level_meter_send_data_duration" class="col-lg-2 control-label">بازه زمانی ارسال اطلاعات (ثانیه)</label>
            <div class="col-lg-4">
                <input type="number" class="form-control" id="level_meter_send_data_duration" name="level_meter_send_data_duration">
            </div>
        </div>
        <div class="form-group">
            <label for="level_meter_gather_data_duration" class="col-lg-2 control-label">بازه زمانی کنترل تغییر سطح آب (ثانیه)</label>
            <div class="col-lg-4">
                <input type="number" class="form-control" id="level_meter_gather_data_duration" name="level_meter_gather_data_duration">
            </div>
        </div>
        <div class="form-group">
            <label for="micro_switch_position" class="col-lg-2 control-label">موقعیت مکانی میکروسوییچ</label>
            <div class="col-lg-8">
                <div class="row">
                    <label class="col-lg-3">میکروسوییچ شماره 1</label>
                    <div class="col-lg-6">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-1 control-label">قطعه</label>
                                <div class="col-lg-4">
                                    <select name="part_1" class="form-control">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <label class="col-lg-1 control-label">سطح</label>
                                <div class="col-lg-4">
                                    {!! Form::selectRange('level_1', 0, 9, null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-lg-3">میکروسوییچ شماره 2</label>
                    <div class="col-lg-6">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-1 control-label">قطعه</label>
                                <div class="col-lg-4">
                                    <select name="part_2" class="form-control">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <label class="col-lg-1 control-label">سطح</label>
                                <div class="col-lg-4">
                                    {!! Form::selectRange('level_2', 0, 9, null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="alarm_panel_receive_data_duration" class="col-lg-2 control-label">بازه زمانی دریافت اطلاعات توسط آلارم پنل (ثانیه)</label>
            <div class="col-lg-4">
                <input type="number" class="form-control" id="alarm_panel_receive_data_duration" name="alarm_panel_receive_data_duration">
            </div>
        </div>
        <div class="form-group">
            <label for="user_id" class="col-lg-2 control-label">کاربر</label>
            <div class="col-lg-4">
                {{Form::select('user_id', $users, null, ['multiple'=>'multiple', 'name'=>'user_id[]', 'placeholder' => 'انتخاب کنید...', 'class' => 'form-control'])}}
            </div>
            <div class="col-lg-2">
                <a class="btn btn-primary" href="{{route('users.create')}}">
                    <i class="fa fa-fw fa-plus"></i> کاربر جدید
                </a>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-4 text-left">
                <a class="btn btn-default" href="{{route('devices.index')}}">انصراف</a>
                <button type="submit" class="btn btn-success">ذخیره</button>
            </div>
        </div>
    </form>
@endsection
