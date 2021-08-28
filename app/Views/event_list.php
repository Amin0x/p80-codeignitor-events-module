<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>


    <link rel="stylesheet" href="/assets/vendors/fontawesome/css/all.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/aamain.css">
    <style>
        ul.pagination > li {
            display: inline-block;
            padding: 4px 6px;
            margin: 0 4px;
            border: 1px solid #ccc;
        }

        ul.pagination > li:hover {
            background-color: #f7f7f7;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body style="background-color: #f7f7f7;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title">
                    <h1>Events</h1>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="aa-fillter">
                            add filter here
                        </div>
                        <div class="mt-2"><a href="/events/add" class="btn btn-success">add event</a></div>
                        <hr>
                        <br>
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
                                        <tr>
                                            <td><?php echo $event['title']; ?></td>
                                            <!-- <td><?php echo $event['description']; ?></td> -->
                                            <td><?php echo $event['start_date']; ?></td>
                                            <td><?php echo $event['end_date']; ?></td>
                                            <td><?php echo $event['category_id']; ?></td>
                                            <td><?php echo $event['classification_id']; ?></td>
                                            <!-- <td><?php echo $event['connected_tech']; ?></td> -->
                                            <td><?php echo $event['staus_id']; ?></td>
                                            <!-- <td><?php echo $event['manager_name']; ?></td> -->
                                            <td><?php echo $event['location']; ?></td>
                                            <!-- <td><?php echo $event['latitude']; ?></td> -->
                                            <!-- <td><?php echo $event['longitude']; ?></td> -->
                                            <td><?php echo $event['region']; ?></td>
                                            <td><?php echo $event['state']; ?></td>
                                            <td><?php echo $event['city']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
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
                                <?= $pager->links() ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="/assets/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>

    </script>
</body>

</html>