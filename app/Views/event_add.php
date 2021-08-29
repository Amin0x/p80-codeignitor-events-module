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
            <form action="<?= base_url() ?>/events/create" method="post" id="basicForm">
            <?= csrf_field() ?>
            <div class="row" id="aa-error-msg">

            </div>
        <div class="row">
            <div class="col-12 p-0">
                <button type="button" class="tablink" id="navBasicTab">Basic</button>
                <button type="button" class="tablink" id="navAddressTab">Address</button>
                <button type="button" class="tablink" id="navKpiTab">Event KPI</button>
            </div>

            <div class="col-12 tabcontent" id="basicTab">
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
                                <textarea class="form-control" name="description" id="description" rows="6" aria-describedby="helpId" placeholder="description"></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="descriptionAr">وصف الفعالية</label>
                                <textarea class="form-control" name="description_ar" id="descriptionAr" rows="6" aria-describedby="helpId" placeholder="description"></textarea>
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
                                <input type="text" class="form-control" name="location" id="location" placeholder="location">
                            </div>

                            <div class="form-group mt-2">
                                <label for="category">Category</label>
                                <select class="form-control" name="category" id="category">
                                    <?php foreach ($category as $value) : ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="status">Status</label>
                                <select class="form-control" name="status">
                                    <?php foreach ($ev_status as $value) : ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['status_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="status">Classification</label>
                                <select class="form-control" name="event_classification">
                                    <?php foreach ($classification as $value) : ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="status">Connected to tech</label>
                                <select class="form-control" name="connected_tech">
                                    <option value="no">no</option>
                                    <option value="yes">yes</option>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="">Manager Name</label>
                                <input type="text" class="form-control" name="manager_name" id="managerName" placeholder="">
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Manager Email</label>
                                <input type="text" class="form-control" name="manager_email" id="managerEmail" placeholder="">
                            </div>
                            <div class="col-12 mt-2"><button type="button" id="saveEvent" class="btn btn-success">Save Event</button></div>
                        </div>
                    </div>
                
            </div>

            <div class="col-12 tabcontent" id="kpiTab">
                    <div class="card">
                        <div class="card-body">
                            
                            <h4>KPI</h4>
                            <hr>
                            <div class="mt-2"><strong>Added KPI to Event:</strong></div>
                            <table class="table" id="kpiTable">
                            
                                <th>KPI Name</th>
                                <th>Value</th>
                                <th>Remove</th>                         
                               
                            </table>
                            <hr>
                            <div><strong>Add new KPI:</strong></div>
                            <div class="aa-kpi-wrapper row" id="kpiWrapper">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="kpi0">KPI Name</label>
                                    <select class="form-control" name="kpi_list" id="kpiName">
                                        <?php foreach ($ev_kpis as $ev_kpi) : ?>
                                            <option value="<?php echo $ev_kpi['id']; ?>"><?php echo $ev_kpi['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="kpi0">KPI Value</label>
                                    <input type="text" class="form-control" name="kpi_val" id="kpiVal" placeholder="Value">
                                </div>
                                <hr>
                            </div>
                            <button type="button" name="add_kpi" id="addKpiBtn" class="btn btn-primary">add KPI</button>
                        </div>
                    </div>
            </div>
            <div class="col-12 tabcontent" id="addressTab">
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
                            </div>
                        </div>
                    </div>
            </div>

        </div>
            </form>

    </div>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.js"></script>
    <script>
        var index = 0;
        var eventId = '<?php echo $event_id; ?>';
        var baseUrl = '<?php echo base_url(); ?>';


        $(document).ready(function() {

            $('#addKpiBtn').on('click', function(e) {
                e.preventDefault();
                var kpiName = $('#kpiName option:selected').text();
                var kpiNameVal = $('#kpiName option:selected').val();
                var kpiVal = $('#kpiVal').val();
                
                $("#kpiTable tbody").append("<tr><td>"+kpiName+"</td><td>"+kpiVal+"</td><td><input type=\"hidden\" name=\"kpiname[]\" value=\""+kpiNameVal+"\"><input type=\"hidden\" name=\"kpival[]\" value=\""+kpiVal+"\"><button  type=\"button\" class=\"btn btn-danger btn-sm aa-remove-kpi\"><i class=\"far fa-trash-alt\"></i></button></td></tr>");
            });

            $('.aa-remove-kpi').on('click', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();

            });

            $('#basicForm').on('submit', function(e) {
                e.preventDefault();
                $.post({
                    url: baseUrl + '/events/create',
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

            
            function openPage(pageName, elmnt) {
            
                // Hide all elements with class="tabcontent" by default */
                var i, tabcontent, tablinks;
                tabcontent = $(".tabcontent");            
                tabcontent.hide();
                

                // Remove the background color of all tablinks/buttons
                tablinks = $(".tablink");
                tablinks.css("background-color", "");

                // Show the specific tab content
                $(pageName).show();

                // Add the specific color to the button used to open the tab content
                elmnt.css("background-color", "#eaeaff");
                elmnt.css("color", "#000");
            }

            $('#navBasicTab').on('click', function(e){
                e.preventDefault();
                openPage('#basicTab', $(this));
            });
            $('#navKpiTab').on('click', function(e){
                e.preventDefault();
                openPage('#kpiTab', $(this));
            });
            $('#navAddressTab').on('click', function(e){
                e.preventDefault();
                openPage('#addressTab', $(this));
            });

            $("#navBasicTab").click();

        });
    </script>

    
</body>

</html>