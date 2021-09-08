<?php include ('layout/layout_top.php')?>
<div class="row">
    <div class="col-12">
        <div class="title mb-2">
            <h3>Event View</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5><?php echo $event['title']; ?></h5>
                    <div>
                        <a href="<?php echo base_url('/events/'. $event['id'].'/kpi'); ?>" class="btn btn-outline-light" role="button">Events KPIs</a>
                        <a href="<?php echo base_url('/events/edit?id=' . $event['id']); ?>" class="btn btn-outline-dark" role="button">Edit</a>
                    </div>
                </div>
                <p><strong>Description:</strong></p>
                <p><?= $event['description'] ?></p>
                <p><strong>Start Date:</strong> <?php echo $event['start_date']; ?></p>
                <p><strong>End Date:</strong> <?php echo $event['end_date']; ?></p>
                <p><strong>Enabled:</strong> <?php echo $event['enabled'] ? 'Yes' : 'No'; ?></p>
                <p><strong>Connected To Technology:</strong> <?php echo $event['connected_tech'] ? 'Yes' : 'No'; ?></p>
            </div>
        </div>


    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">

        </div>
        <div class="card bg-light">
            <div class="card-body">
                <div class="aa-pki-msg"></div>
                <div class="aa-pki-list">
                    <table class="table" id="aaPKIList">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>KPI Name</th>
                            <th>Updating Period</th>
                            <th>Input Type</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="aaKpiWrapper">

                        <?php foreach ($event_kips as $kpi): ?>
                            <tr data-kpi-id="<?php echo $kpi['id']; ?>">
                                <td><?php echo $kpi['id']; ?></td>
                                <td><?php echo $kpi['name']; ?></td>
                                <td><?php echo $kpi['frequent_update']; ?></td>
                                <td><?php echo $kpi['input_type']; ?></td>

                                <td>
                                    <a href="<?php echo base_url().'/events/'.$event['id'].'/kpi/'.$kpi['id']; ?>" class="btn btn-light aa-add-value">Set Value</a>
                                    <button type="button" class="btn btn-outline-danger aa-delete-kpi">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                    <div class="text-center my-5 <?php echo count($event_kips) <= 0? 'd-block':'d-none'; ?>"><strong>No Kpi Was Added to Event</strong></div>
                </div>
                <div class="aa-pki-form">
                    <form id="aaAddKpiForm" method="POST" action="<?php echo base_url().'/events/'.$event['id'].'/kpi'; ?>">
                        <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                        <div class="h4">Add New KPI To Event</div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="PKI Name">
                        </div>
                        <div class="form-group mt-0">
                            <label for="">Updating Period</label>
                            <select class="form-control" name="frequent_update">
                                <?php foreach ($kpi_update_ref as $kpi_ref): ?>
                                    <option value="<?php echo $kpi_ref['name']; ?>"><?php echo $kpi_ref['name'] . '  ' . $kpi_ref['name_ar']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mt-0">
                            <label for="">Input Type</label>
                            <select class="form-control" name="input_type" id="" aria-describedby="helpId">
                                <?php foreach ($kpi_input_ref as $input_ref): ?>
                                    <option value="<?php echo $input_ref['name']; ?>"><?php echo $input_ref['name'] . '  ' . $input_ref['name_ar']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary" role="button">Add KPI</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var baseUrl = `<?php echo base_url(); ?>`;
    var eventId = '<?= $event['id'] ?>';
    $(document).ready(function (e){

        $(document).on('submit', '#aaAddKpiForm', function (e) {
            e.preventDefault();

            if ($('#kpi_dump_val').val() != '') {


                $.ajax({
                    url: baseUrl + '/events/'+eventId+'/kpi',
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (data, textStatus) {
                        if (data.success && data.kpi.length > 0) {
                            const  akw = $('#aaKpiWrapper');
                            akw.empty();
                            data.kpi.map((value, index)=>{

                                let html = '<tr data-kpi-id="' + value.id + '">';
                                html += '<td>' + value.id + '</td>';
                                html += '<td>' + value.name + '</td>';
                                html += '<td>' + value.frequent_update + '</td>';
                                html += '<td>'+value.input_type+'</td>'
                                html += '<td><a href="'+baseUrl+'/events/'+eventId+'/kpi/'+value.id+'" class="btn btn-light aa-add-valu">Set Value</a>';
                                html += '<button type="button" class="btn btn-outline-danger aa-delete-kpi">Delete</button></td></tr>';

                                const ele = $(html);
                                akw.append(ele);

                            });


                            var al = $('<div class="alert alert-success position-absolute" role="alert" style="z-index:9999;top:10px; left:50%;">KPI Saved Successfully...</div>');
                            $("body").append(al);
                            setTimeout(() => {
                                al.remove();
                            }, 3000);

                        } else {
                            var al = $('<div class="alert alert-danger position-absolute" role="alert" style="z-index:9999;top:10px; left:50%;">' + data.msg + '</div>');
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

        $(document).on('click', '.aa-delete-kpi', function (e) {
            var ele = $(this).closest('tr');
            var id = ele.attr('data-kpi-id');

            $.ajax({
                url: baseUrl + '/events/'+eventId+'/kpi/'+id+'/delete',
                method: "POST",
                data: {id: id,},
                success: function (data, textStatus) {
                    if (data.success) {

                        ele.remove();

                        var al = $('<div class="alert alert-success position-absolute" role="alert" style="z-index:9999;top:10px; left:50%;">KPI Deleted Successfully...</div>');
                        $("body").append(al);
                        setTimeout(() => {
                            al.fadeOut(400, () => {
                                al.remove();
                            });

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


        $(document).on('click', '#aa-add-value', function (e){
            window.location = $(this).attr('');
        });


    });

</script>
<?php include ('layout/layout_bottom.php')?>