@extends('layouts.admin', ['pageTitle' => 'ویرایش هشدار'])
@section('content')
    <div class="form-horizontal">
        {!! Form::model($alarm, array('route' => array('alarms.update', $alarm), 'method' => 'PUT', 'files' => 'true')) !!}
        <div class="form-group">
            <label for="alarm_message" class="col-sm-2 control-label">متن هشدار</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="alarm_message" name="alarm_message" value="{{$alarm->alarm_message}}">
            </div>
        </div>
        <div class="form-group">
            <label for="alarm_type" class="col-sm-2 control-label">نوع هشدار</label>
            <div class="col-sm-4">
                {{Form::select('alarm_type', Config::get('enums.alarm_types'), $alarm->alarm_type, ['placeholder' => 'انتخاب کنید...', 'class' => 'form-control'])}}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <img src="{{$alarm->alarm_icon}}" width="100" height="100" />
            </div>
        </div>
        <div class="form-group">
            <label for="alarm_icon" class="col-sm-2 control-label">آیکون</label>
            <div class="col-sm-4">
                <input type="file" accept="image/*" class="form-control" id="alarm_icon" name="alarm_icon">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4 text-left">
                <a class="btn btn-default" href="{{route('alarms.index')}}">انصراف</a>
                <button type="submit" class="btn btn-success">ذخیره</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
