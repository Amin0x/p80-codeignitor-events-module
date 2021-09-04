<?php include ('layout/layout_top.php')?>
<div class="container">
    <div class="row">
        <div class="h4">Calendar</div>
        <div id="aaCalenderEventId"></div>
    </div>
</div>

<script>
    var SITEURL = "<?php echo base_url(); ?>";

    document.addEventListener('DOMContentLoaded', function () {

        var calendarEl = document.getElementById('aaCalenderEventId');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            events: {
                url: SITEURL + "/calendar/events"
            },

        });

        calendar.render();
    });
</script>
<?php include ('layout/layout_bottom.php')?>