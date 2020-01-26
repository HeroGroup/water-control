@extends('layouts.client', ['title' => 'خوش آمدید'])
@section('content')
    <div class="container-login100" style="background-image: url('/images/drops.jpg');">
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
            <div style="position: relative;">
                <a class="text-primary" style="position: absolute; bottom: 1em; left: 1em;" href="/admin">ورود مدیر</a>
            </div>
        </div>
    </div>
@endsection
