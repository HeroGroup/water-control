@extends('layouts.admin', ['pageTitle' => 'هشدار ها', 'newButton' => true, 'newButtonUrl' => 'alarms/create', 'newButtonText' => 'اضافه کردن هشدار'])
@section('content')
    @if(\Illuminate\Support\Facades\Session::has('message'))
        @component('components.alert', [
            'message' => \Illuminate\Support\Facades\Session::get('message'),
            'type' => \Illuminate\Support\Facades\Session::get('type')])
        @endcomponent
    @endif
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>آیکون</th>
                <th>متن هشدار</th>
                <th>نوع</th>
                <th class="text-left">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alarms as $alarm)
                <tr>
                    <td><img src="{{$alarm->alarm_icon}}" width="50px" height="50px"></td>
                    <td>{{$alarm->alarm_message}}</td>
                    <td>
                        <div class="label label-{{Config::get('enums.alarm_colors.'.$alarm->alarm_type)}}">
                            {{Config::get('enums.alarm_types.'.$alarm->alarm_type)}}
                        </div>
                    </td>
                    @component('components.editLink')
                        @slot('routeEdit'){{route('alarms.edit',$alarm->id)}}@endslot
                        @slot('itemId'){{$alarm->id}}@endslot
                        @slot('routeDelete'){{route('alarms.destroy',$alarm->id)}}@endslot
                    @endcomponent
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection
