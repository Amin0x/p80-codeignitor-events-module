<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href='/assets/css/fullcalender.min.css' rel='stylesheet' />
</head>

<body>
  <div class="aa-calender-event" id="aaCalenderEventId">

  </div>

  <script src='/assets/js/fullcalender.min.js'></script>
  <script>
    var SITEURL = "<?= base_url() ?>";
    document.addEventListener('DOMContentLoaded', function() {

      var calendarEl = document.getElementById('aaCalenderEventId');
      var calendar = new FullCalendar.Calendar(calendarEl, {
          //initialView: 'dayGridMonth',
          editable: true,
          events: SITEURL + "/calendar/events",
          displayEventTime: true,
          eventRender: function(event, element, view) {
            if (event.allDay === 'true') {
              event.allDay = true;
            } else {
              event.allDay = false;
            }
          },
        }
      ); 
      
      calendar.render();
    });


    // $(document).ready(function() {

    //   var SITEURL = "<?= base_url() ?>";
    //   var calendar = $('#aaCalenderEventId').fullCalendar({
    //     initialView: 'dayGridMonth',
    //     editable: true,
    //     events: SITEURL + "/calendar/event",
    //     displayEventTime: true,
    //     eventRender: function(event, element, view) {
    //       if (event.allDay === 'true') {
    //         event.allDay = true;
    //       } else {
    //         event.allDay = false;
    //       }
    //     },
    //   });
    // });
  </script>
</body>

</html>