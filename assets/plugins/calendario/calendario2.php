<!DOCTYPE html>
<html>
<head>

<script>
 
	$(document).ready(function() {
		
		$('#calendar').fullCalendar1({
			header: {
				left: 'prev,next today',
				center: 'title',
				
			},
			
			
			eventLimit: true, // allow "more" link when too many events
			
		});
		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>
</head>
<body>

	<div id='calendar'></div>

</body>
</html>
