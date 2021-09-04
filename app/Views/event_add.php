<?php include ('layout/layout_top.php')?>
<div class="errors mb-2" id="aa-error-msg">
</div>
<div class="title mb-2">
    <h3>Create Event</h3>
</div>
<form action="<?php echo base_url(); ?>/events/create" method="post" id="basicForm">
    <?php echo csrf_field(); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>Basic</h4>
                    <div class="form-group">
                        <label for="eventName">Event Name</label>
                        <input type="text" class="form-control" name="event_name"
                               id="eventName" aria-describedby="helpId"
                               placeholder="event name">
                        <div class="d-none"><small class="text-danger">field must not be empty</small></div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="eventNameAr">اسم الفعالية</label>
                        <input type="text" class="form-control" name="event_name_ar"
                               id="eventNameAr" aria-describedby="helpId"
                               placeholder="event name">
                    </div>
                    <div class="form-group mt-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description"
                                  id="description" rows="6" aria-describedby="helpId"
                                  placeholder="description"></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="descriptionAr">وصف الفعالية</label>
                        <textarea class="form-control" name="description_ar"
                                  id="descriptionAr" rows="6" aria-describedby="helpId"
                                  placeholder="description"></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <div class="row">
                            <div class="col-6">
                                <label for="">Start Date</label>
                                <input type="text" class="form-control"
                                       name="start_date" id="startDate">
                            </div>
                            <div class="col-6">
                                <label for="">End Date</label>
                                <input type="text" class="form-control"
                                       name="end_date" id="endDate">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="category">Enabled</label>
                        <select type="text" class="form-control" name="enabled"
                                id="enabled">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="category">Category</label>
                        <select class="form-control" name="category" id="category">
                            <?php foreach ($category as $value) : ?>
                                <option value="<?php echo $value['id']; ?>">
                                    <?php echo $value['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                            <?php foreach ($ev_status as $value) : ?>
                                <option value="<?php echo $value['id']; ?>">
                                    <?php echo $value['status_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="status">Classification</label>
                        <select class="form-control" name="event_classification">
                            <?php foreach ($classification as $value) : ?>
                                <option value="<?php echo $value['id']; ?>">
                                    <?php echo $value['name']; ?>
                                </option>
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
                        <input type="text" class="form-control" name="manager_name"
                               id="managerName" placeholder="">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Manager Email</label>
                        <input type="text" class="form-control" name="manager_email"
                               id="managerEmail" placeholder="">
                    </div>
                    <div class="col-12 mt-2">
                        <button type="submit" id="saveEvent"
                                class="btn btn-success">Save Event
                        </button>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-md-6">
            <div class="card mt-2 mt-md-0">
                <div class="card-body">
                    <h4>Location</h4>
                    <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" class="form-control" name="location"
                               placeholder="Location">
                    </div>
                    <div class="form-group">
                        <label for="">State</label>
                        <input type="text" class="form-control" name="state"
                               placeholder="State">
                    </div>
                    <div class="form-group">
                        <label for="">City</label>
                        <input type="text" class="form-control" name="city"
                               placeholder="City">
                    </div>
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control" name="latitude"
                               placeholder="Latitude">
                    </div>
                    <div class="form-group">
                        <label for="">Longitude</label>
                        <input type="text" class="form-control" name="longitude"
                               placeholder="Longitude">
                    </div>
                    <div class="form-group">
                        <label for="">Map Region (polygon)</label>
                        <input type="text" class="form-control" name="map_region"
                               placeholder="Map Region">
                    </div>
                    <div class="mt-2">
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

<script>
    var index = 0;
    var eventId = '<?php echo $event_id; ?>';
    var baseUrl = '<?php echo base_url(); ?>';

    $(document).ready(function () {

        $('#startDate').datetimepicker();
        $('#endDate').datetimepicker();


        $('#basicForm').on('submit', function (e) {
            e.preventDefault();
            console.log($('#basicForm').serialize());
            $.post({
                url: baseUrl + '/events/create',
                data: $('#basicForm').serialize(),
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.success == true) {

                        $('#aa-error-msg').html('<div class="alert alert-success" role="alert">Event Saved successfully!</div>');
                        window.location = baseUrl + '/events/view?id=' + data.event_id;

                    } else {
                        if (data.error.title == undefined)
                            $('#eventName').addClass('is-invalid');
                        $('#aa-error-msg').html('<div class="alert alert-danger" role="alert">' + data.msg + '</div>');
                    }
                },
            });
        });


    });
</script>
<?php include ('layout/layout_bottom.php')?>