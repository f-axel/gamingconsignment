<?php

namespace App\Controllers;
use App\Models\OrdersModel;
use App\Models\OrdersDetailModel;
use App\Models\OrdersConfirmModel;
use App\Models\ProductModel;
use CodeIgniter\Controller;

class OrderController extends Controller
{
    //buka list orders
    public function index()
    {
        $ordersModel = new OrdersModel();
        $session = session();

        // Ambil ID user dari sesi
        $id_user = $session->get('user_id');

        // Ambil data orders berdasarkan ID user
        $orders = $ordersModel->where('id_user', $id_user)->orderBy('date', 'DESC')->findAll();

        // Kirim data orders ke view
        return view('pages/orders', ['orders' => $orders]);
    }


    //buka detail orders
    public function detail($id) 
    {
        $ordersModel = new OrdersModel();
        $ordersDetailModel = new OrdersDetailModel();
        $productModel = new ProductModel();

        // Ambil informasi order berdasarkan ID
        $order = $ordersModel->find($id);
        if (!$order) {
            return redirect()->to('/orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Ambil rincian produk berdasarkan id_orders
        $orderDetails = $ordersDetailModel->where('id_orders', $id)->findAll();

        // Gabungkan data produk untuk mendapatkan nama dan harga
        foreach ($orderDetails as &$detail) {
            $product = $productModel->find($detail['id_product']);
            $detail['product_name'] = $product['title'] ?? 'Produk tidak ditemukan';
            $detail['product_price'] = $product['price'] ?? 0;
        }

        // Kirim data ke view
        return view('pages/orders-detail', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }


    //view: untuk konfirmasi order
    public function confirm($id)
    {
        $orderModel = new OrdersModel();
        $order = $orderModel->find($id);

        if (!$order) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pesanan tidak ditemukan.');
        }

        return view('pages/orders-confirm', [
            'order' => $order,
        ]);
    }

    //method post untuk konfirmasi order
    public function submitConfirm($id)
        {
            $orderModel = new OrdersModel();
            $orderConfirmModel = new OrdersConfirmModel();

            $order = $orderModel->find($id);

            if (!$order || strtolower($order['status']) !== 'waiting') {
                return redirect()->to('/orders')->with('error', 'Pesanan tidak valid untuk konfirmasi.');
            }

            $file = $this->request->getFile('proof_image');

            // Periksa apakah file valid
            if (!$file->isValid()) {
                return redirect()->back()->with('error', 'Gagal mengunggah gambar. Pastikan file valid.');
            }

            // Periksa apakah file diunggah
            if (!$file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move('uploads', $imageName);
            } else {
                return redirect()->back()->with('error', 'File sudah dipindahkan sebelumnya.');
            }

            $data = [
                'id_orders' => $id,
                'account_name' => $this->request->getPost('account_name'),
                'nominal' => $this->request->getPost('amount'),
                'note' => $this->request->getPost('notes'),
                'image' => $imageName,
            ];

            $orderConfirmModel->insert($data);


            return redirect()->to('/orders')->with('success', 'Konfirmasi pembayaran berhasil disubmit.');
        }

}
