<!DOCTYPE html>
<html dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>{{$title}}</title>

<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/main.css">
<link rel="stylesheet" href="/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="/css/my.css">
<link rel="stylesheet" href="/css/util.css">
<link rel="stylesheet" href="/fonts/icon-font.min.css">
<link rel="stylesheet" href="/css/highcharts.css">
<link rel="stylesheet" href="/css/popup.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">


<!-- <link rel="stylesheet" type="text/css" media="all" href="/JalaliJSCalendar-1.4/skins/aqua/theme.css" title="Aqua" /> -->
<link rel="stylesheet" type="text/css" media="all" href="/JalaliJSCalendar-1.4/skins/calendar-blue.css" title="winter" />

<script src="/js/highcharts.js"></script>
<script src="/js/highcharts-more.js"></script>
<script src="/js/bootstrap-show-password.min.js"></script>
<!-- <script src="/js/exporting.js"></script>
<script src="/js/export-data.js"></script> -->
  
<script src="/js/jalali.js"></script>
<script src="/js/calendar.js"></script>
<script src="/js/calendar-setup.js"></script>
<script src="/js/calendar-fa.js"></script>

<style type="text/css">
.calendar {
	direction: rtl;
}

#flat_calendar_1, #flat_calendar_2{
	width: 200px;
}
.example {
	padding: 10px;
}

.display_area {
	background-color: #FFFF88
}

.btn {
  border: none;
  outline: none;
  padding: 10px 16px;
  background-color: #dee2e6;
  cursor: pointer;
  font-size: 18px;
}

/* Style the active class, and buttons on mouse-over */
.active, .btn:hover {
  background-color:#a9c6e995;
  color: black;
}
</style>	

</head>


<body dir="rtl">
  @yield('content')
  
  <script src="/js/jquery-3.4.1.slim.min.js"></script>
  <script src="/js/main.js"></script>
  <script src="/js/popper.min.js "></script>
  <script src="/js/bootstrap.min.js"></script>
  
    <script>
    $(".navbar-toggle").click(function(){
    $(".navbar").slideToggle();
      });
    </script>
 

</body>
