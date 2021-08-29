<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/vendors/fontawesome/css/all.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/aamain.css">
</head>

<body style="background-color: #f7f7f7;">
    <div class="container">
        
        <div class="title">
            <h1>Create Event</h1>
        </div>
        <div class="row">
            <div id="aa-error-msg">

            </div>
            <div class="col-12 p-0">
                <button class="tablink navBasicTab" id="defaultOpen">Basic</button>
                <button class="tablink navKpiTab">KPI</button>
                <button class="tablink navAddressTab">Address</button>
            </div>

            <div class="col-12 tabcontent" id="basicTab">
                <form action="/events/add" method="post" class="d-block" id="basicForm">
                <?= csrf_field() ?>
                    <div class="card">
                        <div class="card-body">
                            <h4>Basic</h4>
                            <div class="form-group">
                                <label for="eventName">Event Name</label>
                                <input type="text" class="form-control" name="event_name" id="eventName" aria-describedby="helpId" placeholder="event name">
                            </div>
                            <div class="form-group mt-2">
                                <label for="eventNameAr">اسم الفعالية</label>
                                <input type="text" class="form-control" name="event_name_ar" id="eventNameAr" aria-describedby="helpId" placeholder="event name">
                            </div>
                            <div class="form-group mt-2">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" row="6" aria-describedby="helpId" placeholder="description"></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="descriptionAr">وصف الفعالية</label>
                                <textarea class="form-control" name="description_ar" id="descriptionAr" row="6" aria-describedby="helpId" placeholder="description"></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Start Date</label>
                                        <input type="datetime-local" class="form-control" name="start_date" id="startDate">
                                    </div>
                                    <div class="col-6">
                                        <label for="">End Date</label>
                                        <input type="datetime-local" class="form-control" name="end_date" id="endDate">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Location</label>
                                <input type="text" class="form-control" name="location" id="location" aria-describedby="helpId" placeholder="location">
                            </div>

                            <div class="form-group mt-2">
                                <label for="category">Category</label>
                                <select type="text" class="form-control" name="category" id="category" aria-describedby="helpId" placeholder="">
                                    <?php foreach ($category as $value) : ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="status">Status</label>
                                <select type="text" class="form-control" name="status" aria-describedby="helpId" placeholder="">
                                    <?php foreach ($ev_status as $value) : ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['status_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="status">Classification</label>
                                <select type="text" class="form-control" name="event_classification" aria-describedby="helpId" placeholder="">
                                    <?php foreach ($classification as $value) : ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="status">Connected to tech</label>
                                <select type="text" class="form-control" name="connected_tech" aria-describedby="helpId" placeholder="">
                                    <option value="no">no</option>
                                    <option value="yes">yes</option>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="">Manager Name</label>
                                <input type="text" class="form-control" name="manager_name" id="managerName" aria-describedby="helpId" placeholder="">
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Manager Email</label>
                                <input type="text" class="form-control" name="manager_email" id="managerEmail" aria-describedby="helpId" placeholder="">
                            </div>
                            <div class="col-12 mt-2"><button type="button" id="saveEvent" class="btn btn-success">Save Event</button></div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 tabcontent" id="kpiTab">
                <form action="/events/kpi" id="kpiForm">
                <?= csrf_field() ?>
                    <div class="card">
                        <div class="card-body">
                            
                            <h4>KPI</h4>
                            <hr>
                            <div class="mt-2"><strong>Added KPI to Event:</strong></div>
                            <table class="table">
                                <thead>
                                    <th>KPI Name</th>
                                    <th>Value</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>test</td>
                                        <td>test</td>
                                        <td><button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div><strong>Add new KPI:</strong></div>
                            <div class="aa-kpi-wrapper row" id="kpiWrapper">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="kpi0">KPI Name</label>
                                    <select type="text" class="form-control" name="kpi_list" id="kpi0" placeholder="">
                                        <?php foreach ($ev_kpis as $ev_kpi) : ?>
                                            <option value="<?php echo $ev_kpi['id']; ?>"><?php echo $ev_kpi['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="kpi0">KPI Value</label>
                                    <input type="text" class="form-control" name="kpi_val" id="kpiVal0" placeholder="">
                                </div>
                                <hr>
                            </div>
                            <button type="button" name="add_kpi" id="addKpiBtn" class="btn btn-primary">add KPI</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 tabcontent" id="addressTab">
                <form action="/events/address" id="addressForm">
                <?= csrf_field() ?>
                    <div class="card mt-2">
                        <div class="card-body">
                            <h4>Location</h4>
                            <div class="form-group">
                                <label for="">Location</label>
                                <input type="text" class="form-control" name="location" placeholder="Location">
                            </div>
                            <div class="form-group">
                                <label for="">State</label>
                                <input type="text" class="form-control" name="state" placeholder="State">
                            </div>
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" class="form-control" name="city" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="">Latitude</label>
                                <input type="text" class="form-control" name="latitude" placeholder="Latitude">
                            </div>
                            <div class="form-group">
                                <label for="">Longitude</label>
                                <input type="text" class="form-control" name="longitude" placeholder="Longitude">
                            </div>
                            <div class="form-group">
                                <label for="">Map Region (polygon)</label>
                                <input type="text" class="form-control" name="map_region" placeholder="Map Region">
                            </div>
                            <div class="mt-2">
                                <button type="button" id="saveAddress" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.js"></script>
    <script>
        var index = 0;
        var eventId = '<?php echo $event_id; ?>';
        var baseUrl = '<?php echo base_url(); ?>';


        $(function(e) {

            $('#addKpiBtn').on('click', function(e) {
                e.preventDefault();
                if (eventId == undefined || eventId == 0) {
                    $('#aa-error-msg').html('<div class="alert alert-danger" role="alert">Save the Event First!</div>');
                    return false;
                }
                $.post({
                    url: baseUrl + '/events/kpi',
                    data: $('#kpiForm').serialize() + '&event_id=' + eventId,
                    dataType: 'json',
                    success: function(data, textStatus) {
                        console.log(data);
                        $('#aa-error-msg').html('<div class="alert alert-success" role="alert">KPI Saved successfully!</div>');
                    },
                });
            });

            $('#saveEvent').on('click', function(e) {

                $.post({
                    url: baseUrl + '/events/add',
                    data: $('#basicForm').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        if(data.success == true){
                            eventId = data.id;
                            $('#aa-error-msg').html('<div class="alert alert-success" role="alert">Event Saved successfully!</div>');

                        } else {
                            $('#aa-error-msg').html('<div class="alert alert-danger" role="alert">'+ data.msg +'</div>');
                        }
                    },
                });
            });

            $('#saveAddress').on('click', function(e) {
                e.preventDefault();
                if (eventId == undefined || eventId == 0) {
                    $('.aa-error-msg').html('<div class="alert alert-danger" role="alert">Save the Event First!</div>');
                    return false;
                }
                $.post({
                    url: baseUrl + "/events/address",
                    data: $('#addressForm').serialize() + '&event_id=' + eventId,
                    dataType: 'json',
                    success: function(data) {
                        $('.aa-error-msg').html('<div class="alert alert-success" role="alert">Address Saved successfully!</div>');
                    },
                });
            });

            $('.tablink.navBasicTab').on('click', function(e){
                openPage('basicTab', $(this));
            });
            $('.tablink.navKpiTab').on('click', function(e){
                openPage('kpiTab', $(this));
            });
            $('.tablink.navAddressTab').on('click', function(e){
                openPage('addressTab', $(this));
            });

            $("#defaultOpen").click();
        });
    </script>

    <script>
        function openPage(pageName, elmnt) {
            
            // Hide all elements with class="tabcontent" by default */
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Remove the background color of all tablinks/buttons
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }

            // Show the specific tab content
            document.getElementById(pageName).style.display = "block";

            // Add the specific color to the button used to open the tab content
            elmnt.style.backgroundColor = '#eaeaff';
            elmnt.style.color = '#000';
        }

        
    </script>
</body>

</html>