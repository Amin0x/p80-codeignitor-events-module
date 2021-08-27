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

    public function get_count() {
        return $this->db->count_all($this->table);
    }
}