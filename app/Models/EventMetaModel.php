<?php
namespace App\Models;

use CodeIgniter\Model;

class EventMetaModel extends Model
{
    protected $table = 'event_meta';
    protected $allowedFields  = [
        //'id',
        'event_id',
        'kpi_id',
        'kpi_value',        
        'update_date',        
        'user_id',        
    ];
}