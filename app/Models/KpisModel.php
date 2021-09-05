<?php
namespace App\Models;

use CodeIgniter\Model;

class KpisModel extends Model
{
    protected $table = 'kpis';
    protected $allowedFields  = [
        //'id',
        'name',
        'frequent_update',
        'input_type',
        'event_id'
    ];
    
}