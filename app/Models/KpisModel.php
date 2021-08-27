<?php
namespace App\Models;

use CodeIgniter\Model;

class KpisModel extends Model
{
    protected $table = 'kpis';
    protected $allowedFields  = [
        //'id',
        'event_id',
        'kpi_id',
        'kpi_value',        
        'update_date',        
        'user_id',        
    ];
}