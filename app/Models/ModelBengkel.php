<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBengkel extends Model
{
    protected $table = 'bengkel';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama','alamat','jamOperasional','jenis'
    ];
}
