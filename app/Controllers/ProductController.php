<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\CommentsModel;
use App\Models\OrdersDetailModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

//FUNGSI2 USER BISA JUAL BARANG
    public function index()
    {
        // Mendapatkan ID user yang sedang login
        $userId = session()->get('user_id');
        // Ambil semua produk milik user dari database
        $userProducts = $this->productModel
            ->where('id_user', $userId)
            ->getProductsWithCategory();

        // Kirim data ke view
        return view('pages/user-products', ['products' => $userProducts]);
    }

    public function userProductForm($id = null)
    {
        $data['categories'] = $this->categoryModel->findAll();
        $data['product'] = null;
        if ($id) {
            // Pastikan produk milik user
            $product = $this->productModel->where('id', $id)
                                        ->where('id_user', session()->get('user_id')) // ID user dari sesi login
                                        ->first();
            if (!$product) {
                return redirect()->to('/products')->with('error', 'Anda tidak memiliki izin untuk mengakses produk ini.');
            }
            $data['product'] = $product;
        }
        return view('pages/user-product-form', $data);
    }

    public function userSave()
    {
        $file = $this->request->getFile('image');
        $imageName = $file->isValid() ? $file->getRandomName() : '';

        if ($imageName) {
            $file->move('uploads', $imageName);
        }
        $id = $this->request->getPost('id');
        $productData = [
            'id_category' => $this->request->getPost('category'),
            'title' => $this->request->getPost('productName'),
            'desc' => $this->request->getPost('desc'),
            'price' => $this->request->getPost('price'),
            'is_available' => $this->request->getPost('stock') === 'available' ? 1 : 0,
            'slug' => $this->request->getPost('slug'),
            'image' => $imageName ?: $this->request->getPost('current_image'),
            'id_user' => session()->get('user_id'), // Pastikan ID user tersimpan
        ];
        if ($id) {
            // Periksa apakah produk milik user sebelum update
            $product = $this->productModel->where('id', $id)
                                        ->where('id_user', session()->get('user_id'))
                                        ->first();
            if (!$product) {
                return redirect()->to('/products')->with('error', 'Anda tidak memiliki izin untuk memperbarui produk ini.');
            }
            $this->productModel->update($id, $productData);
        } else {
            $this->productModel->insert($productData);
        }
        return redirect()->to('/products')->with('success', 'Produk berhasil disimpan.');
    }

    public function userDelete($id)
    {
        // Pastikan produk milik user sebelum hapus
        $product = $this->productModel->where('id', $id)
                                    ->where('id_user', session()->get('user_id'))
                                    ->first();
        if (!$product) {
            return redirect()->to('/products')->with('error', 'Anda tidak memiliki izin untuk menghapus produk ini.');
        }
        $this->productModel->delete($id);
        return redirect()->to('/products')->with('success', 'Produk berhasil dihapus.');
    }

    public function userSales()
    {
        $userId = session()->get('user_id');
        $ordersDetailModel = new OrdersDetailModel();

        // Ambil data penjualan berdasarkan produk user
        $salesData = $ordersDetailModel->getUserProductSales($userId);
        if (!$salesData) {
            $salesData = []; // Pastikan selalu mengirim array kosong jika tidak ada data
        }
        // Kirim data ke view
        return view('pages/user-sales', ['salesData' => $salesData]);
    }

    public function display($categorySlug, $productSlug)
    {
        $productModel = new ProductModel();
        $ordersDetailModel = new OrdersDetailModel();
        $commentsModel = new CommentsModel();
        $product = $productModel->getProductBySlugs($categorySlug, $productSlug);
        if (!$product) {
            return redirect()->to('/')->with('error', 'Produk tidak ditemukan.');
        }
        
        $comments = $commentsModel->getCommentsByProduct($product['id']);

        // Jika produk tidak ditemukan
        if (!$product) {
            return redirect()->to('/')->with('error', 'Produk tidak ditemukan.');
        }

        $isPurchased = false;
        if (session()->has('user_id')) {
            $userId = session('user_id');
            $isPurchased = $ordersDetailModel->join('orders', 'orders.id = orders_detail.id_orders')
                                             ->where('orders_detail.id_product', $product['id'])
                                             ->where('orders.id_user', $userId)
                                             ->countAllResults() > 0;
        }

        // Kirim data ke view
        return view('pages/product-display', [
            'product' => $product,
            'comments' => $comments,
            'isPurchased' => $isPurchased,
        ]);
    }

    public function addComment()
    {
        $commentsModel = new CommentsModel();

        $userId = session('user_id');
        $productId = $this->request->getPost('id_product');
        $comment = $this->request->getPost('comment');

        // Validasi input
        if (!$userId || !$productId || !$comment) {
            return redirect()->back()->with('error', 'Komentar tidak valid.');
        }

        // Simpan komentar
        $commentsModel->insert([
            'id_product' => $productId,
            'id_user' => $userId,
            'comment' => $comment,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }






// DIBAWAH INI ADALAH FEATURE ADMIN CRUD, BUKAN USER

    // Form untuk create/edit produk
    public function productForm($id = null)
    {
        $data['categories'] = $this->categoryModel->findAll();
        $data['product'] = $id ? $this->productModel->find($id) : null;
        return view('admin/admin-product-form', $data);
    }

    // Fungsi untuk menyimpan atau memperbarui produk
    public function save()
    {
        $file = $this->request->getFile('image');
        $imageName = $file->isValid() ? $file->getRandomName() : '';

        if ($imageName) {
            $file->move('uploads', $imageName);
        }

        $id = $this->request->getPost('id');
        $productData = [
            'id_category' => $this->request->getPost('category'),
            'title' => $this->request->getPost('productName'),
            'desc' => $this->request->getPost('desc'),
            'price' => $this->request->getPost('price'),
            'is_available' => $this->request->getPost('stock') === 'available' ? 1 : 0,
            'slug' => $this->request->getPost('slug'),
            'image' => $imageName ?: $this->request->getPost('current_image'),
        ];

        if ($id) {
            $this->productModel->update($id, $productData);
        } else {
            $this->productModel->insert($productData);
        }

        return redirect()->to('/admin/panel');
    }

    // Fungsi untuk menghapus produk
    public function delete($id)
    {
        $this->productModel->delete($id);
        return redirect()->to('/admin/panel');
    }
}
