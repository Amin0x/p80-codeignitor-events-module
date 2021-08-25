<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'events';

    public function get_count() {
        return $this->db->count_all($this->table);
    }
}