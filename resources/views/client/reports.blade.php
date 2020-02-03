@extends('layouts.client', ['title' => 'گزارشات'])
@section('content')
@include('layouts.topMenu', ['routeName' => 'reports'])
<div class="container-index" style="background-image: url('/images/beautiful-drop-water.jpg');">
        <div class="row" style="margin-top:0px;">
            <div class="card text-right" style="margin:50px;justify-content: center;">
                <div class="card-header" style="text-align: right;font-size:20px;"  dir="rtl">
                  گزارشات
                </div>
                <div class="card-body">       
                     <div class="row">
                        <div class="row container justify-content-center">
                             <div class="col-sm-4 " style="text-align: right;margin:auto;">
                                  <label style="font-size:15px;">نوع گزارش </label>
                                 <select class="form-control" style="font-size: 14px; height: 40px;margin-top:5px;">
                                  <option value="0">گزارش هشدارها</option>
                                  <option value="1">گزارش سطح آب</option>
                                  <option value="2">گزارش سطح آب در ساعات مختلف یک روز</option>
                                 </select>
                             </div>
                             <div class="col-sm-3" style="width:100%;margin:auto;">
                             <label style="font-size:15px;">از تاریخ:</label>
                             <br>
                                <div ><input id="date_input_2" style="background-color:#f1f1f1;height:30px;text-align:center;"/><img id="date_btn_2" src="/images/cal.png" style="vertical-align: top;" />
                                </div>
                                 <script type="text/javascript">
                                     Calendar.setup({
                                         inputField: "date_input_2", // id of the input field
                                         button: "date_btn_2", // trigger for the calendar (button ID)
                                         ifFormat: "%Y-%m-%d", // format of the input field
                                         dateType: 'jalali',
                                         weekNumbers: false
                                     });
                                 </script> 
                            </div>
                         
                          <div class="col-sm-3" style="width:100%;margin:auto;">   
                                
                             <label style="font-size:15px;">تا تاریخ:</label> 
                             <br>
                                <div><input style="background-color:#f1f1f1;height:30px;text-align:center;" id="date_input_1"/><img id="date_btn_1" src="/images/cal.png" style="vertical-align: top;" />
                                </div>
                                <script type="text/javascript">
                                    Calendar.setup({
                                        inputField: "date_input_1", // id of the input field
                                        button: "date_btn_1", // trigger for the calendar (button ID)
                                        ifFormat: "%Y-%m-%d", // format of the input field
                                        dateType: 'jalali',
                                        weekNumbers: false
                                    });
                                </script>
                           </div>
                           
                             <div style="margin-top:30px;">
                                 <button style="width:120%;margin:auto;" class="btn btn-success customBtn" type="submit" onclick="showReport()" >نمایش گزارش</button>
                             </div>
                        </div>    
                      </div>
                 
                    </div>     
        </div>
                        <div id="firstchart" class="row container" >
                         <figure class="highcharts-figure" style="margin:50px;">
                            <div id="container"></div>
                         </figure>
                        </div>

                       <div class="row container">
                        <div id="chartSecond" style="min-width: 100% ; height: 400px; margin:10px"></div>
                       </div> 
    </div>
 </div>
            <script>
                function showReport() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("firstchart").innerHTML =
                    this.responseText;
                    }
                };
                xhttp.open("GET", "ajax_info.txt", true);
                xhttp.send();
                }
            </script>
             <!------------------------------ مربوط به نمودار اول------------------------------------>
        <script>
            var change = {
                    0: 'Very Low',
                    5: 'Low',
                    10: 'Medium',
                    15: 'High',
                    20: 'Very High'
                };
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'گزارش سطح آب در هفته '
            },
            subtitle: {
                text: 'میزان ارتفاع آب'
            },
            xAxis: {
                categories: [
                    'شنبه',
                    'یکشنبه',
                    'دوشنبه',
                    'سه شنبه',
                    'چهارشنبه',
                    'پنج شنبه',
                    'جمعه'
                    
                ],
                crosshair: true
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} m</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'ارتفاع آب',
                    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6]

                }
            ]
        });

    </script>
     <!------------------------------ مربوط به نمودار دوم------------------------------------>
    <script type="text/javascript">
        Highcharts.chart('chartSecond', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'گزارش از سطح آب در ساعات مختلف یک روز'
            },

            xAxis: {
                categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24']
            },
            yAxis: {
                title: {
                    text: 'سطح آب (m)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'میزان آب',
                data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6, 15, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }]
        });
    </script>
    <!------------------------------ مربوط به تقویم------------------------------------>    
    <script type="text/javascript">

            var oldLink = null;
            // code to change the active stylesheet
            function setActiveStyleSheet(link, title) {
              var i, a, main;
              for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
                if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title")) {
                  a.disabled = true;
                  if(a.getAttribute("title") == title) a.disabled = false;
                }
              }
              if (oldLink) oldLink.style.fontWeight = 'normal';
              oldLink = link;
              link.style.fontWeight = 'bold';
              return false;
            }

    </script>
    <script>
        
    </script>
     
 @endsection
