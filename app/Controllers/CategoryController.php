<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use CodeIgniter\Controller;

class CategoryController extends Controller 
{
    //form buat create/update
    public function categoryForm($id = null)
    {
        $model = new CategoryModel();
        $data = [];

        if ($id) {
            // Ambil data kategori berdasarkan ID untuk mode edit
            $data['category'] = $model->find($id);
            if (!$data['category']) {
                // Jika ID tidak ditemukan, arahkan kembali ke halaman sebelumnya
                return redirect()->to('/admin/panel');
            }
        }

        // Tampilkan form create/update
        return view('admin/admin-category-form', $data);
    }

    //save buat create & update
    public function save() 
    {
        $model = new CategoryModel();
        $id = $this->request->getPost('id');
        $data = [
            'slug' => $this->request->getPost('slug'),
            'title' => $this->request->getPost('title')
        ];

        if($id) {
            //jika id ada, jadi update
            $model->update($id, $data);
        } else {
            //jika id gaada, jadi create
            $model->insert($data);
        }
        
        return redirect()->to('admin/panel');
    }

    //delete
    public function delete($id)
    {
        $model = new CategoryModel();
        $model->delete($id);
        return redirect()->to('admin/panel');
    }



}