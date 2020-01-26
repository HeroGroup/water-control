<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

    @include('layouts.topBar')

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                {{--<li>--}}
                    {{--<a href="/admin/home"><i class="fa fa-dashboard fa-fw"></i> خانه</a>--}}
                {{--</li>--}}
                <li>
                    <a href="/admin/devices"><i class="fa fa-laptop fa-fw"></i> دستگاه ها</a>
                </li>
                <li>
                    <a href="/admin/users"><i class="fa fa-users fa-fw"></i> کاربران</a>
                </li>
                <li>
                    <a href="/admin/alarms"><i class="fa fa-bell-o fa-fw"></i> هشدارها</a>
                </li>
                {{--<li>--}}
                    {{--<a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level">--}}
                        {{--<li>--}}
                            {{--<a href="#">Second Level Item</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#">Third Level <span class="fa arrow"></span></a>--}}
                            {{--<ul class="nav nav-third-level">--}}
                                {{--<li>--}}
                                    {{--<a href="#">Third Level Item</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            {{--<!-- /.nav-third-level -->--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<!-- /.nav-second-level -->--}}
                {{--</li>--}}
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
