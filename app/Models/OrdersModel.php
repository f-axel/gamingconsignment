<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'date', 'invoice', 'total', 'name', 'address', 'phone', 'status'];
    protected $useTimestamps = true;
}
