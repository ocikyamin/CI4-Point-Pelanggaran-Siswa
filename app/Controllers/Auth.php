<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;
// Panggil Model Guru 
use App\Models\GuruModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('Auth/index');
    }

    public function LoginCheck()
    {
        if ($this->request->isAJAX()) {
            $is_santri = $this->request->getPost('is_santri');
            $this->validate= \Config\Services::validation();
            $validate = $this->validate(
            [
            'user_code' => [
            'label'  => 'NUPTK',
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
                'user_code' => $this->validate->getError('user_code'),
                'user_pass' => $this->validate->getError('user_pass')
                ]
                ];
            }else{
                $userCode = $this->request->getPost('user_code');
                $userPass = $this->request->getPost('user_pass');
                $guruModel = new GuruModel;
                $checkCode = $guruModel->GuruCode($userCode);
                // Cek Jika Kode ditemukan 
                if ($checkCode) {
                // Periksa apakah statusnya aktif 
                if ($checkCode->is_active==1) {
                // Cek Password 
                $pass_is_valid = Hash::check($userPass, $checkCode->password);
                if ($pass_is_valid) {
                    $new_session = ['teach_sess' => intval($checkCode->id)];
                    session()->set($new_session);
                    $msg = ['success'=> ['status'=> 200,'link_to'=>base_url('teacher')]
                ];
                }else{
                    $msg = ['error' => ['user_pass' => 'Password Salah']];
                    }
                }else{
                    $msg = ['error' => ['user_code' => 'Akun Belum di aktivasi']];
                }

                }else{
                    $msg = ['error' => ['user_code' => 'NUPK Tidak Ditemukan']];
                }
                            
                
            }
            echo json_encode($msg);
        }
    }

    public function Register()
    {
       return view('Auth/Register'); 
    }

    public function RegisterCheck()
    {
      if ($this->request->isAJAX()) {
         $is_santri = $this->request->getPost('is_santri');
         $this->validate= \Config\Services::validation();
         $validate = $this->validate(
         [
         'nuptk' => [
         'label'  => 'NUPTK',
         'rules'  => 'required|is_unique[m_guru.nuptk]|min_length[7]|max_length[17]',
         'errors' => [
         'required' => '{field} Tidak Boleh Kosong',
         'is_unique' => '{field} Telah Terdaftar',
         'min_length' => '{field} Minimal 7 Angka',
         'max_length' => '{field} Maksimal 16 Angka'
         ]
         ],
         'full_name' => [
         'label'  => 'Nama Lengkap',
         'rules'  => 'required',
         'errors' => [
         'required' => '{field} Tidak Boleh Kosong'
         ]
         ],
         'user_type' => [
         'label'  => 'Jenis Akun',
         'rules'  => 'required',
         'errors' => [
         'required' => '{field} Tidak Boleh Kosong'
         ]
         ],
         'new_password' => [
         'label'  => 'Password Baru',
         'rules'  => 'required',
         'errors' => [
         'required' => '{field} Tidak Boleh Kosong'
         ]
         ],
         'conf_password' => [
         'label'  => 'Konfirmasi Password',
         'rules'  => 'required|matches[new_password]',
         'errors' => [
         'required' => '{field} Tidak Boleh Kosong',
         'matches' => '{field} Tidak Cocok'
         ]
         ],

         'is_confirm' => [
             'label'  => 'Konfirmasi Persetujuan',
             'rules'  => 'required',
             'errors' => [
             'required' => '{field} Harus dicentang'
             ]
             ],
         ]
         );
 
         if (!$validate) {
             $msg = [
             'error' => [
             'nuptk' => $this->validate->getError('nuptk'),
             'full_name' => $this->validate->getError('full_name'),
             'user_type' => $this->validate->getError('user_type'),
             'new_password' => $this->validate->getError('new_password'),
             'conf_password' => $this->validate->getError('conf_password'),
             'is_confirm' => $this->validate->getError('is_confirm')
             ]
             ];
         }else{
             $data = [
                 'nuptk'=> $this->request->getPost('nuptk'),
                 'password'=> Hash::make($this->request->getPost('conf_password')),
                 'nm_guru'=> $this->request->getPost('full_name'),
                 'type'=> $this->request->getPost('user_type'),
             ];
             $guruModel = new GuruModel;
             $save= $guruModel->save($data);
             $msg = [
                'status'=> 200,
                'msg'=> 'Pendaftaran sebagai '.$this->request->getPost('user_type'). ' Berhasil. Menunggu diperiksa Oleh Admin' ];
         }
         echo json_encode($msg);
     }
    }

    public function FormSelectedRombel()
    {
       if ($this->request->isAJAX()) {
        $msg = ['view'=> view('Auth/formPilihRombel')];
        echo json_encode($msg);
       }
    }


}
