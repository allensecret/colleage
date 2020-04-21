@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .image {
            border-radius: 10px;
            background-color: rgb(246, 244, 239);
            height: 200px;
            width: 240px;
        }

        h3{
            font-size: 1.7rem;
            color: rgba(0,0,0, 0.7) ;
            font-family: 'DFXingShuStd-W5';
        }

        .monthNow th{
            background-color: #908f8d !important;
        }

        .dayNames td{
            background-color: #908f8d !important;
        }
        .monthNow{
            color:black !important;
        }

        .calendar{
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="/css/frontplatform/calendar.css">
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            var dateNow = new Date();
            $('.image').each(function (index) {
                var htmlContent ="";
                var FebNumberOfDays ="";
                var counter = 1;

                var dateNow = new Date();
                var month = index+3;
                if(index > 8){
                    month = month-12;
                }
                var day = dateNow.getDate();
                var this_month = dateNow.getMonth();
                // console.log(dateNow.getMonth());
                if((dateNow.getMonth()+1) > 3){
                    var year = dateNow.getFullYear();
                }else{
                    var year = dateNow.getFullYear()-1;
                }
                if(index > 8){
                    year += 1;
                }


                var nextMonth = month+1;
                var prevMonth = month -1;


                //Determing if February (28,or 29)
                if (month == 1){
                    if ( (year%100!=0) && (year%4==0) || (year%400==0)){
                        FebNumberOfDays = 29;
                    }else{
                        FebNumberOfDays = 28;
                    }
                }

                // names of months and week days.
                var monthNames = ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月", "十二月"];
                var dayNames = ["日","一","二","三","四","五", "六"];
                var dayPerMonth = ["31", ""+FebNumberOfDays+"","31","30","31","30","31","31","30","31","30","31"];
                var monthEN = ["January","February","March","April","May","June","July","August","September","October","November","December"];

                // days in previous month and next one , and day of week.
                var nextDate = new Date(monthEN[nextMonth-1]+" 1 ,"+year);
                var weekdays= nextDate.getDay();
                var weekdays2 = weekdays;
                var numOfDays = dayPerMonth[month];
                // console.log(nextDate.isValid());
                // this leave a white space for days of pervious month.
                while (weekdays>0){
                    htmlContent += "<td class='monthPre'></td>";
                    weekdays--;
                }
                // loop to build the calendar body.
                while (counter <= numOfDays){
                    // When to start new line.
                    // console.log(weekdays2);
                    if (weekdays2 > 6){
                        weekdays2 = 0;
                        htmlContent += "</tr><tr>";
                    }
                    // if counter is current day.
                    // highlight current day using the CSS defined in header.
                    if (counter == day && this_month == month){
                        htmlContent +="<td class='dayNow'>"+counter+"</td>";
                    }else{
                        htmlContent +="<td class='monthNow'>"+counter+"</td>";
                    }
                    weekdays2++;
                    counter++;
                }

                // building the calendar html body.
                var calendarBody = "<table class='calendar'> " +
                    "<tr class='monthNow'>" +
                    "<th colspan='7'>" +monthNames[month]+" "+ year +"" +
                    "</th>" +
                    "</tr>";
                calendarBody +="<tr class='dayNames'>  <td>"+dayNames[0]+"</td>  <td>"+dayNames[1]+"</td> <td>"+dayNames[2]+"</td>"+ "<td>"+dayNames[3]+"</td> <td>"+dayNames[4]+"</td> <td>"+dayNames[5]+"</td> <td>"+dayNames[6]+"</td> </tr>";
                calendarBody += "<tr>";
                calendarBody += htmlContent;
                calendarBody += "</tr>"+"</table>";
                // set the content of div .

                $(this).append(calendarBody);
            });

        });

    </script>
@endpush
@section('content')
<div class="row div-content">
    <div class="col-12 text-center" style="font-size: 1.3rem;">
        <div class="d-flex justify-content-center flex-wrap text-center nav_div">
            <div class="p-2">
                <a class="guide_link font-DFXing" href="{{ route('guide') }}" style="font-family:S5KFMM;">入學指導</a><span class="divider"></span>
            </div>
            @if(!\Illuminate\Support\Facades\Auth::check())
            <div class="p-2">
                <a class="guide_link font-DFXing" href="{{ route('registration.index') }}" style="font-family:S5DUZF;">註冊報名</a><span class="divider"></span>
            </div>
            @endif
            <div class="p-2">
                <a class="guide_link font-DFXing" href="{{ route('course_introduction') }}" style="font-family:S5JUVK;">課程介紹</a><span class="divider"></span>
            </div>
            <div class="p-2">
                <a class="guide_link font-DFXing active" href="{{ route('calendar') }}" style="font-family:S5DSSU;">年度行事曆</a>
            </div>
        </div>
    </div>
    <div class="col-12 pb-5">
        <h1 style="font-family:S5DSSU;">年度行事曆</h1>
    </div>
    @for($i=0;$i<12;$i++)
        <div class="col-12 pt-4" style="border-bottom: 2px rgba(0,0,0,0.6) dashed">
            <div class="row pb-4">
                <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                    <div class="image text-right" id="calendar{{ $i }}" style="margin: 0 auto;"></div>
                </div>
                <div class="col-12 col-sm-6 col-md-7 col-lg-8 col-xl-9">
                    <h3>待辦事項</h3>
                    {!! $data[$i]->list !!}
                </div>
            </div>
        </div>
    @endfor

</div>
@endsection
