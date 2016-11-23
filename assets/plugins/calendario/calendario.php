<!DOCTYPE html>
<head>
    <script>
    var idmedico= "<?php echo $id; ?>" ;
    var idespecialidad= "<?php echo $esp; ?>" ;
             $(document).ready(function() {

                    $('#calendar').fullCalendar1({
                            header: {
                                    left: 'prev,next HOY',
                                    center: 'title',
                                  
                            },
                            eventLimit: true, // allow "more" link when too many events
                            events: "http://localhost:8080/practicas/SGHF/model/clases/events.php?idmedico=" + idmedico + "&idespecialidad=" + idespecialidad ,
                            
                            eventClick: function(calEvent, jsEvent,view) { alert('Especialidad: ' + calEvent.start); alert('Fecha: ' + view.title); } ,


                    });

            });
            
    
    

    </script>
   
</head>
  
            <div id='calendar'></div>
   
   

