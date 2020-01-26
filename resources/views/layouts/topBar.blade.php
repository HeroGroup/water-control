<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">سامانه کنترل آب مخزن</a>
</div>

<!-- /.navbar-header -->
<ul class="nav navbar-top-links navbar-left">
    <!-- /.dropdown -->
    {{--<li class="dropdown">--}}
        {{--<a class="dropdown-toggle text-warning" data-toggle="dropdown" href="#">--}}
            {{--<i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>--}}
        {{--</a>--}}
        {{--<ul class="dropdown-menu dropdown-alerts">--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<div>--}}
                        {{--<i class="fa fa-comment fa-fw"></i> نظر جدید--}}
                        {{--<span class="pull-right text-muted small">4 دقیقه پیش</span>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<div>--}}
                        {{--<i class="fa fa-twitter fa-fw"></i> 3 دنبال کننده جدید--}}
                        {{--<span class="pull-right text-muted small">12 دقیقه پیش</span>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<div>--}}
                        {{--<i class="fa fa-envelope fa-fw"></i> پیام ارسال شد--}}
                        {{--<span class="pull-right text-muted small">4 دقیقه پیش</span>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<div>--}}
                        {{--<i class="fa fa-tasks fa-fw"></i> وظیفه جدید--}}
                        {{--<span class="pull-right text-muted small">4 دقیقه پیش</span>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<div>--}}
                        {{--<i class="fa fa-upload fa-fw"></i> راه اندازی مجدد سرور--}}
                        {{--<span class="pull-right text-muted small">4 دقیقه پیش</span>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li>--}}
                {{--<a class="text-center" href="#">--}}
                    {{--<strong>See All Alerts</strong>--}}
                    {{--<i class="fa fa-angle-right"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
        {{--<!-- /.dropdown-alerts -->--}}
    {{--</li>--}}
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle text-info" data-toggle="dropdown" href="#">
            <span>{{auth()->user()->name}}</span> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="{{route('users.profile')}}"><i class="fa fa-user fa-fw text-success"></i> پروفایل</a>
            </li>
            {{--<li>--}}
                {{--<a href="#"><i class="fa fa-gear fa-fw text-warning"></i> تنظیمات</a>--}}
            {{--</li>--}}
            <li class="divider"></li>
            <li>
                <a href="#" onclick="logout()"><i class="fa fa-sign-out fa-fw text-danger"></i> خروج</a>
                <form id="logout-form" method="POST" action="{{route('logout')}}" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

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
