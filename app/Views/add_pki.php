<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/aamain.css">
</head>
<body>
    <div class="container">
        <h3>PKI</h3>
        <div class="row">
            <div class="col-12">
                <div class="aa-pki-list">
                    <table class="table">
                        <thead>                        
                            <th>PKI Name</th>
                            <th>Updating Period</th>  
                            <th>Input Type</th>  
                            <th>Actions</th>                      
                        </thead>
                        <tbody id="aaPKIList">
                            <?php foreach($event_kpis as $event_kpi): ?>
                            <tr data-name="<?php echo $event_kpi->name; ?>" data-id="<?php echo $event_kpi->id; ?>" data-udpate-id="<?php echo $event_kpi->frequent_update_id; ?>" data-type-id="<?php echo $event_kpi->input_type_id; ?>">
                                <td><?php echo $event_kpi->name; ?></td>
                                <td><?php echo $event_kpi->update_type; ?></td>
                                <td><?php echo $event_kpi->input_type; ?></td>
                                
                                <td>
                                    <button type="button" class="btn btn-outline-warning aa-edit-pki" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
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
                            <form id="myForm">
                                <div class="h4">Add New KPI</div>
                                <div class="form-group">
                                  <label for="">Name</label>
                                  <input type="text" class="form-control" name="pki_name" placeholder="PKI Name">
                                </div>
                                <div class="form-group mt-0">
                                  <label for="">Updating Period</label>
                                  <select type="text" class="form-control" name="updating_period" placeholder="Updating Period">
                                      <?php foreach($pki_update_ref as $kpi_ref): ?>
                                      <option value="<?php echo $kpi_ref->id; ?>"><?php echo $kpi_ref->name.'  '.$kpi_ref->name_ar; ?></option>
                                      <?php endforeach; ?>                                  
                                  </select>
                                </div>
                                <div class="form-group mt-0">
                                  <label for="">Input Type</label>
                                  <select type="text" class="form-control" name="input_type" id="" aria-describedby="helpId" placeholder="Updating Period">
                                      <?php foreach($pki_input_ref as $input_ref): ?>
                                      <option value="<?php echo $input_ref->id; ?>"><?php echo $input_ref->name.'  '.$input_ref->name_ar; ?></option>
                                      <?php endforeach; ?>                                  
                                  </select>
                                </div>
                                <div class="mt-3"><a name="" id="aaAddBtn" class="btn btn-primary" href="#" role="button">Add</a></div>
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
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="aa-pki-msg"></div>
                            <div class="aa-pki-form">
                                <form id="myFormModel">
                                    <input type="hidden" name="id" id="updatedPki" value="">
                                    <div class="form-group">
                                      <label for=""></label>
                                      <input type="text" class="form-control" name="pki_name" id="pkiNameModel" aria-describedby="helpId" placeholder="PKI Name">
                                    </div>
                                    <div class="form-group mt-0">
                                        <label for=""></label>
                                        <select type="text" class="form-control" name="updating_period" id="updatingPeriodModel" aria-describedby="helpId" placeholder="Updating Period">
                                            <?php foreach($pki_update_ref as $kpi_ref): ?>
                                            <option value="<?php echo $kpi_ref->id; ?>"><?php echo $kpi_ref->name.'  '.$kpi_ref->name_ar; ?></option>
                                            <?php endforeach; ?> 
                                        </select>
                                    </div>
                                    <div class="form-group mt-0">
                                        <label for="">Input Type</label>
                                        <select type="text" class="form-control" name="input_type" id="inputTypeModel" aria-describedby="helpId" placeholder="Updating Period">
                                            <?php foreach($pki_input_ref as $input_ref): ?>
                                            <option value="<?php echo $input_ref->id; ?>"><?php echo $input_ref->name.'  '.$input_ref->name_ar; ?></option>
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
    
    <script src="/assets/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/toastify-js.js"></script>
    <script src="/assets/js/scripts.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(e){

            var editPkiBtn = document.getElementById('aaAddBtn');
            
            aaAddBtn.addEventListener('click', addNewPKI);
            

            function addNewPKI(e){
                e.preventDefault();
                
                var form = document.getElementById( "myForm" );
                const xhr = new XMLHttpRequest();               
                const fd = new FormData( form );

                xhr.onload = function(event) {
                    // var msgBox = document.getElementsByClassName('aa-pki-msg')[0];
                    // msgBox.innerHTML = '<div class="text-success">PKI successfully added</div>';
                    Toastify({
                                text: "PKI successfully added",
                                duration: 3000,
                                //destination: "https://github.com/apvarun/toastify-js",
                                //newWindow: true,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "left", // `left`, `center` or `right`
                                backgroundColor: "#55bf76",
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                onClick: function(){} // Callback after click
                        }).showToast();
                }

                xhr.onerror = function( event ) {
                    // var msgBox = document.getElementsByClassName('aa-pki-msg')[0];
                    // msgBox.innerHTML = '<div class="text-danger">Error: Can\'t Add PKI</div>';
                    Toastify({
                                text: "Error: Can\'t Add PKI",
                                duration: 3000,
                                //destination: "https://github.com/apvarun/toastify-js",
                                //newWindow: true,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "left", // `left`, `center` or `right`
                                backgroundColor: "#fb353e",
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                onClick: function(){} // Callback after click
                        }).showToast();
                }

                xhr.open( "POST", "<?php echo base_url('events/pki'); ?>" );
                //xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                //xhr.setRequestHeader('Content-Type','application/json');
                xhr.setRequestHeader( "X-Requested-With", "XMLHttpRequest");
                xhr.send( fd );
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function(e){

            var updatedPki = undefined;
            var eles = document.getElementsByClassName('aa-edit-pki');
            var aaSave = document.getElementById('aaSave');

            aaSave.addEventListener('click', savePkiModel);

            function savePkiModel(e){
                e.preventDefault();
                document.getElementById('updatedPki').setAttribute('value', updatedPki);
                //updatePKI();
            }
            
            for(i = 0; i < eles.length; i++){
                eles[i].addEventListener('click', function(e){
                    //document.getElementById('exampleModal').modal('show');
                    var tr = e.target.parentNode.parentNode;
                    
                    var name = tr.cells[0].textContent;
                    document.getElementById('pkiNameModel').value = name;
                    
                    var updatePeriod = tr.getAttribute('data-udpate-id');
                    var updatingPeriodModel = document.getElementById('updatingPeriodModel');
                    updatingPeriodModel.value = updatePeriod;
                    updatingPeriodModel.setAttribute('selected', 'selected');
                    
                    var inputTypeId = tr.getAttribute('data-type-id');
                    var inputTypeModel = document.getElementById('inputTypeModel');
                    inputTypeModel.value = inputTypeId;
                    inputTypeModel.setAttribute('selected', 'selected');

                    updatedPki = updatePeriod;
                });
            }
            

            function updatePKI(id){                

                var form = document.getElementById( "myFormModel" );
                const xhr = new XMLHttpRequest();               
                const FD = new FormData( form );

                xhr.addEventListener( "load", function(event) {
                    var msgBox = document.getElementsByClassName('aa-pki-msg')[0];
                    msgBox.innerHTML = '<div class="text-success">PKI successfully added</div>';
                } );

                xhr.addEventListener( "error", function( event ) {
                    var msgBox = document.getElementsByClassName('aa-pki-msg')[0];
                    msgBox.innerHTML = '<div class="text-danger">Error: Can\'t Add PKI</div>';
                } );

                xhr.open( "POST", "https://example.com/cors.php" );
                //xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                xhr.setRequestHeader('Content-Type','application/json');
                xhr.send( FD );
            }
        });
    </script>
</body>
</html>