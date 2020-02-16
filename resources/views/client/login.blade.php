@extends('layouts.client', ['title' => 'خوش آمدید'])
@section('content')
    <style>
        .menu {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 54px;
            background-color: #1d1c31;
            text-align: right;
            display: flex;
            align-items: center;
        }
        .custom-button {
            margin: 0 10px 0 0;
            border-radius: 3px;
            padding: 5px 10px;
            border-width: 2px;
            border-style: solid;
        }
        .custom-button:hover {
            color: #0e0e0e;
        }
        .yellow-button {
            border-color: #ffcc00;
            color: #ffcc00;
        }
        .yellow-button:hover {
            background-color: #ffcc00;
        }
        .blue-button {
            border-color: #007bff;
            color: #007bff;
        }
        .blue-button:hover {
            background-color: #007bff;
        }
        .green-button {
            border-color: #28a745;
            color: #28a745;
        }
        .green-button:hover {
            background-color: #28a745;
        }
    </style>
    <div class="container-login100" style="background-image: url('/images/drops.jpg');">
        <div class="menu">
            <a class="custom-button yellow-button" href="/downloads/water-control.apk">دانلود اپلیکیشن</a>
            <a class="custom-button blue-button" href="/admin">ورود مدیر</a>
        </div>
        <div class="wrap-login100 p-t-30 p-b-50">
            <h4>
                <span class="login100-form-title p-b-41 "> خوش آمدید </span>
            </h4>
            <form action="{{route('client.login')}}" method="POST" class="login100-form validate-form p-b-33 p-t-5">
                @csrf
                <label style="width:360px;margin: 20px auto 20px auto;">برای <b>ورود، </b>شماره تلفن همراه و رمزعبور خود را وارد کنید</label>
                <div class="wrap-input100 validate-input" data-validate="Enter PhoneNumber">
                    <input class="input100" type="text" name="mobile" placeholder="شماره تلفن همراه">
                    <span class="focus-input100" ></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" placeholder="رمز عبور">
                    <span class="focus-input100" ></span>
                </div>
                @if(\Illuminate\Support\Facades\Session::has('message'))
                    <div class="help-block text-right text-danger" style="padding: 5px;">
                        {{\Illuminate\Support\Facades\Session::get('message')}}
                    </div>
                @endif

                <div class="container-login100-form-btn m-t-32">
                    <button type="submit" class="button login100-form-btn">ورود</button>
                </div>
            </form>
        </div>
    </div>
@endsection
