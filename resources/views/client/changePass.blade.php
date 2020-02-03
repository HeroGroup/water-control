@extends('layouts.client', ['title' => 'تغییر کلمه عبور'])
@section('content')
@include('layouts.topMenu', ['routeName' => 'client.changePass'])
<div class="container-index2" style="background-image: url('/images/beautiful-drop-water.jpg');">
    <div class="col-lg-4 col-md-6 col-sm-7 ">
      <div style="background-color:#a9c6e993 ;margin-top:50px;border-radius: 5px;" >
        <div class="container" style="text-align:right;">
        <ul class="nav nav-tabs">
          <li class="active" style="margin-left:10px;"><button class="btn1 customBtn active" href="#home" data-toggle="tab">اطلاعات کاربری</button></li>
          <li class="active"><button class="btn1 customBtn" href="#profile" data-toggle="tab">کلمه عبور</button></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert {{\Illuminate\Support\Facades\Session::get('type') == 'danger' ? 'alert-danger' : 'alert-success'}}" role="alert" style="margin: 10px 0;">
                    <strong>{{\Illuminate\Support\Facades\Session::get('message')}}</strong>
                </div>
            @endif
          <div class="tab-pane active in" id="home">
            <div class="container" style="text-align:right;">
                <form id="tab" action="{{route('client.updateProfile')}}" method="post">
                    @csrf
                <h4 style="text-align:center;">تغییر اطلاعات کاربری</h4>
                <hr style="border:1px solid #1d1c31;">

                <label for="name"><b>نام</b></label>
                <input type="text" placeholder="لطفا نام خود را وارد نمایید.." name="name" value="{{$user->name}}" required>
                <hr style="border:1px solid #1d1c31;">

                <label for="mobile"><b>شماره همراه</b></label>
                <input type="tel" placeholder="لطفا شماره همراه خود را وارد نمایید.." name="mobile" value="{{$user->mobile}}" required>
                <hr style="border:1px solid #1d1c31;">
                <button type="submit" class="registerbtn customBtn2">ثبت تغییر</button>
              </form>
          </div>
          </div>
       <div class="tab-pane fade" id="profile">
          <form id="tab2" action="{{route('client.updatePassword')}}" method="post">
              @csrf
            <div class="container" style="text-align:right;">
              <h4 style="text-align:center;">تغییر کلمه عبور</h4>
              <hr style="border:1px solid #1d1c31;">

              <label for="oldPsw"><b>کلمه عبور فعلی</b></label>
              <input type="password" class="active" placeholder="کلمه عبور فعلی را وارد نمایید.." name="oldPsw" required>
              <hr style="border:1px solid #1d1c31;">

              <label for="newPassword"><b>کلمه عبور جدید</b></label>
              <input type="password" class="active" placeholder="کلمه عبور جدید را وارد نمایید.." name="newPassword" autocomplete="off" required>
              <hr style="border:1px solid #1d1c31;">

              <label for="confirm_newPassword"><b>تکرار کلمه عبور جدید</b></label>
              <input type="password" class="active" placeholder="تکرار کلمه عبور جدید را وارد نمایید.." name="confirm_newPassword" required>
              <hr style="border:1px solid #1d1c31;">
              <button type="submit" class="registerbtn customBtn2">ثبت تغییر</button>
            </div>
          </form>
       </div>
        </div>
        </div>
      </div>
    </div>


</div>
<script>
 var inputPass = document.getElementById('pass'),
      inputChk  = document.getElementById('chk'),
      label = document.getElementById('showhide');


     inputChk.onclick = function () {

      if(inputChk.checked) {

           inputPass.setAttribute('type', 'text');
           label.textContent = 'Hide Passowrd';
       } else {

           inputPass.setAttribute('type', 'password');
           label.textContent = 'Show Passowrd';
       }

     }

     var header = document.getElementById("myDIV");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>
@endsection
