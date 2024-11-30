<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\OrdersConfirmModel;
use App\Models\OrdersDetailModel;
use App\Models\OrdersModel;
use App\Models\ProductModel;
use CodeIgniter\Controller;

class AdminController extends Controller 
{

    //untuk ke list semua order
    public function orderList() 
    {
        {
            $ordersModel = new OrdersModel();
            
            // Ambil semua data pesanan
            $orders = $ordersModel->findAll();
            
            // Kirim data ke view
            return view('admin/admin-order', [
                'orders' => $orders
            ]);
        }
    }

    //tampilan detail order
    public function orderDetail($id) 
        {
            {
                $ordersModel = new OrdersModel();
                $ordersDetailModel = new OrdersDetailModel();
                $ordersConfirmModel = new OrdersConfirmModel();
        
                // Ambil data order berdasarkan ID
                $order = $ordersModel->find($id);
        
                // Cek jika order tidak ditemukan
                if (!$order) {
                    return redirect()->to('/admin/orders')->with('error', 'Order tidak ditemukan.');
                }
        
                // Ambil detail produk dari order
                $orderDetails = $ordersDetailModel->getOrderDetailsWithProduct($id);
        
                // Ambil informasi konfirmasi pembayaran jika ada
                $orderConfirm = $ordersConfirmModel->where('id_orders', $id)->first();
        
                // Kirim data ke view
                return view('admin/admin-order-details', [
                    'order' => $order,
                    'orderDetails' => $orderDetails,
                    'orderConfirm' => $orderConfirm
                ]);
            }
        }

    public function updateOrderStatus($id)
        {
            $ordersModel = new OrdersModel();

            // Validasi data dari form
            $status = $this->request->getPost('order_status');

            if (!in_array($status, ['waiting', 'paid', 'delivered', 'cancelled'])) {
                return redirect()->to("/admin/order-details/$id")->with('error', 'Status order tidak valid.');
            }

            // Update status di database
            $ordersModel->update($id, ['status' => $status]);

            return redirect()->to("/admin/order-details/$id")->with('success', 'Status order berhasil diperbarui.');
        }


    //view admin panel buat crud products, category, user
    public function panel() 
    {   
        $categoryModel = new CategoryModel();
        $productModel = new ProductModel();
        $userModel = new UserModel();

        $data['categories'] = $categoryModel->findAll();
        $data['products'] = $productModel->getProductsWithCategory();
        $data['users'] = $userModel->findAll();

        return view('admin/admin-panel', $data);
    }

}
