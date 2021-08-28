<?php
namespace App\Models;

use CodeIgniter\Model;

class MetasModel extends Model
{
    protected $table = 'metas';
    protected $allowedFields  = [
        //'id',
        'name',
        'frequent_update',
        'input_type',        
    ];
    
}