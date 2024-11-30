<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersConfirmModel extends Model
{
    protected $table = 'orders_confirm';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_orders', 'account_name', 'account_number', 'nominal', 'note', 'image'];
    protected $useTimestamps = true;
}
