<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersDetailModel extends Model
{
    protected $table = 'orders_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_orders', 'id_product', 'qty', 'subtotal'];
    protected $useTimestamps = true;

    public function getUserProductSales($userId)
    {
        return $this->select('product.title, SUM(orders_detail.qty) as total_sold')
                    ->join('product', 'product.id = orders_detail.id_product')
                    ->where('product.id_user', $userId)
                    ->groupBy('orders_detail.id_product')
                    ->findAll();
    }

    public function getOrderDetailsWithProduct($orderId)
    {
        return $this->select('orders_detail.*, product.title as product_name')
                    ->join('product', 'product.id = orders_detail.id_product')
                    ->where('orders_detail.id_orders', $orderId)
                    ->findAll();
    }
}


