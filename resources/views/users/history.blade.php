@extends('layouts.admin', ['pageTitle' => 'تاریخچه فعالیت '.$user->name])
@section('content')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>تاریخ</th>
                <th>ساعت</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
        @foreach($histories as $history)
            <tr>
                <td>{{jdate('Y/m/j', strtotime($history->created_at))}}</td>
                <td>{{jdate('H:i', strtotime($history->created_at))}}</td>
                <td>
                    <div class="label label-{{Config::get('enums.log_actions.'.$history->action.'.color')}}">{{Config::get('enums.log_actions.'.$history->action.'.value')}}</div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
