<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\PelanggaranSiswaModel;

class History extends BaseController
{
    protected $helpers = ['guru'];
    public function index()
    {
        $mPelanggaran = new PelanggaranSiswaModel;
        $data = ['title'=> 'History',
        'history'=> $mPelanggaran->MyHistoryInput(TeacherLogin()->id)

    ];
        return view('Guru/History/index', $data);
    }
    public function Delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $mPelanggaran = new PelanggaranSiswaModel;
            $mPelanggaran->delete($id);
            $response = ['status'=> 201,'msg'=> 'Pelanggaran Dihapus'];
            echo json_encode($response);
        }
    }
}
