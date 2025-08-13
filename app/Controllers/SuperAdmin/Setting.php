<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\PelanggaranJenisModel;
use App\Models\PelanggaranItemModel;
use App\Models\PeriodeModel;
use App\Models\SekolahModel;
use App\Models\SemesterModel;

class Setting extends BaseController
{
    function __construct()  {
        $this->periodeM = New PeriodeModel();
        $this->semesterM = New SemesterModel();
        $this->sekolahM = New SekolahModel();
        $this->langgarM = New PelanggaranItemModel();
        
    }
    
    protected $helpers = ['master'];
    public function index()
    {
        $data = ['title'=> 'Settings',
    ];
        return view('SuperAdmin/Settings/index', $data);
    }

    // Pelanggaran 
    
    function LanggarList() {
        if ($this->request->isAJAX()) {
            $data = [
                'jenis'=> $this->langgarM->JenisPelanggaran()
            ];
            
            $view = ['view'=> view('SuperAdmin/Settings/Langgar/index', $data)];
            
            echo json_encode($view);
            
        }  
    }
    
    function AddItemLanggar() {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = [
                'jenis'=> $this->langgarM->JenisPelanggaran($id)
            ];
            
            $view = ['view'=> view('SuperAdmin/Settings/Langgar/Add', $data)];
            
            echo json_encode($view);
            
        }  
    }
    function EditItemLanggar() {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = [
                
                'jenis'=> $this->langgarM
                ->select('pelanggaran_item.*,pelanggaran_jenis.jenis')
                ->join('pelanggaran_jenis','pelanggaran_item.jenis_id=pelanggaran_jenis.id')
                ->where('pelanggaran_item.id', $id)->first()
            ];
            
            $view = ['view'=> view('SuperAdmin/Settings/Langgar/Edit', $data)];
            
            echo json_encode($view);
            
        }  
    }
    function StoreLanggar() {
        if ($this->request->isAJAX()) {
            $post= $this->request->getVar();
            $this->validate= \Config\Services::validation();
            $validate = $this->validate(
                [
            'nama_pelanggaran' => [
            'label'  => 'Nama Pelanggaran',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
            ]
            ],
            'poin' => [
            'label'  => 'Jumlah Poin',
            'rules'  => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
                ]
            ]
            ]
            );
    
            if (!$validate) {
                $msg = [
                'status'=> false,
                'nama_pelanggaran' => $this->validate->getError('nama_pelanggaran'),
                'poin' => $this->validate->getError('poin')
                ];
            }else{
                $data = [
                    'id'=> isset($post['item_id']) ? $post['item_id'] :null,
                    'jenis_id'=> $post['jenis'],
                    'nama_pelanggaran'=> $post['nama_pelanggaran'],
                    'poin'=> $post['poin']
                    
                ];
                $this->langgarM->save($data);
                $msg = ['status'=> true];
                
            }
            
            echo json_encode($msg);
            
        }  
    }
    function DeleteLanggar() {
        if ($this->request->isAJAX()) {
            $post= $this->request->getVar();
            $this->langgarM->delete($post['id']);
            $msg = ['status'=> true];
            echo json_encode($msg);
            
        }  
    }
    // Pelanggaran 
    // Periode 
    function PeriodeList() {
        if ($this->request->isAJAX()) {
            $data = [
                'periode'=> $this->periodeM->findAll(),
                'semester'=> $this->semesterM->findAll(),
            ];
    
            $view = ['view'=> view('SuperAdmin/Settings/Periode/index', $data)];
            
            echo json_encode($view);
            
        }  
    }
    function SetPeriodeStt() {
        if ($this->request->isAJAX()) {
            $post = $this->request->getPost();
            
            $data = [
                'id'=> $post['id'] ,
                'status_periode'=> $post['status']==1? null:1 ,
            ];
            
            $this->periodeM->save($data);
            // $cek = $this->periodeM->where('status_periode',1)->findAll();
            // if (!$cek) {
                //     $msg = ['status'=> true];
                // }else{
                    //     $msg = [
                        //         'status'=> false,
                        //         'msg'=> 'Pastikan Periode ada yang aktif.',
                        //     ];
                        // }
                        
                        $msg = [
                            'status'=> true,
                            'msg'=> $post['status']==1? 'Status Periode di Nonaktifkan':'Status Periode di aktifkan',
                        ];
                        echo json_encode($msg);
            
                    }  
    }
    function SetSemester() {
    if ($this->request->isAJAX()) {
    $post = $this->request->getPost();

    $data = [
        'id'=> $post['id'],
        'periode_id'=> $post['periode_id'],
        'status'=> $post['status']==1 ? null :1
    ];
    
    $this->semesterM->save($data);
    $msg = ['status'=> true];
    echo json_encode($msg);

    }  
    }
    function AddPeriode() {
        if ($this->request->isAJAX()) {
            $view = ['view'=> view('SuperAdmin/Settings/Periode/Add')];
            echo json_encode($view);
            
        }  
    }
    function EditPeriode() {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = ['p'=> $this->periodeM->find($id)];
            $view = ['view'=> view('SuperAdmin/Settings/Periode/Edit', $data)];
            echo json_encode($view);
            
        }  
    }
    
    function StorePeriode() {
        if ($this->request->isAJAX()) {
            $post= $this->request->getVar();
            $this->validate= \Config\Services::validation();
            $validate = $this->validate(
                [
                    'nm_periode' => [
                'label'  => 'Nama Tahun Pelajaran',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
                ]
            );
            
            if (!$validate) {
                $msg = [
                    'status'=> false,
                    'nm_periode' => $this->validate->getError('nm_periode'),
                ];
            }else{
                $data = [
                    'id'=> isset($post['id']) ? $post['id'] :null,
                    'nm_periode'=> $post['nm_periode']
                    
                ];
                $this->periodeM->save($data);
                $msg = ['status'=> true];
                
            }
            
            echo json_encode($msg);
            
        } 
        
    }
    function DeletePeriode() {
        if ($this->request->isAJAX()) {
            $post= $this->request->getVar();
            $this->periodeM->delete($post['id']);
            $msg = ['status'=> true];
            echo json_encode($msg);
            
        } 
    }
    
    // Sekolah
    function SekolahList() {
        if ($this->request->isAJAX()) {
            $data = [
                'sekolah'=> $this->sekolahM->findAll()
            ];
            
            $view = ['view'=> view('SuperAdmin/Settings/Sekolah/index', $data)];
            
            echo json_encode($view);
            
        }  
    }
    function AddSekolah() {
        if ($this->request->isAJAX()) {
            $view = ['view'=> view('SuperAdmin/Settings/Sekolah/Add')];
            echo json_encode($view);
            
        }  
    }
    function EditSekolah() {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = ['s'=> $this->sekolahM->find($id)];
            $view = ['view'=> view('SuperAdmin/Settings/Sekolah/Edit', $data)];
            echo json_encode($view);
            
        }  
    }
    function StoreSekolah() {
        if ($this->request->isAJAX()) {
            $post= $this->request->getVar();
            $this->validate= \Config\Services::validation();
            $validate = $this->validate(
                [
                'nm_sekolah' => [
                'label'  => 'Nama Sekolah / Madrasah',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
                ]
                ],
                'kepsek' => [
                'label'  => 'Nama Kepala Sekolah / Madrasah',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
                ]
                ],
                ]
            );
            
            if (!$validate) {
                $msg = [
                    'status'=> false,
                    'nm_sekolah' => $this->validate->getError('nm_sekolah'),
                    'kepsek' => $this->validate->getError('kepsek'),
                ];
            }else{
                $data = [
                    'id'=> isset($post['id']) ? $post['id'] :null,
                    'nm_sekolah'=> $post['nm_sekolah'],
                    'kepsek'=> $post['kepsek'],
                    
                ];
                $this->sekolahM->save($data);
                $msg = ['status'=> true];
                
            }
            
            echo json_encode($msg);
            
        } 
    }
    function DeleteSekolah() {
        if ($this->request->isAJAX()) {
            $post= $this->request->getVar();
            $this->sekolahM->delete($post['id']);
            $msg = ['status'=> true];
            echo json_encode($msg);
            
        } 
    }
}
