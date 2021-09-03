<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'events';
    protected $allowedFields  = [
        //'id',
        'title',
        'tite_ar',
        'description',
        'description_ar',
        'end_date',
        'start_date',
        'enabled',
        'category_id',
        'classification_id',
        'connected_tech',
        'staus_id',
        'manager_name',
        'manager_email',
        'location',
        'latitude',
        'longitude',
        'region',
        'state',
        'city',
        'map_region',
    ];

    protected $validationRules = [
        'title' => 'required',
        'description' =>  'required',
        'end_date' => 'required',
        'start_date' =>  'required',
        'manager_name' =>  'required',
        'manager_email' =>  'required|valid_email',
    ]; 

    protected $validationMessages = [
        'title'        => [
            'required' => 'Sorry. That email has already been taken. Please choose another.'
        ]
    ];

    public function get_count() {
        return $this->db->count_all($this->table);
    }
}