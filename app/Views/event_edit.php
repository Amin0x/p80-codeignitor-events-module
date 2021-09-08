<?php include ('layout/layout_top.php')?>
<form action="/events/edit?id=<?= $event['id'] ?>" method="post" class="d-block" id="myForm">
    <?php echo csrf_field(); ?>
    <?php if (isset($success) && $success == true): ?>
        <div class="alert alert-success" role="alert">
            event updated
        </div>
    <?php elseif (isset($success)): ?>
        <div class="alert alert-danger" role="alert">
            error: cant update event.
        </div>
    <?php endif; ?>
    <div class="title mb-2">
        <h3>Edit Event</h3>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>Basic</h4>
                    <div class="form-group">
                        <label for="eventName">Event Name</label>
                        <input type="text" class="form-control" name="event_name" id="eventName"
                               value="<?= $event['title'] ?>" placeholder="event name">
                    </div>
                    <div class="form-group mt-2">
                        <label for="eventNameAr">اسم الفعالية</label>
                        <input type="text" class="form-control" name="event_name_ar" id="eventNameAr"
                               value="<?= $event['tite_ar'] ?>" placeholder="event name">
                    </div>
                    <div class="form-group mt-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" row="6"
                                  placeholder="description"><?= $event['description'] ?></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="descriptionAr">وصف الفعالية</label>
                        <textarea class="form-control" name="description_ar" id="descriptionAr" row="6"
                                  placeholder="description"><?= $event['description_ar'] ?></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <div class="row">
                            <div class="col-6">
                                <label for="">Start Date</label>
                                <input type="text" class="form-control datetimepicker" name="start_date" id="startDate"
                                       value="<?= date('Y-m-d H:i', strtotime($event['start_date'])) ?>">
                            </div>
                            <div class="col-6">
                                <label for="">End Date</label>
                                <input type="text" class="form-control datetimepicker" name="end_date" id="endDate"
                                       value="<?= date('Y-m-d H:i', strtotime($event['end_date'])) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="category">Enabled</label>
                        <select class="form-control" name="enabled" id="enabled"
                                data-sel-val="<?= $event['category_id'] ?>">
                            <option value="0" <?php if ($event['enabled'] == 0) echo 'selected'; ?>>No</option>
                            <option value="1" <?php if ($event['enabled'] == 1) echo 'selected'; ?>>Yes</option>
                        </select>
                    </div>


                    <div class="form-group mt-2">
                        <label for="category">Category</label>
                        <select class="form-control" name="category" id="category"
                                data-sel-val="<?= $event['category_id'] ?>">
                            <?php foreach ($categories as $value) : ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" data-sel-val="<?= $event['staus_id'] ?>">
                            <?php foreach ($ev_status as $value) : ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['status_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="status">Classification</label>
                        <select type="text" class="form-control" name="event_classification"
                                data-sel-val="<?= $event['classification_id'] ?>">
                            <?php foreach ($classifications as $value) : ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="status">Connected to tech</label>
                        <select type="text" class="form-control" name="connected_tech"
                                data-sel-val="<?php echo $event['connected_tech']; ?>">
                            <option value="no">no</option>
                            <option value="yes">yes</option>
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <label for="">Manager Name</label>
                        <input type="text" class="form-control" name="manager_name" id="managerName"
                               value="<?= $event['manager_name'] ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Manager Email</label>
                        <input type="text" class="form-control" name="manager_email" id="managerEmail"
                               value="<?= $event['manager_email'] ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-success">Send</button>
        </div>
    </div>
</form>


<script>
    var baseUrl = '<?= base_url() ?>';


    $(document).ready(function () {

        $('#startDate').datetimepicker();
        $('#endDate').datetimepicker();





        // var start = $('#startDate').attr('data-sel-val');
        // document.getElementById('endDate').valueAsDate = start;
    });
</script>
<?php include ('layout/layout_bottom.php')?>