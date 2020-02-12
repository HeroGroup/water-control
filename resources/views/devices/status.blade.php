@extends('layouts.admin', ['pageTitle' => 'وضعیت فعلی دستگاه '.$device->unique_number])
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div style="position: relative; width: 100%; height: 500px; border: 2px solid gray; border-top: none; border-radius: 0 0 5px 5px; display: inline-block; background-image: linear-gradient(to top, #3498db 30%, #c0392b 70%);">
                <div id="empty-area" style="width: 100%; height: {{500-($level*25)}}px; position: absolute; top: 0; right: 0; background-color: white;"></div>
                <div id="full-area" style="width: 100%; height: {{$level*25}}px; border-radius: 0 0 4px 4px; position: absolute; bottom: 0; right: 0; display: flex; justify-content: center; align-items: center;">
                    <span style="color: white; font-size: 20px;">سطح <span id="level-number">{{$level}}</span></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>هشدارها</h3>
                </div>
                <div class="panel-body">
                    @foreach($alarms as $alarm)
                        <div class="row">
                            <div class="col-md-2 col-xs-2">
                                <img src="{{$alarm['alarm_icon']}}" height="30">
                            </div>
                            <div class="col-md-7 col-xs-6">
                                <span>{{$alarm['alarm_message']}}</span>
                            </div>
                            <div class="col-md-3 col-xs-4 text-left">
                                <span class="text-muted" dir="rtl">{{$alarm['created_at']}}</span>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    @if(count($alarms) == 0)
                        <div class="text-muted" style="display: flex; justify-content: center; align-items: center">
                            <p>هشداری جهت نمایش وجود ندارد</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{--<script src="https://js.pusher.com/5.0/pusher.min.js"></script>--}}
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    {{--<script src="/js/pusher.min.js" type="text/javascript"></script>--}}
    <script>
        var pusher = new Pusher('bd1d5d92cd0fc2db2711', {
            encrypted: true,
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('level-changed');

        channel.bind('App\\Events\\LevelChanged', function(data) {
            if (data.deviceLog.device_id.toString() === "{{$device->id}}") {
                $("#empty-area").animate({height: 500-(data.level*25)+'px'}, 500);
                $("#full-area").animate({height: (data.level*25)+'px'}, 500);
                $("#level-number").text(data.level);
            }
        });
    </script>
@endsection
