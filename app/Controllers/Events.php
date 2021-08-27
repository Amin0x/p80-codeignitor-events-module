<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;

class Events extends BaseController
{
    use ResponseTrait;

    public function __construct() {
        
    }

	public function index()
	{
		
        $model = new \App\Models\EventModel();

        $data = [
            'events' => $model->paginate(10),
            'pager' => $model->pager,
        ];
        

        return view('event_list', $data);
	}

    public function add()
    {
        $category = new \App\Models\EventCategoryModel();
        $classification = new \App\Models\EventClassificationModel();
        $ev_kpis = new \App\Models\EventKpisModel();
        $ev_status = new \App\Models\EventStatusModel();

        $data = [
            'category' => $category->findAll(50),
            'classification' => $classification->findAll(50),
            'ev_kpis' => $ev_kpis->findAll(50),
            'ev_status' => $ev_status->findAll(50),
        ];

        return view('event_add', $data);
    }

    public function addAjax()
    {    
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
            'location' =>  $this->request->getVar('location'),
            'latitude' =>  $this->request->getVar('latitude'),
            'longitude' =>  $this->request->getVar('longitude'),
            'region' =>  $this->request->getVar('region'),
            'state' =>  $this->request->getVar('state'),
            'city' =>  $this->request->getVar('city'),
            'map_region' =>  $this->request->getVar('map_region'),
        ];
        
        $model = new \App\Models\EventModel();

        $id = $model->insert($data);

        $res_data = [
            'event' => $id? $model->find($id) : '',
        ];

        return $this->response->setJSON($res_data);
    }

    public function addPkiAjax()
    {    
        $kpis = new \App\Models\EventKpisModel();

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

    public function deleteEvent($event = null)
    {
        
    }

    public function updateEvent($var = null)
    {
        # code...
    }

    public function test($var = null)
    {
        # code...
    }
}
