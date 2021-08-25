<?php

namespace App\Controllers;

class Events extends BaseController
{
    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('eventmodel');
        $this->load->library("pagination");
    }

	public function index()
	{
		// $config = array();
        // $config["base_url"] = base_url() . "events";
        // $config["total_rows"] = $this->eventmodel->get_count();
        // $config["per_page"] = 10;
        // $config["uri_segment"] = 2;

        // $this->pagination->initialize($config);

        // $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        // $data["links"] = $this->pagination->create_links();

        // $data['authors'] = $this->eventmodel->get_authors($config["per_page"], $page);

        $model = new \App\Models\EventModel();

        $data = [
            'events' => $model->paginate(10),
            'pager' => $model->pager,
        ];
        

        return view('event_list', $data);
	}

    public function add()
    {
        return view('event_add');
    }

    public function edit()
    {
        return view('event_edit');
    }

    public function del($event = null)
    {
        
    }

    public function update($var = null)
    {
        # code...
    }

    public function test($var = null)
    {
        # code...
    }
}
