<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'سامانه کنترل آب مخزن') }}</title>

    <link href="/css/rtl/bootstrap.min.css" rel="stylesheet">
    <link href="/css/rtl/bootstrap.rtl.css" rel="stylesheet">
    <link href="/css/my.css" rel="stylesheet" type="text/css"><link href="{{public_path('css/rtl/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body dir="rtl" style="background-color: #f9f9f9">
<div style="width: 100%; height: 50px; background-color: #f5f5f5;box-shadow:0 .2rem .25rem rgba(0,0,0,.075)!important">
    <p style="padding: 10px 20px; font-size: 18px;" class="text-muted">سامانه کنترل آب مخزن</p>
</div>
<div class="container">
    <div class="row" style="margin-top: 50px">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ورود</div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="mobile" class="col-md-4 control-label">شماره موبایل</label>
                            <div class="col-md-6">
                                <input id="mobile" type="text" size="11" maxlength="11" minlength="11" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autofocus>
                                @error('mobile')
                                <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">رمز عبور</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="form-check">
                                    <label class="form-check-label" for="remember">
                                        مرا به خاطر بسپار
                                    </label>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    ورود
                                </button>
                                <a href="#" style="padding-right: 1rem;">
                                    رمز عبور خود را فراموش  کرده اید؟
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
