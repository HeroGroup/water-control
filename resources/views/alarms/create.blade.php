@extends('layouts.admin', ['pageTitle' => 'ساخت هشدار جدید'])
@section('content')
    {{ Form::open(array('url' => route('alarms.store'), 'method' => 'POST', 'files' => 'true')) }}
        @csrf
        <div class="form-horizontal">
            <div class="form-group">
                <label for="alarm_message" class="col-sm-2 control-label">متن هشدار</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="alarm_message" name="alarm_message" value="{{old('alarm_message')}}">
                </div>
            </div>
            <div class="form-group">
                <label for="alarm_type" class="col-sm-2 control-label">نوع هشدار</label>
                <div class="col-sm-4">
                    {{Form::select('alarm_type', Config::get('enums.alarm_types'), old('alarm_type'), ['placeholder' => 'انتخاب کنید...', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="form-group">
                <label for="alarm_icon" class="col-sm-2 control-label">آیکون</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" id="alarm_icon" name="alarm_icon">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4 text-left">
                    <a class="btn btn-default" href="{{route('alarms.index')}}">انصراف</a>
                    <button type="submit" class="btn btn-success">ذخیره</button>
                </div>
            </div>
        </div>
    {{ Form::close() }}
@endsection
