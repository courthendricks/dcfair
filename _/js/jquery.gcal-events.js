/*
* gCalEvents, A Google Calendar Events plugin for jQuery
* By: Michael McGlynn, http://www.reignitioninc.com
* Version: 1.0.4
* Updated: April 23rd, 2014
*
* Dual licensed under the MIT and GPL licenses.
* http://en.wikipedia.org/wiki/MIT_License
* http://en.wikipedia.org/wiki/GNU_General_Public_License
*/
(function($) {
		
	$.fn.gCalEvents=function(opt) { 
	var def = $.extend (
		{
			CalendarId:'douglascountyfair%40gmail.com',
			DateFormat: 'DayMonth',
			ShowTimes:true,
			ShowDescription:true,
			NoEventsLang:'There are currently no events scheduled.',
			TimeZone:'America/New_York',
			FutureEvents:true,
			MaxEvents: 100
		},
		opt);

		var id=$(this).attr("id"),s='',st='starttime';
		var jsonSrc = 'http://www.google.com/calendar/feeds/'+def.CalendarId.trim()+'/public/full?orderby='+st+'&sortorder=a&futureevents='+def.FutureEvents+'&max-results='+def.MaxEvents+'&ctz='+def.TimeZone.trim()+'&alt=json';
		console.log(jsonSrc);
				
		$.ajax({
			url: jsonSrc,
			dataType:"json",
			success:function(data) {
				$.each(data.feed.entry, function(e, item) {
					s+='<li class="entry">';
					s+='<h3>'+formatDate(item.gd$when[0].startTime,def.DateFormat.trim())+'</h3>'+'<h3>  |  </h3>';
					def.ShowTimes?s+='<h3>'+formatDate(item.gd$when[0].startTime,'ShortTime')+' - '+formatDate(item.gd$when[0].endTime,'ShortTime')+'</h3>':null;
					s+='<h2>Event:</h2>'+'<h2>'+item.title.$t+'</h2>';
					def.ShowDescription?s+='<div class="desc">'+item.content.$t+'</div>':null ;
					item.gd$where[0].valueString?s+='<p class="location"><span></span><span>'+item.gd$where[0].valueString+'</span></p>':null;
					s+='</li>';
				});
				$('#'+id).append(s);	
			},
			error: function (err) {
				s+='<div class="entry"><p>'+def.NoEventsLang+'</p></div>'; 
				$('#'+id).append(s);
			}
		});

		function formatDate(strDate, strFormat) {
		
			var fd,arrDate,am,time;
			var calendar = {
				months: {
					full: ['','January','February','March','April','May','June','July','August','September','October','November','December'],
					short: ['','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
				},
				days: {
					full: ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
					short: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat','Sun']
				}
			};
			
			if(strDate.length > 10) {
				arrDate = /(\d+)\-(\d+)\-(\d+)T(\d+)\:(\d+)/.exec(strDate);
				
				am 		= (arrDate[4] < 12);
				time 	= am?(parseInt(arrDate[4])+':'+arrDate[5]+' AM') : (arrDate[4]-12+':'+arrDate[5]+' PM');	

				if (time.indexOf('0') == 0) {
					if (time.indexOf(':00') == 1) {        
						if (time.indexOf('AM') == 5 ) {
							time='MIDNIGHT';
						  } else {
							 time='NOON';
						}
					} else {
						time = time.replace('0:','12:');
					}
				}

			} else {
				arrDate = /(\d+)\-(\d+)\-(\d+)/.exec(strDate);
				time = 'Time not present in feed.';
			}

			year 		= parseInt(arrDate[1]);				
			month 		= parseInt(arrDate[2]);
			dayNum 	= parseInt(arrDate[3]);
			
			// Create date object for day of week only
			// Why do you have to offset the month when you cast it?
			var d = new Date(year,month-1,dayNum);
			
			switch(strFormat)
			{
			case 'ShortTime':
				fd = time;
			break;
			case 'ShortDate':
				fd = month+'/'+dayNum+'/'+year;
			break;			
			case 'LongDate':
				fd = calendar.days.full[d.getDay()]+' '+calendar.months.full[month]+' '+dayNum+', '+year;
			break;
			case 'LongDate+ShortTime':
				fd = calendar.days.full[d.getDay()]+' '+calendar.months.full[month]+' '+dayNum+', '+year+' '+time;
			break;
			case 'ShortDate+ShortTime':
				fd = month+'/'+dayNum+'/'+year+' '+time;
			break;
			case 'DayMonth':
				fd = calendar.days.short[d.getDay()]+', '+calendar.months.full[month]+' '+dayNum;
			break;	
			case 'MonthDay':
				fd = calendar.months.full[month]+' '+dayNum;
			break;			
			case 'YearMonth':
				fd = calendar.months.full[month]+' '+year;
			break;	
			default:
				fd = calendar.days.full[d.getDay()]+' '+calendar.months.short[month]+' '+dayNum+', '+year+' '+time;
			}

			return fd;
		}
	}

}(jQuery));
