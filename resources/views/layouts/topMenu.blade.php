<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="float-right;background-color:#1d1c31;";" dir="rtl">
    <a class="navbar-brand" href="#" style="font-size:14px;margin-right:0px;font-weight: bold;">سامانه کنترل آب مخزن</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="{{$routeName == 'home' ? "nav-item active" : "nav-item"}}">
                <a class="nav-link" href="{{route('client.home')}}">صفحه اصلی</a>
            </li>
            <li class="{{$routeName == 'setting' ? "nav-item active" : "nav-item"}}">
                <a class="nav-link" href="{{route('client.setting')}}">تنظیمات</a>
            </li>
            <li class="{{$routeName == 'reports' ? "nav-item active" : "nav-item"}}">
                <a class="nav-link" href="{{route('client.report')}}">گزارشات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">دانلود اپلیکیشن</a>
            </li>
        </ul>
    </div>
            <div class="nav-item dropdown" style="float:right;position:absolute;left: 0;" nav-item active" : "nav-item"}}">
                <a style="color:#fff;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color:#a9c6e993;margin-top:8px;">
                   <a class="dropdown-item" href="{{route('client.changePassword')}}">ویرایش اطلاعات</a>
                   <div> 
                   <a class="dropdown-item" href="#" onclick="logout()" ><i class="fa fa-sign-out fa-fw text-danger">
                   </i>خروج</a>
                   <form id="logout-form" method="POST" action="{{route('logout')}}" style="display: none;">
                            @csrf
                   </form>           
                   </div>
                </div>
            </div>
</nav>
<script>
    function logout() {
        event.preventDefault();

        swal({
            title: "آیا برای خروج اطمینان دارید؟",
            icon: "warning",
            buttons: ["انصراف", "خروج"],
            dangerMode: true,
        }).then((willExit) => {
            if (willExit)
                document.getElementById('logout-form').submit();
        });
    }
</script>
