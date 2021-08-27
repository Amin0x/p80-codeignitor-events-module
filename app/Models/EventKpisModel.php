<?php
namespace App\Models;

use CodeIgniter\Model;

class EventKpisModel extends Model
{
    protected $table = 'event_kpis';
    protected $allowedFields  = [
        //'id',
        'name',
        'frequent_update',
        'input_type',        
    ];
    
}