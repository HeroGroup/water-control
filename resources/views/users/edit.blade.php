@extends('layouts.admin', ['pageTitle' => 'ویرایش اطلاعات کاربر'])
@section('content')
    @if(\Illuminate\Support\Facades\Session::has('message'))
        @component('components.alert', [
            'message' => \Illuminate\Support\Facades\Session::get('message'),
            'type' => \Illuminate\Support\Facades\Session::get('type')])
        @endcomponent
    @endif
    <div class="form-horizontal">
        {!! Form::model($user, array('route' => array('users.update', $user), 'method' => 'PUT')) !!}
            @csrf
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">نام</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                </div>
            </div>
            <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">شماره موبایل</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{$user->mobile}}">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">آدرس ایمیل</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                </div>
            </div>
            <div class="form-group">
                <label for="device_id" class="col-sm-2 control-label">دستگاه</label>
                <div class="col-sm-4">
                    {!! Form::select('device_id', $devices, $device_id, array('class' => 'form-control', 'placeholder' => 'انتخاب کنید...')) !!}
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-primary" href="{{route('devices.create')}}">
                        <i class="fa fa-fw fa-plus"></i> دستگاه جدید
                    </a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <a href="/admin/users/{{$user->id}}/resetPassword">بازنشانی رمز عبور</a>
                </div>
                <div class="col-sm-2 text-left">
                    <a class="btn btn-default" href="{{route('users.index')}}">انصراف</a>
                    <button type="submit" class="btn btn-success">ذخیره</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

@endsection
