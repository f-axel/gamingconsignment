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

class Home extends BaseController
{
    public function index(): string
    {
                // Mulai session
                $session = session();
                $categoryModel = new CategoryModel();
                $productModel = new ProductModel();
                $data['categories'] = $categoryModel->findAll();
                $data['products'] = $productModel->getProductsWithCategoryAndUserAndSlugs(); // Panggil fungsi baru

                // Cek apakah role ada di session, jika tidak ada, arahkan ke halaman utama
                if (!$session->has('role')) {
                    return view('index', $data); 
                }
                // Ambil role dari session
                $role = $session->get('role');
                
                // Kalo ada data role, ke home sambil kirim data role
                return view('index',
                 [
                    'role' => $role,
                    'categories' => $data['categories'],
                    'products' => $data['products'],
                 ]);
    }
}
