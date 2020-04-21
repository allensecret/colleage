function calendar() {
    var week = new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
    var monthdays = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    var today = new Date();
    var month = today.getMonth();
    var day = today.getDay();
    var dayN = today.getDate();
    var days = monthdays[month];
    if (month == 1) {
        var year = today.getYear();
        if (year%4 == 0) days = 29;
    }
    // return document.getElementById("cal").innerText('123');
    document.write("<table border='0' cellspacing='0' cellpadding='0'>");
    document.write("<tr>");
    for (var i=0; i<7; i++) {
        document.write("<td width='30' height='30'>");
        document.write("<div align='center'>" + week[i] + "</div>");
        document.write("</td>");
    }
    document.write("</tr>");
    var jumped = 0;
    var inserted = 1;
    var start = day - dayN%7 + 1;
    if (start < 0) start += 7;
    var weeks = parseInt((start + days)/7);
    if ((start + days)%7 != 0) weeks++;
    for (var i=weeks; i>0; i--) {
        document.write("<tr>");
        for (var j=7; j>0; j--) {
            document.write("<td>");
            if (jumped<start || inserted>days) {
                document.write("<div align='center'></div>");
                jumped++;
            }
            else {
                if (inserted == dayN) document.write("<div align='center'>[" + inserted + "]</div>");
                else document.write("<div align='center'>" + inserted + "</div>");
                inserted++;
            }
            document.write("</td>")
        }
        document.write("</tr>");
    }
    document.write("</table>");
    return "OK";
}

