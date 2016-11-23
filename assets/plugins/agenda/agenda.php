<!DOCTYPE html>
<head>
<script>

	$(document).ready(function() {
		
		$('#other').fullCalendar({
		
		
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
                                var title = prompt('Ingrese Cita:');
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					$('#other').fullCalendar('renderEvent', eventData, true); // stick? = true
				}
				$('#other').fullCalendar('unselect');
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events
                       
			
		});
		
	});

</script>



</head>
 
    <div id='other'></div>  



 
      


