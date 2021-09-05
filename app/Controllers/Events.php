<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Model;
use Config\App;

class Events extends BaseController
{
    use ResponseTrait;

    public function __construct() {
        
    }

	public function index()
	{
		
        $model = new \App\Models\EventModel();
        $eventCategoryModel = new \App\Models\EventCategoryModel();
        $eventClassificationModel = new \App\Models\EventClassificationModel();
        $eventStatusModel = new \App\Models\EventStatusModel();

        $model->select('`events`.*, event_category.name as category_name, event_classification.name as classification, event_status.status_name as status_name');
        $model->join('event_category', 'event_category.id = `events`.category_id');
        $model->join('event_classification', 'event_classification.id = `events`.classification_id');
        $model->join('event_status', 'event_status.id = `events`.staus_id');
        
        if ($this->request->getVar('category')) {
            $model->where('category_id', $this->request->getVar('category'));
        }
        
        if ($this->request->getVar('enabled')) {
            $model->where('enabled', $this->request->getVar('enabled'));
        }

        if($this->request->getVar('classification')) {
            $model->where('classification_id', $this->request->getVar('classification'));
        }
       
        if ($this->request->getVar('status')) {
            $model->where('staus_id', $this->request->getVar('staus'));
        }

        if ($this->request->getVar('region')) {
            $model->where('region', $this->request->getVar('region'));
        }

        if ($this->request->getVar('state')) {
            $model->where('state', $this->request->getVar('state'));
        }

        if ($this->request->getVar('city')) {
            $model->where('city', $this->request->getVar('city'));
        }
            
        
        $data = [
            'page_title' => 'Events',
            'category' => $eventCategoryModel->findAll(),
            'classification' => $eventClassificationModel->findAll(),
            'status' => $eventStatusModel->findAll(),
            'events' => $model->paginate(10),
            'pager' => $model->pager,
        ];
        

        return view('event_list', $data);
	}

    public function viewEvent()
    {

        $metasModel = new \App\Models\KpisModel();
        $model = new \App\Models\EventModel();
        $id = $this->request->getVar('id');
        $event = $model->find($id);

        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'page_title' => 'Events',
            'meta' => $metasModel->findAll(),
            'event' => $event,
        ];

