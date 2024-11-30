<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller 
{

    //view ke halaman login
    public function login() 
    {
        return view('auth/login');
    }

    //method post saat klik login, proses auth
    public function loginPost() 
    {
        //buat session
        $session = session();
        $model = new UserModel();
        //ambil data input user dan masukin variable
        $name = $this->request->getVar('name');
        $password = $this->request->getVar('password');
        //ini buat remember me
        $remember = $this->request->getVar('remember');

        //variabel buat ambil data dr model yg udah ada
        $user = $model->where('name', $name)->first();
        
        //verifikasi inputan
        if ($user && password_verify($password, $user['password'])) {
            
            $session->set([
                'user_id'=> $user['id'],
                'isLoggedIn' => true,
                'role' => $user['role'],
                'name' => $user['name'],
                'user' => 'user'
            ]);
            //fitur remember me, kalo true nanti data nya kesimpen dan ga perlu login lagi
            if ($remember) {
                set_cookie('name', $name, 86400 * 30);
                set_cookie('password', $password, 86400 * 30);
            }

            //abis set session user, redirect ke home dgn kondisi udah login
            return redirect()->to('/');
        } else {
            //kondisi inputan salah dan gabisa login.
            $session->setFlashdata('error', 'name/password salah!');
            return redirect()->to('login');
            
        }
    }

    //view register
    public function register() 
    {
        return view('auth/register');
    }

    //method post kalo register, proses registrasi
    public function registerPost()
    {
        $name = $this->request->getPost('name');
        $password = $this->request->getPost('password');
        $email = $this->request->getPost('email');

        $userModel = new UserModel();
        // Cek apakah nama udah diambil belom
        if ($userModel->where('name', $name)->first()) {
        // Kalo nama udah ada, simpan pesan error dalam session
        return redirect()->back()->with('error', 'Nama sudah diambil. Silakan gunakan nama lain.');
        }

        // Kalo name tersedia, simpan dalem model
        $userModel->save([
        'name' => $name,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'email' => $email,
        ]);

        // Oper user ke halaman login
        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }   

    //proses logout 
    public function logout()
    {
        // Hapus session dan cookie
        session()->destroy();
        setcookie('remember_me', '', time() - 3600, "/");
        //balik ke halaman login
        return redirect()->to('/login');
    }
}