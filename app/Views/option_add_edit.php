<?php include ('layout/layout_top.php')?>
<div class="container">
    <h3>Options (KPI's)</h3>
    <div class="row">
        <div class="col-12">
            <div class="aa-pki-list">
                <table class="table" id="aaPKIList">
                    <thead>
                    <tr>
                        <th>KPI Name</th>
                        <th>Updating Period</th>
                        <th>Input Type</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($event_kpis as $event_kpi): ?>
                        <tr data-name="<?php echo $event_kpi->name; ?>" data-id="<?php echo $event_kpi->id; ?>"
                            data-udpate-id="<?php echo $event_kpi->frequent_update_id; ?>"
                            data-type-id="<?php echo $event_kpi->input_type_id; ?>">
                            <td><?php echo $event_kpi->name; ?></td>
                            <td><?php echo $event_kpi->update_type; ?></td>
                            <td><?php echo $event_kpi->input_type; ?></td>

                            <td>
                                <button type="button" class="btn btn-outline-danger aa-delete-pki">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="aa-pki-msg"></div>
                    <div class="aa-pki-form">
                        <form id="myForm" method="POST">
                            <div class="h4">Add New Option (KPI)</div>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="pki_name" placeholder="PKI Name">
                            </div>
                            <div class="form-group mt-0">
                                <label for="">Updating Period</label>
                                <select class="form-control" name="updating_period">
                                    <?php foreach ($pki_update_ref as $kpi_ref): ?>
                                        <option value="<?php echo $kpi_ref->id; ?>"><?php echo $kpi_ref->name . '  ' . $kpi_ref->name_ar; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mt-0">
                                <label for="">Input Type</label>
                                <select class="form-control" name="input_type" id="" aria-describedby="helpId">
                                    <?php foreach ($pki_input_ref as $input_ref): ?>
                                        <option value="<?php echo $input_ref->id; ?>"><?php echo $input_ref->name . '  ' . $input_ref->name_ar; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary" role="button">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit KPI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="aa-pki-msg"></div>
                        <div class="aa-pki-form">
                            <form action="/event/option/update" id="myFormModel" method="POST">
                                <input type="hidden" name="id" id="updatedPki" value="">
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="text" class="form-control" name="pki_name" id="pkiNameModel"
                                           aria-describedby="helpId" placeholder="PKI Name">
                                </div>
                                <div class="form-group mt-0">
                                    <label for=""></label>
                                    <select class="form-control" name="updating_period" id="updatingPeriodModel"
                                            aria-describedby="helpId">
                                        <?php foreach ($pki_update_ref as $kpi_ref): ?>
                                            <option value="<?php echo $kpi_ref->id; ?>"><?php echo $kpi_ref->name . '  ' . $kpi_ref->name_ar; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mt-0">
                                    <label for="">Input Type</label>
                                    <select class="form-control" name="input_type" id="inputTypeModel"
                                            aria-describedby="helpId">
                                        <?php foreach ($pki_input_ref as $input_ref): ?>
                                            <option value="<?php echo $input_ref->id; ?>"><?php echo $input_ref->name . '  ' . $input_ref->name_ar; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="aaSave">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script>
    const baseUrl = "<?php echo base_url(); ?>";

    $(document).ready(function (e) {

        var form = $("#myForm");
        form.on('submit', addNewPKI);


        function addNewPKI(e) {
            e.preventDefault();


            $.ajax({
                url: baseUrl + '/events/option',
                method: 'POST',
                data: form.serialize(),
                success: function (data) {
                    if (data.success) {

                        console.log(data);
                        var html = '<tr data-name="' + data.option[0].name + '" data-id="' + data.option[0].id + '" data-udpate-id="' + data.option[0].update_name + '" data-type-id="' + data.option[0].input_name + '">';
                        html += '<td>' + data.option[0].name + '</td>';
                        html += '<td>' + data.option[0].update_name + '</td>';
                        html += '<td>' + data.option[0].input_name + '</td><td>';
                        //html += '<button type="button" class="btn btn-outline-warning aa-edit-pki" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>';
                        html += '<button type="button" class="btn btn-outline-danger aa-delete-pki">Delete</button>';
                        html += '</td></tr>';

                        $('#aaPKIList > tbody:last-child').append(html);

                    }
                }
            });
        }

        $(document).on('click', '.aa-delete-pki', function (e) {

            e.preventDefault();
            console.log(e.target);
            var tr = $(this).closest('tr');
            var id = tr.attr("data-id");
            tr.css('background-color', '#ccc');
            $.ajax({
                url: baseUrl + '/events/option/delete',
                method: "POST",
                data: {id: id},
                success: function (data) {
                    if (data.success) {
                        tr.remove();
                    } else {
                        console.log('');
                        tr.css('background-color', '#ccc');
                    }
                }

            });

        });


    });
</script>
<?php include ('layout/layout_bottom.php')?>