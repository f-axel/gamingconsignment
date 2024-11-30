<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller 
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    //METHOD INDEX & EDIT BUAT EDIT USER SENDIRI 
    public function index()
    {
                // ambil ID pengguna yang sedang login dari session
                $userId = session()->get('user_id');
        
                // load model user dan ambil data pengguna berdasarkan ID
                $userModel = new UserModel();
                $data['user'] = $userModel->find($userId);
                
                // Tampilkan halaman profil dengan data pengguna
                return view('pages/profile', $data);
    }

    public function edit()
    {
        // cuman yg login yg bisa edit profil
        $userId = session()->get('user_id');
        $userModel = new UserModel();

        $data['user'] = $userModel->find($userId);

        // buka view edit profil trs kirim data
        return view('pages/profile-update', $data);
    }

    public function update()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel();

        // validasi data masuk dan update data
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            // Only update password if it's provided
            'password' => $this->request->getPost('password') ? password_hash($this->request->getPost('password'), PASSWORD_DEFAULT) : null,
        ];
        $userModel->update($userId, array_filter($data));

        // balik ke view profile
        return redirect()->to('/profile')->with('success', 'Profile updated successfully.');
    }


    

    //MULAI DARI SINI, METHODNYA UTK ADMIN CRUD

    public function userForm($id = null)
    {
        $data['user'] = $id ? $this->userModel->find($id) : null;
        return view('admin/admin-user-form', $data);
    }

    // Simpan Data User (Create dan Update)
    public function save()
    {
        $id = $this->request->getPost('id');

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('status') === 'active' ? 1 : 0,
        ];

        if ($id) { // Update
            if ($this->request->getPost('password')) {
                $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
            }
            $this->userModel->update($id, $data);
        } else { // Create
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
            $this->userModel->insert($data);
        }

        return redirect()->to('/admin/panel');
    }

    // Hapus User
    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/admin/panel');
    }
}