<?php include ('layout/layout_top.php')?>
<div class="title mb-2">
    <h3>Events</h3>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mt-2"><a href="/events/create" class="btn btn-success px-5 py-2">add event</a></div>
                <hr>
                <br>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <form action="/events" method="get">

                            <th>
                                category
                                <br>
                                <select class="form-control" name="category" id="category">
                                    <option value=""></option>
                                    <?php foreach ($category as $value) : ?>
                                        <option value="<?php echo $value['id']; ?>">
                                            <?php echo $value['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                            <th>
                                classification:
                                <br>
                                <select class="form-control" name="classification" id="classification">
                                    <option value=""></option>
                                    <?php foreach ($classification as $value) : ?>
                                        <option value="<?php echo $value['id']; ?>">
                                            <?php echo $value['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                            <th>
                                status:
                                <br>
                                <select class="form-control" name="status" id="status">
                                    <option value=""></option>
                                    <?php foreach ($status as $value) : ?>
                                        <option value="<?php echo $value['id']; ?>">
                                            <?php echo $value['status_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                            <th>
                                city:
                                <br>
                                <input type="text" class="form-control" name="city" id="city">

                            </th>
                            <th>
                                region:
                                <br>
                                <input type="text" class="form-control" name="region" id="region">

                            </th>
                            <th>
                                state:
                                <br>
                                <input  type="text" class="form-control" name="state" id="state">

                            </th>
                            <th>
                                <button type="submit" id="apply" class="btn btn-primary" href="#" role="button">Apply
                                </button>
                            </th>
                        </form>

                        </thead>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">title</th>
                            <!-- <th scope="col">description</th> -->
                            <th scope="col">start date</th>
                            <th scope="col">end date</th>
                            <th scope="col">category</th>
                            <th scope="col">classification</th>
                            <!-- <th scope="col">is tech</th> -->
                            <th scope="col">staus</th>
                            <!-- <th scope="col">manager</th> -->
                            <th scope="col">location</th>
                            <!-- <th scope="col">latitude</th> -->
                            <!-- <th scope="col">latitude</th> -->
                            <th scope="col">region</th>
                            <th scope="col">state</th>
                            <th scope="col">city</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($events as $event) : ?>
                            <tr data-event-id="<?php echo $event['id']; ?>">
                                <td>
                                    <a href="<?php echo base_url('/events/view?id=' . $event['id']); ?>"><?php echo $event['title']; ?></a>
                                </td>
                                <!-- <td><?php echo $event['description']; ?></td> -->
                                <td><?php echo $event['start_date']; ?></td>
                                <td><?php echo $event['end_date']; ?></td>
                                <td><?php echo $event['category_name']; ?></td>
                                <td><?php echo $event['classification']; ?></td>
                                <!-- <td><?php echo $event['connected_tech']; ?></td> -->
                                <td><?php echo $event['status_name']; ?></td>
                                <!-- <td><?php echo $event['manager_name']; ?></td> -->
                                <td><?php echo $event['location']; ?></td>
                                <!-- <td><?php echo $event['latitude']; ?></td> -->
                                <!-- <td><?php echo $event['longitude']; ?></td> -->
                                <td><?php echo $event['region']; ?></td>
                                <td><?php echo $event['state']; ?></td>
                                <td><?php echo $event['city']; ?></td>
                                <td>
                                    <a href="<?php echo base_url('/events/edit?id=' . $event['id']); ?>"
                                       class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm aa-event-delete"><i
                                                class="far fa-trash-alt"></i></button>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    <?php if ($pager) : ?>
                        <?php $pagi_path = 'events'; ?>
                        <?php $pager->setPath($pagi_path); ?>
                        <?php echo $pager->links(); ?>
                    <?php endif ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    var siteUrl = '<?php echo base_url(); ?>';
    $(document).ready(function () {

        $('.aa-event-delete').on('click', function (e) {
            e.preventDefault();

            var tr = $(this).parent().parent();
            var id = tr.attr('data-event-id');


            $.ajax({
                method: 'POST',
                url: siteUrl + '/events/del',
                data: {id: id},
                success: function (data) {
                    if (data.success) {
                        tr.fadeOut(200, () => {
                            tr.remove();
                        });

                        $("body").append('<div class="alert alert-success position-fixed" id="alertSuccess" role="alert" style="top:20px;left:50%;z-index:999;">event deleted</div>');
                        setTimeout(() => {
                            $('#alertSuccess').remove();
                        }, 3000);
                    } else {
                        $("body").append('<div class="alert alert-danger position-fixed" id="alertSuccess" role="alert" style="top:20px;left:50%;z-index:999;">event deleted</div>');
                        setTimeout(() => {
                            $('#alertSuccess').remove();
                        }, 3000);
                    }
                },
            });
        });

    });
</script>
<?php include ('layout/layout_bottom.php')?>