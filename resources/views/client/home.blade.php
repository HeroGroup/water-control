@extends('layouts.client', ['title' => 'خانه'])
@section('content')
@include('layouts.topMenu', ['routeName' => 'home'])
<div class="container-index" style="background-image: url('/images/beautiful-drop-water.jpg');">

       <hr/>
       <div class="container" style="margin-top:50px; direction:rtl;">
        <div class="row">
        <label class="switch col-xs-12">
           <span class="slider" style="text-align:center;padding:4px;">
               <b style="margin-top:5px;font-size:18px;">{{$deviceStatus}}</b>
               <span class="float-left">{{ $lastActive }}</span>
           </span>
        </label>

        </div>
        <div class="row">
          <div class="col-sm-6" style="direction: rtl; margin-right:0px">
           <div style="position: relative;  width: 100%; height: 504px; border: 2px solid gray; border-top: none; border-radius: 0 0 5px 5px; display: inline-block; background-image: linear-gradient(to top, #3498db 30%, #c0392b 70%);">
            <div style="width: 100%; height: {{500-($level*25)}}px; position: absolute; top: 0; right: 0;  background-image: url(/images/beautiful-drop-water.jpg);">
             <div>
                 <li id="maxValue" class='ruler'></li>
                 <li id="midValue2" class='ruler'></li>
                 <li id="midValue1" class='ruler'></li>
                 <li id="minValue" class='ruler'></li>
             </div>
            </div>
            <div style="width: 100%; height: {{$level*25}}px; border-radius: 0 0 4px 4px; position: absolute; bottom: 0; right: 0; display: flex; justify-content: center; align-items: center;">
                <span style="color: white; font-size: 20px;">سطح {{$level}}</span>
            </div>
           </div>
          </div>

        <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 style="margin-left: 225px;">هشدارها</h3>
            </div>
            <div class="panel-body">
                @foreach($alarms as $alarm)
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <img src="{{asset('images/bell.png')}}" height="30" />
                    </div>
                    <div class="col-md-7 col-xs-6">
                        <span>{{$alarm['alarm_message']}}</span>
                    </div>
                    <div class="col-md-3 col-xs-4 text-right" style="direction: rtl">
                        <span style="text-align:right;padding:4px;direction:rtl;font-size: 12px;">{{$alarm['created_at']}}</span>
                    </div>
                </div>
                <hr>
                @endforeach
                @if(count($alarms) == 0)
                    <div class="row" style="justify-content: center; align-items: center;">
                        <span style="padding: 12px;">هشداری جهت نمایش وجود ندارد</span>
                    </div>
                @endif
            </div>
        </div>
        </div>
    </div>
</div>
</div>
    <script>

        document.getElementById('maxValue').innerHTML = '20';
        document.getElementById('midValue2').innerHTML = '15';
        document.getElementById('midValue1').innerHTML = '10';
        document.getElementById('minValue').innerHTML = '5';


    </script>

@endsection
