<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\MapelModel;
use App\Models\SemesterModel;
use App\Models\KelasLevelModel;
use App\Models\KelasMengajarModel;


class Kelas extends BaseController
{
    protected $helpers = ['guru'];

    public function index()
    {
        if ($this->request->isAJAX()) {
            $kelasMengajarM = new KelasMengajarModel;
            $data = ['kelas'=> $kelasMengajarM->ByGuru(TeacherLogin()->id)];
            // dd($data);

            $view = ['table_kelas'=> view('Guru/Kelas/Table', $data) ];
            echo json_encode($view);
        }
    }
    public function Add()
    {
        if ($this->request->isAJAX()) {
            $mapelM = new MapelModel;
            $levelM = new KelasLevelModel;
            $semesterM = new SemesterModel;
            $data = [
            'mapel'=> $mapelM->findAll(),
            'level'=> $levelM->findAll(),
            'semester'=> $semesterM->findAll()
        ];
            $view = ['form_kelas'=> view('Guru/Kelas/Add', $data)];
            echo json_encode($view);
        }
    }

    public function Save()
    {
        if ($this->request->isAJAX()) {
            $kelasMenhajarM = new KelasMengajarModel;
            $data = [
                'guru_id'=> $this->request->getPost('guru_id'),
                'semester_id'=> $this->request->getPost('semester_id'),
                'mapel_id'=> $this->request->getPost('mapel_id'),
                'rombel_walas_id'=> $this->request->getPost('rombel_walas_id'),
                'deskripsi'=> $this->request->getPost('deskripsi')
        ];
        $kelasMenhajarM->save($data);
        $response = ['status'=> 201];
        echo json_encode($response);
        }
    }
    public function Delete()
    {
        if ($this->request->isAJAX()) {
            $kelasMenhajarM = new KelasMengajarModel;
            $id = $this->request->getPost('id');
         
        $kelasMenhajarM->delete($id);
        $response = ['status'=> 201,'msg'=> 'Data kelas telah dihapus secara permanen.'];
        echo json_encode($response);
        }
    }

    
}
