<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="float-right" dir="rtl">
    <a class="navbar-brand" href="#" style="font-size:18px;margin-right:10px;">سامانه کنترل آب مخزن</a>
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
            <li class="nav-item dropdown" style="float:right;position:absolute;left: 0;" nav-item active" : "nav-item"}}">
                <a style="color:#fff;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color:#a9c6e993;margin-top:8px;">
                    <a class="dropdown-item" href="{{route('client.changePassword')}}">ویرایش اطلاعات</a>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >خروج</a>
                    <form id="logout-form" method="POST" action="{{route('logout')}}" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
</nav>
