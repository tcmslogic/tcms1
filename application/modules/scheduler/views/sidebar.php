<?php



include 'classes/calendar.php';
 
$month = isset($_GET['m']) ? $_GET['m'] : NULL;
$year  = isset($_GET['y']) ? $_GET['y'] : NULL;
 
$calendar = Calendar::factory($month, $year);
 
$event1 = $calendar->event()
    ->condition('timestamp', strtotime(date('F').' 21, '.date('Y')))
    ->title('Hello All')
    ->output('<a href="http://google.com">Going to Google</a>');
     
$event2 = $calendar->event()
    ->condition('timestamp', strtotime(date('F').' 21, '.date('Y')))
    ->title('Something Awesome')
    ->output('<a href="http://coreyworrell.com">My Portfolio</a><br />It\'s pretty cool in there.');
 
$calendar->standard('today')
    ->standard('prev-next')
    ->standard('holidays')
    ->attach($event1)
    ->attach($event2);
?>
<script>
	function next_month(year, month){
	    jQuery('#calendar').fullCalendar('gotoDate', new Date(year, month));
	}
</script>

<!---------------------First Month Calendar------------------>
<script type="text/javascript">
function setStyle(id,style,value)
{
    id.style[style] = value;
}
function opacity(el,opacity)
{
        setStyle(el,"filter:","alpha(opacity="+opacity+")");
        setStyle(el,"-moz-opacity",opacity/100);
        setStyle(el,"-khtml-opacity",opacity/100);
        setStyle(el,"opacity",opacity/100);
}
function calendar(days)
{ 						
		var string = days;
		var days = new Array();
		days = string.split(",");		
		
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getYear();
        if(year<=200)
        {
                year += 1900;
        }
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        days_in_month = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
        if(year%4 == 0 && year!=1900)
        {
                days_in_month[1]=29;
        }
        total = days_in_month[month];
        var date_today = months[month]+' '+year;
        beg_j = date;
        beg_j.setDate(1);
        if(beg_j.getDate()==2)
        {
                beg_j=setDate(0);
        }
        beg_j = beg_j.getDay();
        document.write('<table onclick="next_month('+year+','+ month+')" class="cal_calendar" onload="opacity(document.getElementById(\'cal_body\'),20);" style="cursor:pointer;"><tbody id="cal_body"><tr><th colspan="7"><a style="cursor:pointer;" onclick="next_month('+year+','+ month+')">'+date_today+'</a></th></tr>');
        document.write('<tr class="cal_d_weeks"><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr><tr>');
        week = 0;
		
        for(i=1;i<=beg_j;i++)
        {
                document.write('<td class="cal_days_bef_aft">'+(days_in_month[month-1]-beg_j+i)+'</td>');
                week++;
        }
		var k=0;
        for(i=1;i<=total;i++)
        { 
                if(week==0)
                {
                        document.write('<tr>');
                }
                if(day==i)
                {
                        document.write('<td class="cal_today">'+i+'</td>');
                }
                else
                {	
						if(days[k]==i){ document.write('<td style="color:#000;"><b>'+i+'</b></td>'); k++;}
						else{ document.write('<td>'+i+'</td>'); }						
                }
                week++;
                if(week==7)
                {
                        document.write('</tr>');
                        week=0;
                }
        }
        for(i=1;week!=0;i++)
        {
                document.write('<td class="cal_days_bef_aft">'+i+'</td>');
                week++;
                if(week==7)
                {
                        document.write('</tr>');
                        week=0;
                }
        }
        document.write('</tbody></table>');
        //opacity(document.getElementById('cal_body'),70);
        return true;
}
</script>
<!---------------------End of First Calendar----------------->

