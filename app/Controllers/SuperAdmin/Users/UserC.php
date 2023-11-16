<?php

namespace App\Controllers\SuperAdmin\Users;
use App\Libraries\Hash;
use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\GuruModel;

class UserC extends BaseController
{
    protected $helpers = ['master'];
    public function index()
    {
        $data = ['title'=> 'Users',
    ];
        return view('SuperAdmin/Users/index', $data);
    }

    public function SuperUserList()
    {
        if ($this->request->isAJAX()) {
            $userM = new UserModel;
            $data = ['user'=> $userM->findAll()];
            $msg = ['user_table'=> view('SuperAdmin/Users/Super/table', $data)];
            echo json_encode($msg);
            
        }
    }

    public function GuruList()
    {
        if ($this->request->isAJAX()) {
            $guruM = new GuruModel;
            $data = ['guru'=> $guruM->findAll()];
            $msg = ['guru_table'=> view('SuperAdmin/Users/Guru/table', $data)];
            echo json_encode($msg);
            
        }
    }
    public function SetStatusGuru()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $guruM = new GuruModel;
            $guru = $guruM->find($id);
            $is_active = $guru['is_active'];
            $data = [
                'id'=> $id,
                'is_active'=> $is_active==1 ? NULL:1
            ];
            $guruM->save($data);
            $msg = [
                'sukses'=>201,
                'pesan'=> $is_active==1 ? 'Akun di Non Aktifkan': 'Akun di Aktifkan'
            ];
            echo json_encode($msg);
            
        }
    }

    public function ResetPasswordGuru()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $guruM = new GuruModel;
            $guru = $guruM->find($id);
            $nuptk = $guru['nuptk'];
            $data = [
                'id'=> $id,
                'password'=> Hash::make($nuptk)
            ];
            $guruM->save($data);
            $msg = [
                'sukses'=>201,
                'pesan'=> 'Password telah diubah ke '.$nuptk
            ];
            echo json_encode($msg);
            
        }
    }
}
