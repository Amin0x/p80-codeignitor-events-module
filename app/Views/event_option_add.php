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
        ul.pagination>li {
            display: inline-block;
            padding: 4px 6px;
            margin: 0 4px;
            border: 1px solid #ccc;
        }

        ul.pagination>li:hover {
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
                    <h1>Events Option</h1>
                </div>

                <form action="/event/option/create" method="POST">
                    <input type="hidden" name="" value="">
                    <div class="card">
                        <div class="card-body">
                            <h4>KPI</h4>
                            <div class="aa-kpi-wrapper row" id="kpiWrapper">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="kpi0">KPI Name</label>
                                    <select class="form-control" name="option_name">
                                        <?php foreach ($ev_kpis as $ev_kpi) : ?>
                                            <option value="<?php echo $ev_kpi['id']; ?>"><?php echo $ev_kpi['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="kpi0">KPI Value</label>
                                    <input type="text" class="form-control" name="option_val" placeholder="">
                                </div>
                                <hr>
                            </div>
                            <button type="submit" name="add_kpi" id="addKpiBtn" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="/assets/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>


    </script>
</body>

</html>