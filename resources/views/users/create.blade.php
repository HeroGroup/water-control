@extends('layouts.admin', ['pageTitle' => 'اضافه کردن کاربر'])
@section('content')
    <form class="form-horizontal" action="{{route('users.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">نام</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="mobile" class="col-sm-2 control-label">شماره موبایل</label>
            <div class="col-sm-4">
                <input type="tel" class="form-control" id="mobile" name="mobile" value="{{old('mobile')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">آدرس ایمیل</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="device_id" class="col-sm-2 control-label">دستگاه</label>
            <div class="col-sm-4">
                {{Form::select('device_id', $devices, null, ['name'=>'device_id', 'placeholder' => 'انتخاب کنید...', 'class' => 'form-control'])}}
            </div>
            <div class="col-sm-2">
                <a class="btn btn-primary" href="{{route('devices.create')}}">
                    <i class="fa fa-fw fa-plus"></i> دستگاه جدید
                </a>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4 text-left">
                <a class="btn btn-default" href="{{route('users.index')}}">انصراف</a>
                <button type="submit" class="btn btn-success">ذخیره</button>
            </div>
        </div>
    </form>
@endsection
