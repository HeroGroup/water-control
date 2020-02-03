@extends('layouts.client', ['title' => 'تنظیمات'])
@section('content')

    <div class="container-index" style="background-image: url('/images/beautiful-drop-water.jpg');">
        @include('layouts.topMenu', ['routeName' => 'setting'])
        <div class="card" style="width: 40rem; margin:20px;justify-content: center;">
            <div class="card-header text-right" style="font-size:20px;">تنظیمات</div>
             <div class="card-body">
                <form method="post" action="{{route('client.setting.update')}}">
                <div class="col-md-8 col-sm-7 col-xs-12">
                @csrf
                    <div class="form-group row">
                        <label for="latest-update" class="col-sm-6 col-form-label">آخرین تغییرات</label>
                        <div class="col-sm-4">
                            <input type="text" name="latest-update" id="latest-update" value="{{$updated_at}}" disabled="disabled" class="form-control" style="background-color: rgba(209, 217, 219, 0.685);">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="level" class="col-sm-6 col-form-label">محدوده آلارم موردنظر</label>
                        <div class="col-sm-3">
                            {!! Form::selectRange('level', 1, 20, $level, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید...']) !!}
                        </div>
                    </div>
                    <div class="form-group row" dir="rtl" >
                        <label for="mode" class="col-sm-6 col-form-label">نوع آلارم</label>
                        <div class="col-sm-4" style="padding-top: 8px;">
.
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="alarmType[sms]" @if(in_array("sms", $alarmType)) checked @endif class="custom-control-input" id="defaultUnchecked1">
                                <label class="custom-control-label" for="defaultUnchecked1">پیامک</label>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="alarmType[notification]" @if(in_array("notification", $alarmType)) checked @endif class="custom-control-input" id="defaultUnchecked2">
                                <label class="custom-control-label" for="defaultUnchecked2">هشدار</label>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="alarmType[alarm]" @if(in_array("alarm", $alarmType)) checked @endif class="custom-control-input" id="defaultUnchecked3">
                                <label class="custom-control-label" for="defaultUnchecked3" style="margin-right:14px;">آژیر</label>
                            </div>
                        </div>
                    </div>
                    </div>
                             <div class="form-group row d-flex justify-content-center">
                                    <button dir="ltr" class="btn btn-info customBtn" type="submit" style="border-radius: 3px;">ذخیره تغییرات</button>
                             </div>
                  </form>
                 </div>
             </div>
        </div>
    @endsection
