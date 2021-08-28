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

        if($this->request->getVar('category')){
            $model->where('category_id', $this->request->getVar('category'));
        }
        
        if($this->request->getVar('enabled')){
            $model->where('enabled', $this->request->getVar('enabled'));
        }

        if($this->request->getVar('classification')){
            $model->where('classification_id', $this->request->getVar('classification'));
        }

        if($this->request->getVar('tech')){
            $model->where('connected_tech', $this->request->getVar('tech'));
        }

        if($this->request->getVar('staus')){
            $model->where('staus_id', $this->request->getVar('staus'));
        }

        if($this->request->getVar('region')){
            $model->where('region', $this->request->getVar('region'));
        }

        if($this->request->getVar('state')){
            $model->where('state', $this->request->getVar('state'));
        }

        if($this->request->getVar('city')){
            $model->where('city', $this->request->getVar('city'));
        }
            

        $data = [
            'page_title' => 'Events',
            'events' => $model->paginate(10),
            'pager' => $model->pager,
        ];
        

        return view('event_list', $data);
	}

    public function calender()
    {
        return view('calender_event');
    }

    public function add()
    {
        $category = new \App\Models\EventCategoryModel();
        $classification = new \App\Models\EventClassificationModel();
        $ev_kpis = new \App\Models\MetasModel();
        $ev_status = new \App\Models\EventStatusModel();

        $data = [
            'category' => $category->findAll(50),
            'classification' => $classification->findAll(50),
            'ev_kpis' => $ev_kpis->findAll(50),
            'ev_status' => $ev_status->findAll(50),
            'event_id' => 0,
        ];

        return view('event_add', $data);
    }

    public function addEventAjax()
    {    
        $rules = [
            'event_name' => [ 'lable' => 'Event Name', 'rules' => 'required'],
            'description' => [ 'lable' => 'Description', 'rules' => 'required'],
            'end_date' => [ 'lable' => 'End Date', 'rules' => 'required'],
            'start_date' => [ 'lable' => 'Start Date', 'rules' => 'required'],
            'manager_name' => [ 'lable' => 'Manger Name', 'rules' => 'required'],
            'manager_email' => [ 'lable' => 'Manager Name', 'rules' => 'required|valid_email'],
        ];


        if(! $this->validate($rules)){
            return $this->response->setJSON(['success' => false, 'msg' => 'Error: Invalid Inputs',]);
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
            'manager_email' =>  $this->request->getVar('manager_email'),           
        ];
        
        $model = new \App\Models\EventModel();

        $id = $model->insert($data);

        if($id){

            $res_data = [
                'success' => true,
                'msg' => 'success',
                'event' => $id,
            ];
            return $this->response->setJSON($res_data);
        }
        
        $resp = [
            'success' => false,
            'msg' => 'failed',            
        ];
        return $this->response->setJSON($resp);
    }

    public function addAddressAjax(){

        $data = [
            'location' =>  $this->request->getVar('location'),
            'latitude' =>  $this->request->getVar('latitude'),
            'longitude' =>  $this->request->getVar('longitude'),
            'region' =>  $this->request->getVar('region'),
            'state' =>  $this->request->getVar('state'),
            'city' =>  $this->request->getVar('city'),
            'map_region' =>  $this->request->getVar('map_region'),
        ];

        return '';
    }

    public function addKPIToEventAjax(){
        $rules = [];
        if(! $this->validate($rules)){
            return $this->response->setJSON(['success' => false, 'msg' => $this->validator->listErrors(),]);
        }

        $data = [
            'event_id' => $this->request->getVar('event_id'),
            'kpi_id' => $this->request->getVar('kpi_id'),
            'kpi_value' => $this->request->getVar('kpi_value'),
            'update_date' => date('d m Y H:i:s'),
            'user_id' => 'NULL',
        ];

        $kips_model = new \App\Models\EventMetaModel();

        if( $kips_model->save($data) ){
            $resp = [
                'success' => true,
                'msg' => 'success',
                'id' => $kips_model->id,
            ];
            return $this->response->setJSON($resp);
        }
        
        $resp = [
            'success' => false,
            'msg' => 'error',               
        ];
        return $this->response->setJSON($resp);
    }

    public function addKPIAjax()
    {    
        $kpis = new \App\Models\MetasModel();

        $data = [
            'name' => $this->request->getPost('pki_name'),
            'frequent_update' => $this->request->getPost('updating_period'),
            'input_type' => $this->request->getPost('input_type'),
        ];

        $res = $kpis->insert($data);
        return $this->response->setJSON( [
            'success' => $res,
        ]); 
    }

    public function listPki()
    {    
        $db = \Config\Database::connect();
        $kpis = $db->query("SELECT event_kpis.id, event_kpis.name, event_kpis.frequent_update as frequent_update_id,
         event_kpis.input_type as input_type_id, pki_update_ref.name as update_type, pki_update_ref.name_ar as update_type_ar,
         pki_input_ref.name as input_type, pki_input_ref.name_ar as input_type_ar
        FROM event_kpis
        LEFT JOIN pki_update_ref ON (event_kpis.frequent_update = pki_update_ref.id )
        LEFT JOIN pki_input_ref ON (event_kpis.input_type = pki_input_ref.id )");
        
        $pki_input_ref = $db->query('SELECT * FROM pki_input_ref');
        $pki_update_ref = $db->query('SELECT * FROM pki_update_ref');
        
        // $page = $this->request->getVar('page');
        
        // if(isset($page)){
            
        // }
        
        $data = [
            'pki_input_ref' => $pki_input_ref->getResult(),
            'pki_update_ref' => $pki_update_ref->getResult(),
            'event_kpis' => $kpis->getResult(),
            // 'pager' => $kpis->pager,
        ];

        return view('add_pki', $data);
    }

    public function updatePkiAjax()
    {    
        return $this->response->setJSON( $this->request->getPost()); 
        //return $this->respondCreated();
        return 'success';
    }

    public function editEvent()
    {
        return view('event_edit');
    }

    public function deleteEventAjax($event = null)
    {
        
    }

    public function updateEvent($var = null)
    {
        # code...
    }

    public function deleteKPIAjax(){
        $model = new \App\Models\EventMetaModel();
        $id = $this->request->getPost('id');
        $model->where('id', $id)->delete();

        $resp = [
            'success' => true,
            'msg' => 'success',
        ];

        return $this->response->setJSON($resp);
    }
    
    public function test($var = null)
    {
        # code...
    }
}
