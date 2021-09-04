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
                                data-sel-val="<?= $event['connected_tech'] ?>">
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>KPI</h4>
                    <?php if (isset($event_meta)): ?>
                        <?php foreach ($event_meta as $val): ?>
                            <div class="aa-kpi-row d-flex mb-2" data-kpi-id="<?= $val['id'] ?>">
                                <input type="text" class="form-control" name="option_name[]"
                                       value="<?= $val['meta_name'] ?>" style="margin-right: .3rem;" disabled>
                                <input type="text" class="form-control" name="option_val[]"
                                       value="<?= $val['kpi_value'] ?>" style="margin-left: .3rem;" disabled>
                                <button type="button" class="btn btn-danger aa-remove-kpi" style="margin-left: .6rem;">
                                    <i class="fas fa-trash-alt"></i></button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div id="aaOptionWarrper">
                    </div>
                    <div class="aa-kpi-wrapper d-flex" id="kpiWrapper">
                        <select type="text" class="form-control" name="kpi_dump" id="kpi_dump"
                                style="margin-right: .3rem;">
                            <?php foreach ($meta as $val) : ?>
                                <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" class="form-control" name="kpi_dump_val" id="kpi_dump_val"
                               placeholder="KPI Value" style="margin-left: .3rem;">
                        <button type="button" class="btn btn-success" id="aaAddOption" style="margin-left: .6rem;"><i
                                    class="fas fa-angle-right"></i></button>

                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <h4>Location</h4>
                    <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" class="form-control" name="location" value="<?= $event['location'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">State</label>
                        <input type="text" class="form-control" name="state" value="<?= $event['state'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">City</label>
                        <input type="text" class="form-control" name="city" value="<?= $event['city'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control" name="latitude" value="<?= $event['latitude'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Longitude</label>
                        <input type="text" class="form-control" name="longitude" value="<?= $event['longitude'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Map Region (polygon)</label>
                        <input type="text" class="form-control" name="map_region" value="<?= $event['map_region'] ?>">
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
    var eventId = '<?= $event['id'] ?>';

    $(document).ready(function () {

        $('#startDate').datetimepicker();
        $('#endDate').datetimepicker();

        $(document).on('click', '.aa-remove-kpi', function (e) {
            var ele = $(this).closest('.aa-kpi-row');
            var id = ele.attr('data-kpi-id');

            $.ajax({
                url: baseUrl + '/events/eventkpi/del',
                method: "POST",
                data: {id: id,},
                success: function (data, textStatus) {
                    if (data.success) {

                        ele.remove();

                        var al = $('<div class="alert alert-success position-absolute" role="alert" style="z-index:9999;top:10px; left:50%;">KPI Deleted Successfully...</div>');
                        $("body").append(al);
                        setTimeout(() => {
                            al.remove();
                        }, 3000);

                    } else {
                        var al = $('<div class="alert alert-danger position-absolute" role="alert" style="z-index:9999;top:10px; left:50%;">Error: something went wrong..</div>');
                        $("body").append(al);
                        setTimeout(() => {
                            al.remove();
                        }, 3000);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
        });

        $(document).on('click', '#aaAddOption', function (e) {
            var kpi_id = $('#kpi_dump').find(":selected").text();
            var name_val = $('#kpi_dump').find(":selected").val();
            var val = $('#kpi_dump_val').val();

            if (val != '') {


                $.ajax({
                    url: baseUrl + '/events/eventkpi',
                    method: "POST",
                    data: {kpi_id: name_val, kpi_value: val, event_id: eventId,},
                    success: function (data, textStatus) {
                        if (data.success) {

                            var html = '<div class="aa-kpi-row d-flex mb-2" data-kpi-id="' + data.kpi.id + '">';
                            html += '<input type="text" class="form-control" name="option_name[]" value="' + kpi_id + '" style="margin-right: .3rem;" disabled>';
                            html += '<input type="text" class="form-control" name="option_val[]" value="' + val + '" style="margin-left: .3rem;" disabled>';
                            html += '<button type="button" class="btn btn-danger aa-remove-kpi" style="margin-left: .6rem;"><i class="fas fa-trash-alt"></i></button>';
                            html += '</div>';
                            var ele = $(html);
                            $('#aaOptionWarrper').append(ele);

                            var al = $('<div class="alert alert-success position-absolute" role="alert" style="z-index:9999;top:10px; left:50%;">KPI Saved Successfully...</div>');
                            $("body").append(al);
                            setTimeout(() => {
                                al.remove();
                            }, 3000);

                        } else {
                            var al = $('<div class="alert alert-success position-absolute" role="alert" style="z-index:9999;top:10px; left:50%;">' + data.msg + '</div>');
                            $("body").append(al);
                            setTimeout(() => {
                                al.remove();
                            }, 3000);
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });

            }
        });

        // var start = $('#startDate').attr('data-sel-val');
        // document.getElementById('endDate').valueAsDate = start;
    });
</script>
<?php include ('layout/layout_bottom.php')?>