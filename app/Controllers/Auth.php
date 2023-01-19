<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('login')) {
            if (session()->get('admin')) {
                return redirect()->to('/admin');
            } elseif (session()->get('kasir')) {
                return redirect()->to('/masuk');
            }
        }
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('login', $data);
    }

    public function auth()
    {
        $userModel = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $userModel->where('username', $username)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                if ($data['status'] == 'non-aktif') {
                    session()->setFlashdata('danger', 'Status anda Non-aktif tidak dapat masuk.');
                    return redirect()->to('/')->withInput();
                } else {
                    if ($data['role'] == 'admin') {
                        $session_login = [
                            'id_user' => $data['id_user'],
                            'nama' => $data['nm_user'],
                            'login' => true,
                            'admin' => true
                        ];
                        session()->set($session_login);
                        return redirect()->to('/admin');
                    } elseif ($data['role'] == 'kasir') {
                        $session_login = [
                            'id_user' => $data['id_user'],
                            'nama' => $data['nm_user'],
                            'login' => true,
                            'kasir' => true
                        ];
                        session()->set($session_login);
                        return redirect()->to('/masuk');
                    }
                }
            } else {
                session()->setFlashdata('danger', 'Password Salah.');
                return redirect()->to('/')->withInput();
            }
        } else {
            session()->setFlashdata('danger', 'Username Salah.');
            return redirect()->to('/')->withInput();
        }
    }
}