<!---------------------Next Month Calendar------------------->
<script type="text/javascript">
function setStyle_next(id,style,value)
{
    id.style[style] = value;
}
function opacity_next(el,opacity)
{
        setStyle(el,"filter:","alpha(opacity="+opacity+")");
        setStyle(el,"-moz-opacity",opacity/100);
        setStyle(el,"-khtml-opacity",opacity/100);
        setStyle(el,"opacity",opacity/100);
}
function calendar_next(days)
{ 
		var string = days;
		var days = new Array();
		days = string.split(",");
		
        var date = new Date();
		var nm = date.getMonth();
		var date = new Date(date.setMonth(nm+1));			  
        var day = date.getDate();
        var month = date.getMonth(); 
        var year = date.getYear();
        if(year<=200)
        {
                year += 1900;
        }
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        days_in_month = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
        if(year%4 == 0 && year!=1900)
        {
                days_in_month[1]=29;
        }
        total = days_in_month[month];
        var date_today = months[month]+' '+year;
        beg_j = date;
        beg_j.setDate(1);
        if(beg_j.getDate()==2)
        {
                beg_j=setDate(0);
        }
        beg_j = beg_j.getDay();
        document.write('<table onclick="next_month('+year+','+ month+')" class="cal_calendar" onload="opacity(document.getElementById(\'cal_body\'),20);" style="cursor:pointer;"><tbody id="cal_body"><tr><th colspan="7"><a style="cursor:pointer;" onclick="next_month('+year+','+ month+')">'+date_today+'</a></th></tr>');
        document.write('<tr class="cal_d_weeks"><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr><tr>');
        week = 0;
        for(i=1;i<=beg_j;i++)
        {
                document.write('<td class="cal_days_bef_aft">'+(days_in_month[month-1]-beg_j+i)+'</td>');
                week++;
        }
		var k=0;
        for(i=1;i<=total;i++)
        {
                if(week==0)
                {
                        document.write('<tr>');
                }
                if(day==i)
                {
                        document.write('<td>'+i+'</td>');
                }
                else
                {
                        if(days[k]==i){ document.write('<td style="color:#000;"><b>'+i+'</b></td>'); k++;}
						else{ document.write('<td>'+i+'</td>'); }
                }
                week++;
                if(week==7)
                {
                        document.write('</tr>');
                        week=0;
                }
        }
        for(i=1;week!=0;i++)
        {
                document.write('<td class="cal_days_bef_aft">'+i+'</td>');
                week++;
                if(week==7)
                {
                        document.write('</tr>');
                        week=0;
                }
        }
        document.write('</tbody></table>');
        //opacity(document.getElementById('cal_body'),70);
        return true;
}
</script>
<!---------------------End of Next Month Ca------------------>

<!-------------------2 Next Month Calendar------------------->
<script type="text/javascript">
function setStyle_next_to(id,style,value)
{
    id.style[style] = value;
}
function opacity_next_to(el,opacity)
{
        setStyle(el,"filter:","alpha(opacity="+opacity+")");
        setStyle(el,"-moz-opacity",opacity/100);
        setStyle(el,"-khtml-opacity",opacity/100);
        setStyle(el,"opacity",opacity/100);
}
function calendar_next_to(days)
{ 
		var string = days;
		var days = new Array();
		days = string.split(",");
		
        var date = new Date();
		var nm = date.getMonth();
		var date = new Date(date.setMonth(nm+2));			  
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getYear();
        if(year<=200)
        {
                year += 1900;
        }
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        days_in_month = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
        if(year%4 == 0 && year!=1900)
        {
                days_in_month[1]=29;
        }
        total = days_in_month[month];
        var date_today = months[month]+' '+year;
        beg_j = date;
        beg_j.setDate(1);
        if(beg_j.getDate()==2)
        {
                beg_j=setDate(0);
        }
        beg_j = beg_j.getDay();
        document.write('<table onclick="next_month('+year+','+ month+')" class="cal_calendar" onload="opacity(document.getElementById(\'cal_body\'),20);" style="cursor:pointer;"><tbody id="cal_body"><tr><th colspan="7"><a style="cursor:pointer;" onclick="next_month('+year+','+ month+')">'+date_today+'</a></th></tr>');
        document.write('<tr class="cal_d_weeks"><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr><tr>');
        week = 0;
        for(i=1;i<=beg_j;i++)
        {
                document.write('<td class="cal_days_bef_aft">'+(days_in_month[month-1]-beg_j+i)+'</td>');
                week++;
        }
		var k=0;
        for(i=1;i<=total;i++)
        {
                if(week==0)
                {
                        document.write('<tr>');
                }
                if(day==i)
                {
                        document.write('<td>'+i+'</td>');
                }
                else
                {
                        if(days[k]==i){ document.write('<td style="color:#000;"><b>'+i+'</b></td>'); k++;}
						else{ document.write('<td>'+i+'</td>'); }
                }
                week++;
                if(week==7)
                {
                        document.write('</tr>');
                        week=0;
                }
        }
        for(i=1;week!=0;i++)
        {
                document.write('<td class="cal_days_bef_aft">'+i+'</td>');
                week++;
                if(week==7)
                {
                        document.write('</tr>');
                        week=0;
                }
        }
        document.write('</tbody></table>');
        //opacity(document.getElementById('cal_body'),70);
        return true;
}
</script>
<!-------------------End of 2 Next Month Ca------------------>

<div class="leftpanel-cal">
			
		<div class="float-left">
        <?php $days = $this->mdl_scheduler->getHolidaysNW(date('m', strtotime(date('Y-m-d'))),date('Y')); ?>
			<script type="text/javascript">
            calendar('<?php echo $days; ?>');
        </script>
		</div>
        
        <div class="float-left">
        <?php $days = $this->mdl_scheduler->getHolidaysNW(date('m', strtotime('+1 month')),date('Y')); ?>
			<script type="text/javascript">
            calendar_next('<?php echo $days; ?>');
        </script>
		</div>
        
        <div class="float-left">
        <?php $days = $this->mdl_scheduler->getHolidaysNW(date('m', strtotime('+2 month')),date('Y')); ?>
			<script type="text/javascript">
            calendar_next_to('<?php echo $days; ?>');
        </script>
		</div>

</div>