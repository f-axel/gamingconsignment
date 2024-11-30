<?php

namespace App\Controllers;
use App\Models\CartModel;
use App\Models\OrdersModel;
use App\Models\OrdersDetailModel;
use App\Models\ProductModel;
use CodeIgniter\Controller;

class CartController extends Controller 
{
    public function index() 
    {
        $cartModel = new CartModel();
        $cartModel = new \App\Models\CartModel();
        $productModel = new \App\Models\ProductModel();
        $session = session();

        $id_user = $session->get('user_id');

        // Ambil data cart berdasarkan ID user
        $cartItems = $cartModel->where('id_user', $id_user)->findAll();

        $total = 0;
        foreach ($cartItems as &$item) {
            $product = $productModel->find($item['id_product']);
            $item['product_name'] = $product['title'];
            $item['product_price'] = $product['price'];
            $item['product_image'] = $product['image'];
            $item['subtotal'] = $item['qty'] * $product['price'];
            $total += $item['subtotal'];
        }

        return view('pages/cart', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    public function checkout() 
    {
        $cartModel = new CartModel();
        $productModel = new ProductModel();
        $session = session();

        // Ambil ID user dari session
        $id_user = $session->get('user_id');

        // Ambil item keranjang milik user
        $cartItems = $cartModel->where('id_user', $id_user)->findAll();

        $total = 0;
        foreach ($cartItems as &$item) {
            $product = $productModel->find($item['id_product']);
            $item['product_name'] = $product['title'];
            $item['product_price'] = $product['price'];
            $item['product_image'] = $product['image'];
            $item['subtotal'] = $item['qty'] * $product['price'];
            $total += $item['subtotal'];
        }

        // Kirim data ke view
        return view('pages/checkout', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);

    }

    public function checkoutConfirm()
    {
        $cartModel = new CartModel();
        $productModel = new ProductModel();
        $ordersModel = new OrdersModel();
        $ordersDetailModel = new OrdersDetailModel();
        $session = session();

        // Ambil data user
        $id_user = $session->get('user_id');

        // Ambil isi keranjang user
        $cartItems = $cartModel->where('id_user', $id_user)->findAll();

        if (empty($cartItems)) {
            return redirect()->to('/')->with('error', 'Keranjang belanja kosong!');
        }

        // Hitung total belanja
        $total = 0;
        foreach ($cartItems as $item) {
            $product = $productModel->find($item['id_product']);
            $total += $item['qty'] * $product['price'];
        }

        // Generate nomor order
        $orderNumber = strtoupper(uniqid('ORD-'));

        // Buat order
        $orderData = [
            'id_user' => $id_user,
            'date' => date('Y-m-d H:i:s'),
            'invoice' => $orderNumber,
            'total' => $total,
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'phone' => $this->request->getPost('phone'),
            'status' => 'Waiting',
        ];
        $id_order = $ordersModel->insert($orderData);

        // Simpan detail order
        foreach ($cartItems as $item) {
            $product = $productModel->find($item['id_product']);
            $ordersDetailModel->insert([
                'id_orders' => $id_order,
                'id_product' => $item['id_product'],
                'qty' => $item['qty'],
                'subtotal' => $item['qty'] * $product['price'],
            ]);
        }

        // Hapus isi keranjang
        $cartModel->where('id_user', $id_user)->delete();

        // Redirect ke halaman sukses
        return redirect()->to('/checkout-sukses')->with('orderNumber', $orderNumber)->with('total', $total)->with('id_order', $id_order);
    }
    
    //method untuk ke halaman checkout sukses, udah gini berarti order detail dibikin
    public function checkout_sukses() 
    {
        $session = session();
        $orderNumber = $session->getFlashdata('orderNumber');
        $total = $session->getFlashdata('total');
        $id_order = $session->getFlashdata('id_order');

        if (!$orderNumber || !$total) {
            return redirect()->to('/cart');
        }

        return view('pages/checkout-sukses', [
            'orderNumber' => $orderNumber,
            'total' => $total,
            'id_order' => $id_order
        ]);
    }


    //tambah barang ke shopping cart
    public function add()
    {
        //deklarasi variabel models
        $cartModel = new CartModel();
        $productModel = new ProductModel();
        $session = session();

        //ambil id user, id product sama jumlah product
        $id_user = $session->get('user_id'); 
        $id_product = $this->request->getPost('id_product');
        $qty = $this->request->getPost('qty');

        // Ambil detail produk untuk mendapatkan harga
        $product = $productModel->find($id_product);


        //handling tipis2
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Hitung subtotal
        $subtotal = $product['price'] * $qty;

        // Simpan ke tabel cart
        $cartModel->insert([
            'id_user' => $id_user,
            'id_product' => $id_product,
            'qty' => $qty,
            'subtotal' => $subtotal,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update($id)
    {
        $cartModel = new \App\Models\CartModel();

        // Ambil kuantitas baru dari form
        $qty = $this->request->getPost('qty');

        // Validasi jumlah kuantitas
        if ($qty < 1) {
            return redirect()->back()->with('error', 'Jumlah tidak valid.');
        }

        // Ambil data item cart
        $cartItem = $cartModel->find($id);

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Item tidak ditemukan.');
        }

        // Hitung subtotal baru
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($cartItem['id_product']);
        $subtotal = $product['price'] * $qty;

        // Update data di tabel cart
        $cartModel->update($id, [
            'qty' => $qty,
            'subtotal' => $subtotal,
        ]);

        return redirect()->back()->with('success', 'Jumlah berhasil diperbarui.');
    }

    public function remove($id)
    {
        $cartModel = new \App\Models\CartModel();

        // Cek apakah item ada di keranjang
        $cartItem = $cartModel->find($id);

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Item tidak ditemukan.');
        }

        // Hapus item dari tabel cart
        $cartModel->delete($id);

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }


}