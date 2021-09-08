<?php include ('layout/layout_top.php')?>
<div id="aaAlert"></div>
<table class="table" id="aaPKIList">
    <thead>
    <tr>
        <th>KPI Value</th>
        <th>Update By</th>
        <th>Updated at</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($event_kpis as $val): ?>
        <tr>
            <td><?php echo $val['kpi_value']; ?></td>
            <td><?php echo $val['user_id']; ?></td>
            <td><?php echo $val['update_date']; ?></td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
<form action="" id="ValForm">
    <input type="hidden" name="kpi_id" value="<?php echo $kpi['id']; ?>">
    <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
    <label for="aaValue">Set Value</label>
    <button type="submit" class="btn btn-primary mt-2" id="aaAdd">Send</button>
</form>

<script>
    var type = "<?php echo $kpi['input_type']; ?>";
    var eventId = "<?php echo $event['id']; ?>";
    var kpiId = "<?php echo $kpi['id']; ?>";

    $(document).ready((e)=>{
        const  form = $('form > label');
        let ele = false;
        if(type.toLowerCase() === "number"){
            ele = $('<input type="number" name="kpi_value" value="" class="form-control">');
        } else if (type.toLowerCase() === "logical"){
            ele = $('<select name="kpi_value" class="form-control"><option value="Yes">Yes</option><option value="No">No</option></select>');
        } else {
            ele = $('<input type="text" name="kpi_value" value="" class="form-control">');
        }

        form.after(ele);

        $('#ValForm').on('submit', (e)=> {
            e.preventDefault();

            $.ajax({
                url: '/events/'+eventId+'/kpi/'+kpiId+'/update',
                method: 'post',
                data: $('#ValForm').serialize(),
                success: (data) => {
                    if(data.success){
                        $('#aaAlert').empty();
                        $('#aaAlert').append('<div class="alert alert-success" role="alert"> success set kpi value! </div>');
                    } else {
                        $('#aaAlert').empty();
                        $('#aaAlert').append('<div class="alert alert-danger" role="alert"> error cant set kpi value! </div>');
                    }
                }
            });


        });
    });
</script>
<?php include ('layout/layout_bottom.php')?>
