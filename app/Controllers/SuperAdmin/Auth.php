<?php

namespace App\Controllers\SuperAdmin;
use App\Libraries\Hash;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        // var_dump(Hash::make('Admin@UPTIK'));
        return view('SuperAdmin/Login');
    }

    public function CheckLogin()
    {
        if ($this->request->isAJAX()) {
            $this->validate= \Config\Services::validation();
            $validate = $this->validate(
            [
            'user_email' => [
            'label'  => 'Email',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Tidak Boleh Kosong'
            ]
            ],
            'user_pass' => [
            'label'  => 'Password',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Tidak Boleh Kosong'
            ]
            ]
            ]
            );
    
            if (!$validate) {
                $msg = [
                'error' => [
                'user_email' => $this->validate->getError('user_email'),
                'user_pass' => $this->validate->getError('user_pass')
                ]
                ];
            }else{
                $userEmail = $this->request->getPost('user_email');
                $userPass = $this->request->getPost('user_pass');
                $userM = new UserModel;
                $user = $userM->CheckEmail($userEmail);
                // Cek Jika Kode ditemukan 
                if ($user) {
                // Periksa apakah statusnya aktif 
                if ($user->is_active==1) {
                // Cek Password 
                $pass_is_valid = Hash::check($userPass, $user->user_password);
                if ($pass_is_valid) {
                    $new_session = ['super_sess' => intval($user->id)];
                    session()->set($new_session);
                    $msg = ['success'=> ['status'=> 200,'link_to'=>base_url('admin')]
                ];
                }else{
                    $msg = ['error' => ['user_pass' => 401]];
                    }
                }else{
                    $msg = ['error' => ['user_email' => 401]];
                }

                }else{
                    $msg = ['error' => ['user_email' => 404]];
                }
                            
                
            }
            echo json_encode($msg);
        }
    }
}
