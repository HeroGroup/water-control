<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Water Control">
    <meta name="author" content="NHero">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'سامانه کنترل آب مخزن') }}</title>

    <link href="/css/rtl/bootstrap.min.css" rel="stylesheet">
    <link href="/css/rtl/bootstrap.rtl.css" rel="stylesheet">
    <link href="/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="/css/rtl/sb-admin-2.css" rel="stylesheet">
    <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/css/my.css" rel="stylesheet" type="text/css"><link href="{{public_path('css/rtl/bootstrap.min.css')}}" rel="stylesheet">

    {{--<link href="{{public_path('css/rtl/bootstrap.min.css')}}" rel="stylesheet">--}}
    {{--<link href="{{public_path('css/rtl/bootstrap.rtl.css')}}" rel="stylesheet">--}}
    {{--<link href="{{public_path('css/plugins/metisMenu/metisMenu.min.css')}}" rel="stylesheet">--}}
    {{--<link href="{{public_path('css/rtl/sb-admin-2.css')}}" rel="stylesheet">--}}
    {{--<link href="{{public_path('css/font-awesome/font-awesome.min.css')}}" rel="stylesheet" type="text/css">--}}
    {{--<link href="{{public_path('css/my.css')}}" rel="stylesheet" type="text/css">--}}

</head>

<body>

    <div id="wrapper">

        @include('layouts.sidebar')

        <div id="page-wrapper">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        {{$pageTitle}}
                        @if(isset($newButton) && $newButton)
                            <a class="pull-left btn btn-primary" href="{{$newButtonUrl}}">
                                <i class="fa fa-fw fa-plus"></i> {{$newButtonText}}
                            </a>
                        @endif
                    </h1>
                </div>
            </div>

            @yield('content')

        </div>
    </div>

    <script src="/js/jquery-1.11.0.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/metisMenu/metisMenu.min.js"></script>
    <script src="/js/sb-admin-2.js"></script>
    <script src="/js/sweetalert.min.js" type="text/javascript"></script>

</body>
</html>
