@extends('layouts.admin', ['pageTitle' => 'پروفایل'])
@section('content')
    @if(\Illuminate\Support\Facades\Session::has('message'))
        @component('components.alert', [
            'message' => \Illuminate\Support\Facades\Session::get('message'),
            'type' => \Illuminate\Support\Facades\Session::get('type')])
        @endcomponent
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #f1f1f1">
                    <h4>ویرایش اطلاعات کاربری</h4>
                </div>
                <div class="panel-body" style="background-color: #f9f9f9">
                    <form action="{{route('users.updateProfile')}}" method="post">
                        @csrf
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="name" class="control-label col-md-4">نام</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label col-md-4">آدرس ایمیل</label>
                                <div class="col-md-8">
                                    <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="control-label col-md-4">شماره موبایل</label>
                                <div class="col-md-8">
                                    <input type="text" name="mobile" id="mobile" class="form-control" value="{{$user->mobile}}" size="11" minlength="11" maxlength="11" />
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4 text-left">
                                    <input type="submit" value="ثبت" class="btn btn-success" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #f1f1f1">
                    <h4>تغییر رمز عبور</h4>
                </div>
                <div class="panel-body" style="background-color: #f9f9f9">
                    <form action="{{route('users.changePassword')}}" method="post">
                        @csrf
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="password" class="control-label col-md-4">رمز عبور جدید</label>
                                <div class="col-md-8">
                                    <input type="password" name="password" id="password" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="control-label col-md-4">تکرار رمز عبور</label>
                                <div class="col-md-8">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                                </div>
                            </div>
                            <br>
                            <div class="form-group" style="margin-top: 3.5em;">
                                <div class="col-md-8 col-md-offset-4 text-left">
                                    <input type="submit" value="ثبت" class="btn btn-success" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
