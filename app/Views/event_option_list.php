<div>
    <div class="title">
        <h1>Event KPI</h1>
    </div>
    <div class="kpi">
        <table>
            <thead>
            <th>kpi name</th>
            <th>update frequency</th>
            <th>Value Type</th>
            </thead>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <button type="button" class="btn btn-outline-success"></button>
                    <button type="button" class="btn btn-outline-danger"></button>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="card">
        <div class="card-body">
            <strong>Add Event (KPI)</strong>
            <div id="aaOptionWarrper">
            </div>
            <div class="aa-kpi-wrapper d-flex" id="kpiWrapper">
                <select class="form-control" name="kpi_dump" id="kpi_dump"
                        style="margin-right: .3rem;">
                    <?php foreach ($kpi_input_ref as $val) : ?>
                        <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="form-control" name="kpi_dump" id="kpi_dump"
                        style="margin-right: .3rem;">
                    <?php foreach ($kpi_update_ref as $val) : ?>
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
</div>
