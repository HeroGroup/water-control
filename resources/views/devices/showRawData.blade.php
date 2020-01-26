@extends('layouts.admin', ['pageTitle' => 'نمایش دیتای ارسال شده توسط دستگاه '.$device->unique_number])
@section('content')
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>تاریخ</th>
                <th>ساعت</th>
                <th>دیتا</th>
            </tr>
        </thead>
        <tbody>
        @foreach($logs as $log)
            <tr>
                <td>{{jdate('Y/m/j', strtotime($log->created_at))}}</td>
                <td>{{jdate('H:i', strtotime($log->created_at))}}</td>
                <td dir="ltr" style="text-align: right;">
                    <div>
                        <?php $data = explode('&', $log->input_data); ?>
                        <div>
                        @for($i=0; $i<21; $i++)
                            <div style="display:inline-block; width: 20px; height: 20px; border: 1px solid gray; text-align: center">
                                <span style="font-weight: bold;" class="{{$data[$i] == 0 ? "text-danger" : ($data[$i] == 1 ? "text-success" : "text-info")}}">{{$data[$i]}}</span>
                            </div>
                        @endfor
                        </div>
                        <div>
                        <?php $index=0; ?>
                        @for($i=21; $i<42; $i++)
                            <?php $index++; ?>
                            <div style="display:inline-block; width: 20px; height: 20px; border: 1px solid gray; text-align: center">
                                <span style="font-weight: bold;" class="{{$data[$i] == 0 ? "text-danger" : ($data[$i] == 1 ? "text-success" : "text-info")}}">{{$data[$i]}}</span>
                                <div class="help-block">{{$index}}</div>
                            </div>
                        @endfor
                        </div>
                    </div>
                    {{--{{$log->input_data}}--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="pull-left">{{ $logs->links() }}</div>
@endsection