        return view('event_view', $data);
    }

    

    public function createEvent()
    {
        $category = new \App\Models\EventCategoryModel();
        $classification = new \App\Models\EventClassificationModel();
        $metasModel = new \App\Models\KpisModel();
        $eventStatusModel = new \App\Models\EventStatusModel();

        $data = [
            'page_title' => 'Events - create new event',
            'category' => $category->findAll(),
            'classification' => $classification->findAll(),
            'meta' => $metasModel->findAll(),
            'ev_status' => $eventStatusModel->findAll(),
            'event_id' => 0,
            'error' => [],           
        ];

        return view('event_add', $data);
    }

    
    public function createEventAjax()
    {    
        $rules = [
            'event_name' => ['rules' => 'required', 'errors' => ['required' => 'The Event Name field is required.']],
            'description' => ['rules' => 'required' , 'errors' => ['required' => 'The Description field is required.']],
            'end_date' => ['rules' => 'required' , 'errors' => ['required' => 'The Description field is required.']],
            'start_date' => [ 'rules' => 'required' , 'errors' => ['required' => 'The Start Date field is required.']],
            'manager_name' => ['rules' => 'required' , 'errors' => ['required' => 'The Manger Name field is required.']],
            'manager_email' => ['rules' => 'required' , 'errors' => ['required' => 'The Manager Email field is required.']],
            'enabled' => ['rules' => 'required' , 'errors' => ['required' => 'The Enabled field is required.']],
            'category_id' => ['rules' => 'required' , 'errors' => ['required' => 'The Category field is required.']],
            'classification_id' => ['rules' => 'required' , 'errors' => ['required' => 'The Classification field is required.']],
            'connected_tech' => [ 'rules' => 'required' , 'errors' => ['required' => 'The Connected to tech field is required.']],
            'staus_id' => ['rules' => 'required' , 'errors' => ['required' => 'The Staus field is required.']],
            'location' => ['rules' => 'required' , 'errors' => ['required' => 'The Location field is required.']],
            //'region' => ['rules' => 'required' , 'errors' => ['required' => 'The Region field is required.']],
            'state' => ['rules' => 'required' , 'errors' => ['required' => 'The State field is required.']],
            'city' => ['rules' => 'required' , 'errors' => ['required' => 'The City field is required.']],
        ];


        if (! $this->validate($rules)) {
            return $this->response->setJSON(['success' => false, 'msg' => 'Error: Invalid Inputs', 'errors' => $this->validator->getErrors(),]);
        }

        $data = [
            'title' =>  $this->request->getVar('event_name'),
            'tite_ar' =>  $this->request->getVar('event_name_ar'),
            'description' =>  $this->request->getVar('description'),
            'description_ar' =>  $this->request->getVar('description_ar'),
            'end_date' =>  $this->request->getVar('end_date'),
            'start_date' =>  $this->request->getVar('start_date'),
            'enabled' =>  $this->request->getVar('foo'),
            'category_id' =>  $this->request->getVar('category'),
            'classification_id' =>  $this->request->getVar('event_classification'),
            'connected_tech' =>  $this->request->getVar('connected_tech'),
            'staus_id' =>  $this->request->getVar('status'),
            'manager_name' =>  $this->request->getVar('manager_name'),
            'location' =>  $this->request->getVar('location'),           
            'latitude' =>  $this->request->getVar('latitude'),           
            'longitude' =>  $this->request->getVar('longitude'),           
            'region' =>  $this->request->getVar('region'),           
            'state' =>  $this->request->getVar('state'),           
            'city' =>  $this->request->getVar('city'),           
            'map_region' =>  $this->request->getVar('map_region'),           
        ];
        
        // $err = [];
        // $err_fields = [];

        // if(trim($data['title']) == ''){
        //     $err['title'] = 'you must inter title';
        //     $err_fields[] = 'title';
        // }

        // if(trim($data['description']) == ''){
        //     $err['description'] = 'you must inter description';
        //     $err_fields[] = 'description';
        // }
        // if(trim($data['start_date']) == ''){
        //     $err['start_date'] = 'you must inter description';
        //     $err_fields[] = 'start_date';
        // }
        // if(trim($data['staus_id']) == ''){
        //     $err['staus_id'] = 'you must inter description';
        //     $err_fields[] = 'staus_id';
        // }
        // if(trim($data['category_id']) == ''){
        //     $err['category_id'] = 'you must inter description';
        //     $err_fields[] = 'category_id';
        // }
        // if(trim($data['classification_id']) == ''){
        //     $err['classification_id'] = 'you must inter description';
        //     $err_fields[] = 'classification_id';
        // }
        // if(trim($data['location']) == ''){
        //     $err['location'] = 'you must inter description';
        //     $err_fields[] = 'location';
        // }
        // if(trim($data['city']) == ''){
        //     $err['city'] = 'you must inter description';
        //     $err_fields[] = 'city';
        // }
        // if(trim($data['state']) == ''){
        //     $err['state'] = 'you must inter description';
        //     $err_fields[] = 'state';
        // }

        $model = new \App\Models\EventModel();
        $id = $model->insert($data);
        $result = [];
        
        if($id){
            $result['success'] = true;
            $result['msg'] = "success";
            $result['event_id'] = $id;
            
            return $this->response->setJSON($result);
        }
        
        // if(count($err) <= 0){
            
        //     $model = new \App\Models\EventModel();
        //     $id = $model->insert($data);
            
        //     if($id){
        //         $data['success'] = true;
        //         $data['msg'] = "success";
        //         $data['event_id'] = $id;
        //         $data['error'] = $err;
    
        //         return $this->response->setJSON($data);
        //     }
        // }

        $result['success'] = false;
        $result['msg'] = "Bad Input Fields";
        $result['event_id'] = $id;
        $result['errors'] = [];
       
        return $this->response->setJSON($result);
    }

        
       

    public function editEvent()
    {
        $categoryModel = new \App\Models\EventCategoryModel();
        $eventClassificationModel = new \App\Models\EventClassificationModel();
        $eventStatusModel = new \App\Models\EventStatusModel();
        $eventMetaModel = new \App\Models\EventKpiModel();
        $metasModel = new \App\Models\KpisModel();
        $eventModel = new \App\Models\EventModel();
        $id = $this->request->getVar('id');
        $data = [];

        if(!$id){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $event = $eventModel->find($id);

        if ($event){
            $eventMetaModel->select('event_meta.*, metas.name as meta_name');
            $eventMetaModel->join('metas', 'event_meta.kpi_id = metas.id');
            $eventMetaModel->where('event_id', $id);


            $data = [
                'event' => $event,
                'categories' => $categoryModel->findAll(),
                'classifications' => $eventClassificationModel->findAll(),
                'event_meta' => $eventMetaModel->findAll(),
                'meta' => $metasModel->findAll(),
                'ev_status' => $eventStatusModel->findAll(),
                'event_id' => 0,
            ];

        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('event_edit', $data);
    }

    public function updateEvent()
    {
        
        $categoryModel = new \App\Models\EventCategoryModel();
        $eventClassificationModel = new \App\Models\EventClassificationModel();
        $eventStatusModel = new \App\Models\EventStatusModel();
        $eventMetaModel = new \App\Models\EventKpiModel();
        $metasModel = new \App\Models\KpisModel();
        $eventModel = new \App\Models\EventModel();
        $id = $this->request->getVar('id');
        $data = [];

        if( !isset($id) || $id <= 0){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        

        $dataInput = [
            'id' => $id,
            'title' =>  $this->request->getVar('event_name'),
            'tite_ar' =>  $this->request->getVar('event_name_ar'),
            'description' =>  $this->request->getVar('description'),
            'description_ar' =>  $this->request->getVar('description_ar'),
            'end_date' =>  $this->request->getVar('end_date'),
            'start_date' =>  $this->request->getVar('start_date'),
            'enabled' =>  $this->request->getVar('enabled'),
            'category_id' =>  $this->request->getVar('category'),
            'classification_id' =>  $this->request->getVar('event_classification'),
            'connected_tech' =>  $this->request->getVar('connected_tech'),
            'staus_id' =>  $this->request->getVar('status'),
            'manager_name' =>  $this->request->getVar('manager_name'),
            'manager_email' =>  $this->request->getVar('manager_email'),                       
            'location' =>  $this->request->getVar('location'),                       
            'latitude' =>  $this->request->getVar('latitude'),                       
            'longitude' =>  $this->request->getVar('longitude'),                       
            'region' =>  $this->request->getVar('region'),                       
            'state' =>  $this->request->getVar('state'),                       
            'city' =>  $this->request->getVar('city'),                       
            'map_region' =>  $this->request->getVar('map_region'),                       
        ];

        // $meta_input = $this->request->getVar('');
        // foreach($meta_input as $m){
        //     $data[
        //         '' => $m[''],
        //     ];
        // }

        
        $result = $eventModel->save($dataInput);

        $eventMetaModel->select('event_meta.*, metas.name as meta_name');
        $eventMetaModel->join('metas', 'event_meta.kpi_id = metas.id');
        $eventMetaModel->where('event_id', $id);

        $data = [
            'event' => $eventModel->find($id),
            'categories' => $categoryModel->findAll(),
            'classifications' => $eventClassificationModel->findAll(),
            'event_meta' => $eventMetaModel->findAll(),
            'meta' => $metasModel->findAll(),
            'ev_status' => $eventStatusModel->findAll(),
            'event_id' => 0,
            'success' => $result ? true : false,
            'msg' => $result ? 'event saved successfully' : 'error: cant save event',
        ];

        return view('event_edit', $data);
    }

    public function deleteEventAjax()
    {
        $id = $this->request->getVar('id');
        $eventModel = new \App\Models\EventModel();
        $result = $eventModel->delete($id);

       
        return $this->response->setJSON([
            'success' => (bool)$result,
            'msg' => $result ? 'event deleted successfully' : 'error: cant delete event',
        ]);
       

    }
    // public function addAddressAjax(){

    //     $data = [
    //         'location' =>  $this->request->getVar('location'),
    //         'latitude' =>  $this->request->getVar('latitude'),
    //         'longitude' =>  $this->request->getVar('longitude'),
    //         'region' =>  $this->request->getVar('region'),
    //         'state' =>  $this->request->getVar('state'),
    //         'city' =>  $this->request->getVar('city'),
    //         'map_region' =>  $this->request->getVar('map_region'),
    //     ];

    //     return '';
    // }

    public function deleteOptionFromEventAjax(){
        $eventMetaModel = new \App\Models\EventKpiModel();
        $result = $eventMetaModel->delete($this->request->getVar('id'));
        if($result){
            return $this->response->setJSON([
                'success' => true,
                'msg' => 'success',
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'msg' => 'error bad request',
        ]);
    }

    public function addOptionToEventAjax(){
        
        $data = [
            'event_id' => $this->request->getVar('event_id'),
            'kpi_id' => $this->request->getVar('kpi_id'),
            'kpi_value' => $this->request->getVar('kpi_value'),
            'update_date' => date('d m Y H:i:s'),
            'user_id' => 'NULL',
        ];

        $kips_model = new \App\Models\EventKpiModel();
        $kpi = $kips_model->where('kpi_id', $this->request->getVar('kpi_id'))->first();
        if ($kpi){
            $kpi['kpi_value'] =  $this->request->getVar('kpi_value');
        }
        $kpi = $kips_model->save($data);

        if( $kpi ){

            $resp = [
                'success' => true,
                'msg' => 'success',
                'kpi' => $kips_model->where('event_id', $data['event_id'])->findAll(),
            ];
            return $this->response->setJSON($resp);
        }
        
        $resp = [
            'success' => false,
            'msg' => 'error',               
        ];
        return $this->response->setJSON($resp);
    }

    public function createOptionAjax()
    {    
        $metasModel = new \App\Models\KpisModel();

        $data = [
            'name' => $this->request->getPost('pki_name'),
            'frequent_update' => $this->request->getPost('updating_period'),
            'input_type' => $this->request->getPost('input_type'),
        ];

        $res = $metasModel->insert($data);
        if($res){

            $db = \Config\Database::connect();
            $sql = "SELECT kpis.id, kpis.name, kpi_update_ref.name as update_name, kpi_input_ref.name as input_name ";
            $sql .= "FROM kpis ";
            $sql .= "JOIN kpi_update_ref ON (kpis.frequent_update = kpi_update_ref.id) ";
            $sql .= "JOIN kpi_input_ref ON (kpis.input_type = kpi_input_ref.id) ";
            $sql .= " WHERE kpis.id = ".$res;
           
            $query = $db->query($sql);
            

            return $this->response->setJSON( [
                'success' => (bool)$res,
                'msg' => 'Option added successfully',
                'option' => $query->getResultArray(),
            ]); 
        }

        return $this->response->setJSON([
            'success' => false,
            'msg' => 'error cant add option (kpi)',
        ]);

    }

    public function listOption()
    {    
        $db = \Config\Database::connect();
        $kpis = $db->query("SELECT kpis.id, kpis.name, kpis.frequent_update as frequent_update_id,
         kpis.input_type as input_type_id, kpi_update_ref.name as update_type, kpi_update_ref.name_ar as update_type_ar,
         kpi_input_ref.name as input_type, kpi_input_ref.name_ar as input_type_ar
        FROM kpis
        LEFT JOIN kpi_update_ref ON ( kpis.frequent_update = kpi_update_ref.id )
        LEFT JOIN kpi_input_ref ON ( kpis.input_type = kpi_input_ref.id )");
        
        $pki_input_ref = $db->query('SELECT * FROM kpi_input_ref');
        $pki_update_ref = $db->query('SELECT * FROM kpi_update_ref');
        
        // $page = $this->request->getVar('page');
        
        // if(isset($page)){
            
        // }
        
        $data = [
            'pki_input_ref' => $pki_input_ref->getResult(),
            'pki_update_ref' => $pki_update_ref->getResult(),
            'event_kpis' => $kpis->getResult(),
            // 'pager' => $kpis->pager,
        ];

        return view('option_add_edit', $data);
    }

    public function listOption2()
    {
        $id = $this->request->getGet('id');
        $comm = $this->request->getGet('c');
        if (!$id || $id <= 0){
            return $this->response->setJSON([
                'success' => false,
                'msg' => 'bad req',
            ]);
        }

        $option = new \App\Models\EventKpiModel();
        $result = false;
        $data = $this->request->getPost();
        $err = '';

        if ($comm == 'del'){
            $result = $option->delete($id);
        } elseif ($comm == 'upd' || $comm == 'add') {
            $result = $option->save($data);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'msg' => 'bad req',
            ]);
        }


        $kpis = $option->where('event_id', $id);
        $db = \Config\Database::connect();
        $pki_input_ref = $db->query('SELECT * FROM pki_input_ref');
        $pki_update_ref = $db->query('SELECT * FROM pki_update_ref');


        $data = [
            'success' => (bool)$result,
            'msg' => $err,
            'pki_input_ref' => $pki_input_ref->getResult(),
            'pki_update_ref' => $pki_update_ref->getResult(),
            'event_kpis' => $kpis->findAll(),
        ];

        return $this->response->setJSON($data);
    }

    public function updateOptionAjax()
    {    
        $metasModel = new \App\Models\KpisModel();

        $data = [
            'id' => $this->request->getVar('id'),
            'name' => $this->request->getVar('name'),
            'frequent_update' => $this->request->getVar('frequent_update'),
            'input_type' => $this->request->getVar('input_type'),
        ];

        if($metasModel->update($data)){
            return $this->response->setJSON([
                'success' => true,
                'msg' => 'updated successfully',
                'option' => $metasModel->find($data['id']),
            ]); 
        }

        return $this->response->setJSON([
            'success' => false,
            'msg' => 'error cant update the option',
        ]); 
       
    }
   

    public function deleteOptionAjax(){
        $metasModel = new \App\Models\KpisModel();

        $data = $this->request->getVar('id');
            
        if($metasModel->delete($data)){
            return $this->response->setJSON([
                'success' => true,
                'msg' => 'deleted successfully',
            ]); 
        }

        return $this->response->setJSON([
            'success' => false,
            'msg' => 'error cant delete the option',
        ]); 
    }
    
    public function calender()
    {       
        $data = [
            'page_title' => 'Events calender',
        ];

        return view('calender_event', $data);
    }

    public function calenderAjax()
    {
        
        $model = new \App\Models\EventModel();
        $model->select('id, title, end_date, start_date');
        if ($this->request->getGet('start')) {
            $model->where('start_date >=', $this->request->getGet('start'));
        }
    
        if ($this->request->getGet('end')) {
            $model->where('end_date <=', $this->request->getGet('end'));
        }

        $data = [];
        foreach ($model->findAll(50) as $value) {

            $data[] = [
            'id'=> $value['id'],
            'allDay'=> false,
            'title'=> $value['title'],
            'url'=> base_url().'/events/view?id='.$value['id'],
            'start' => date('c', strtotime($value['start_date'])),
            'end' => date('c', strtotime($value['end_date'])),
            //'backgroundColor' => '',
            //'borderColor' => '',
            //'textColor' => '',
            'editable'=> false,    
            ];
        }
        return $this->response->setJSON($data);
       
    }

    public function listKPI($id){
        $option = new \App\Models\KpisModel();
        $db = \Config\Database::connect();

        $result = $option->select()->where('event_id', $id)->findAll();
        $kpi_input_ref = $db->query('SELECT * FROM kpi_input_ref');
        $kpi_update_ref = $db->query('SELECT * FROM kpi_update_ref');

        $data = [
            'kpis' => $result,
            'kpi_update_ref' => $kpi_update_ref->getResultArray(),
            'kpi_input_ref' => $kpi_input_ref->getResultArray(),
        ];

        return view('kpi_list.php', $data);
    }
    
    public function test($var = null)
    {
        # code...
    }
}
