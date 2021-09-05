<?php
namespace App\Models;

use CodeIgniter\Model;

class EventKpiModel extends Model
{
    protected $table = 'event_kpi';
    protected $allowedFields  = [
        //'id',
        'event_id',
        'kpi_id',
        'kpi_value',        
        'update_date',        
        'user_id',        
    ];
}