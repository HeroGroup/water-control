@extends('layouts.admin', ['pageTitle' => 'ارسال پیام به '.$user->name])
@section('content')
    <form class="form-horizontal" method="post" action="{{route('users.notifications.send')}}">
        @csrf
        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}" />
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">عنوان</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="col-sm-2 control-label">متن پیام</label>
            <div class="col-sm-4">
                <textarea rows="3" class="form-control" name="message" cols="50"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4 text-left">
                <a class="btn btn-default" href="{{route('users.index')}}">انصراف</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-send"></i> ارسال</button>
            </div>
        </div>
    </form>
@endsection
