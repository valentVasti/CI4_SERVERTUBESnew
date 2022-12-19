<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelQueue extends Model
{
    protected $table = 'queue';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_bengkel','id_user','no_antrian','kerusakan','tanggal'
    ];
}

