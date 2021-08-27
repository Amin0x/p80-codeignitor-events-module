<?php print_r($ev_status); ?>
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
<body style="background-color: #f7f7f7;">
    <div class="container">
        <form action="/events/add" method="post" class="d-block" id="myForm">
        <?= csrf_field() ?>
            <div class="title"><h1>Create Event</h1></div>
            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <h4>Basic</h4>
                            <div class="form-group">
                                <label for="eventName">Event Name</label>
                                <input type="text" class="form-control" name="event_name" id="eventName" aria-describedby="helpId" placeholder="event name">
                            </div>
                            <div class="form-group mt-2">
                                <label for="eventNameAr">اسم الفعالية</label>
                                <input type="text" class="form-control" name="event_name_ar" id="eventNameAr" aria-describedby="helpId" placeholder="event name">
                            </div>
                            <div class="form-group mt-2">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" row="6" aria-describedby="helpId" placeholder="description"></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="descriptionAr">وصف الفعالية</label>
                                <textarea class="form-control" name="description_ar" id="descriptionAr" row="6" aria-describedby="helpId" placeholder="description"></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Start Date</label>
                                        <input type="datetime-local" class="form-control" name="start_date" id="startDate">
                                    </div>
                                    <div class="col-6">
                                        <label for="">End Date</label>
                                        <input type="datetime-local" class="form-control" name="end_date" id="endDate">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Location</label>
                                <input type="text" class="form-control" name="location" id="location" aria-describedby="helpId" placeholder="location">
                            </div>
                            
                            <div class="form-group mt-2">
                                <label for="category">Category</label>
                                <select type="text" class="form-control" name="category" id="category" aria-describedby="helpId" placeholder="">
                                    <?php foreach ($category as $value): ?>
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                                    <?php endforeach; ?>                                   
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="status">Status</label>
                                <select type="text" class="form-control" name="status"  aria-describedby="helpId" placeholder="">
                                    <?php foreach ($ev_status as $value): ?>
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['status_name'];?></option>
                                    <?php endforeach; ?>   
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="status">Classification</label>
                                <select type="text" class="form-control" name="event_classification"  aria-describedby="helpId" placeholder="">
                                    <?php foreach ($classification as $value): ?>
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                                    <?php endforeach; ?>   
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="status">Connected to tech</label>
                                <select type="text" class="form-control" name="connected_tech"  aria-describedby="helpId" placeholder="">
                                    <option value="no">no</option>
                                    <option value="yes">yes</option>
                                </select>
                            </div>
                                                        
                            <div class="form-group mt-2">
                              <label for="">Manager Name</label>
                              <input type="text" class="form-control" name="manager_name" id="managerName" aria-describedby="helpId" placeholder="">
                            </div>
                            <div class="form-group mt-2">
                              <label for="">Manager Email</label>
                              <input type="text" class="form-control" name="manager_email" id="managerEmail" aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                    </div>

                    
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>KPI</h4>
                            <div class="aa-kpi-wrapper row" id="kpiWrapper">
                                <div class="form-group col-md-6 mb-3">
                                  <label for="kpi0">KPI Name</label>
                                  <input type="text" class="form-control" name="kpi[0]" id="kpi0" placeholder="">
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                  <label for="kpi0">KPI Value</label>
                                  <input type="text" class="form-control" name="kpi_val[0]" id="kpiVal0" aria-describedby="helpId" placeholder="">
                                </div>
                                <hr>
                            </div>
                            <button type="button" name="add_kpi" id="addKpiBtn" class="btn btn-primary btn-sm">add KPI</button>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-body">
                            <h4>Location</h4>
                            <div class="form-group">
                              <label for="">Location</label>
                              <input type="text" class="form-control" name="location"  placeholder="Location">
                            </div>
                            <div class="form-group">
                              <label for="">State</label>
                              <input type="text" class="form-control" name="state" placeholder="State">
                            </div>
                            <div class="form-group">
                              <label for="">City</label>
                              <input type="text" class="form-control" name="city" placeholder="City">
                            </div>
                            <div class="form-group">
                              <label for="">Latitude</label>
                              <input type="text" class="form-control" name="latitude" placeholder="Latitude">
                            </div>
                            <div class="form-group">
                              <label for="">Longitude</label>
                              <input type="text" class="form-control" name="longitude"  placeholder="Longitude">
                            </div>
                            <div class="form-group">
                              <label for="">Map Region (polygon)</label>
                              <input type="text" class="form-control" name="map_region" placeholder="Map Region">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2"><button type="submit" class="btn btn-success">Send</button></div>
            </div>
        </form>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(e){

            var kpi_index = 0;
            var kpi_list = <?php json_encode($ev_kpis) ?>;
            var url = '<?php echo base_url('/events/add' )?>';
            
            
            var form = document.getElementById( "myForm" );
            //form.addEventListener( "submit", sendForm);

            var addKpi = document.getElementById('addKpiBtn');
            addKpi.addEventListener('click', addKpiField);
    
            function addKpiField(e){
                e.preventDefault();
                
                
                kpi_index++;
    
                var kpiWrapper = document.getElementById('kpiWrapper');

                var formGroup = document.createElement('div');
                var formGroupVal = document.createElement('div');
                var lable = document.createElement('lable');
                var lableVal = document.createElement('lable');
                var lableNameTxt = document.createTextNode('Kpa Name');
                var lableValTxt = document.createTextNode('Kpa Value');
                var input = document.createElement('select');
                var inputVal = document.createElement('input');
                var hr = document.createElement('hr');
                
                formGroup.className = 'form-group col-md-6 mb-3';
                formGroupVal.className = 'form-group col-md-6 mb-3';
                
                lable.setAttribute('for', '');
                lable.appendChild(lableNameTxt);
                input.className = 'form-control';
                input.setAttribute('name', 'kpi_name['+ kpi_index +']');
                formGroup.appendChild(lable);

                for(kpi in kpi_list){
                    var option  = document.createElement('option');
                    option.setAttribute('value', kpi.id);
                    option.appendChild(document.createTextNode(kpi.name));
                    input.appendChild(option);
                }
                formGroup.appendChild(input);
    
                lableVal.setAttribute('for', '');
                lableVal.appendChild(lableValTxt);
                inputVal.className = 'form-control';
                inputVal.setAttribute('name', 'kpi_val['+ kpi_index +']');
                formGroupVal.appendChild(lableVal);
                formGroupVal.appendChild(inputVal);           
                
                kpiWrapper.appendChild(formGroup);
                kpiWrapper.appendChild(formGroupVal);
                kpiWrapper.appendChild(hr);
    
                
            }

            function sendForm(e){
                e.preventDefault();

                var validate = validateForm();
                if(validate == false){
                    //return false;
                }

                const xhr = new XMLHttpRequest();               
                const FD = new FormData( form );

                xhr.onload = function(event) {
                    if(xhr.status == 200){
                        console.log(xhr.response);
                    }
                } 

                xhr.onerror = function( event ) {
                    console.log(event);
                    alert( 'Oops! Something went wrong.' );
                } 

                xhr.open( "POST", url );
                xhr.setRequestHeader( "Content-Type", "application/json");
                xhr.setRequestHeader( "X-Requested-With", "XMLHttpRequest");
                xhr.send( FD );
            }

            function validateForm(){

                var eventName = document.getElementById('eventName');
                var eventNameAr = document.getElementById('eventNameAr');
                var description = document.getElementById('description');
                var descriptionAr = document.getElementById('descriptionAr');
                var startDate = document.getElementById('startDate');
                var endDate = document.getElementById('endDate');
                var location = document.getElementById('location');
                var category = document.getElementById('category');
                var managerName = document.getElementById('managerName');
                var managerEmail = document.getElementById('managerEmail');

                if(eventName.value == ''){
                    eventName.style.border = '1px solid red';
                }
                if(eventNameAr.value == ''){
                    eventNameAr.style.border = '1px solid red';
                }
                if(description.value == ''){
                    description.style.border = '1px solid red';
                }
                if(descriptionAr.value == ''){
                    descriptionAr.style.border = '1px solid red';
                }
                if(startDate.value == ''){
                    startDate.style.border = '1px solid red';
                }
                if(endDate.value == ''){
                    endDate.style.border = '1px solid red';
                }
                if(location.value == ''){
                    location.style.border = '1px solid red';
                }
                if(category.value == ''){
                    category.style.border = '1px solid red';
                }
                if(managerName.value == ''){
                    managerName.style.border = '1px solid red';
                }
                if(managerEmail.value == ''){
                    managerEmail.style.border = '1px solid red';
                }
            }
        });
    </script>
</body>
</html>