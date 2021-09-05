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
<script>
    var baseUrl = `<?php echo base_url(); ?>`;
    $(document).ready(function (e){
        $('#aaAddOption').on('click', function (e){
            const option = $('#kpi_dump').val();
            const value = $('#kpi_dump_val').val();

            if(value === ''){
                $('#kpi_dump_val').addClass('is-invalid');
                return false;
            }

            if(option === ''){
                $('#kpi_dump').addClass('is-invalid');
                return false;
            }

            $.ajax({
                url: baseUrl + "/options/create",
                method: 'POST',
                data: {},
                success: function (data){
                    if (data.success){

                    } else {

                    }
                }
            });
        });
    });

</script>
<?php include ('layout/layout_bottom.php')?>