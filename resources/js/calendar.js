$(document).ready(function () {
    var htmlContent ="";
    var FebNumberOfDays ="";
    var counter = 1;


    var dateNow = new Date();
    var month = 10; //dateNow.getMonth()
    var day = dateNow.getDate();
    var year = dateNow.getFullYear();

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


    // days in previous month and next one , and day of week.
    var nextDate = new Date(nextMonth +' 1 ,'+year);
    var weekdays= nextDate.getDay();
    var weekdays2 = weekdays;
    var numOfDays = dayPerMonth[month];

    // this leave a white space for days of pervious month.
    while (weekdays>0){
        htmlContent += "<td class='monthPre'></td>";
        weekdays--;
    }

    // loop to build the calendar body.
    while (counter <= numOfDays){
        // When to start new line.
        if (weekdays2 > 6){
            weekdays2 = 0;
            htmlContent += "</tr><tr>";
        }
        // if counter is current day.
        // highlight current day using the CSS defined in header.
        if (counter == day){
            htmlContent +="<td class='dayNow'>"+counter+"</td>";
            // onMouseOver='this.style.background=\"#FFFF00\"; this.style.color=\"#FFFFFF\"' "+ "onMouseOut='this.style.background=\"#FFFFFF\"; this.style.color=\"#00FF00\"'
        }else{
            htmlContent +="<td class='monthNow'>"+counter+"</td>";
            // onMouseOver='this.style.background=\"#FFFF00\"'"+ " onMouseOut='this.style.background=\"#FFFFFF\"'
        }
        weekdays2++;
        counter++;
    }

    // building the calendar html body.
    var calendarBody = "<table class='calendar'> <tr class='monthNow'><th colspan='7'>" +monthNames[month]+" "+ year +"</th></tr>";
    calendarBody +="<tr class='dayNames'>  <td>"+dayNames[0]+"</td>  <td>"+dayNames[1]+"</td> <td>"+dayNames[2]+"</td>"+ "<td>"+dayNames[3]+"</td> <td>"+dayNames[4]+"</td> <td>"+dayNames[5]+"</td> <td>"+dayNames[6]+"</td> </tr>";
    calendarBody += "<tr>";
    calendarBody += htmlContent;
    calendarBody += "</tr></table>";
    // set the content of div .
    $('#calendar1').append(calendarBody);
});
