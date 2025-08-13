<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\KelasLevelModel;
use App\Models\KelasRombelModel;
use App\Models\PelanggaranItemModel;

class Master extends BaseController
{

    public function index()
    {
        //
    }
public function KelasLevel()
{
   if ($this->request->isAJAX()) {
    $sekolah_id = $this->request->getVar('sekolah_id');
    $mKelaslevel = new KelasLevelModel;
    $option = "";
    foreach ($mKelaslevel->LevelBySekolahId($sekolah_id) as $row) {
       $option .= '<option value="'.$row['id'].'">'.$row['level_kelas'].'</option>';

    }
    $msg = ['kelas_level'=>  $option];
    echo json_encode($msg);
   }
}

public function KelasRombel()
{
   if ($this->request->isAJAX()) {
    $periode_id = $this->request->getVar('periode_id');
    $level_id = $this->request->getVar('level_id');
    $mKelasRombel = new KelasRombelModel;
    $option = "";
    foreach ($mKelasRombel->RombelByLevelId($level_id, $periode_id) as $row) {
       $option .= '<option value="'.$row['id'].'">'.$row['rombel'].'</option>';

    }
    $msg = ['kelas_rombel'=>  $option];
    echo json_encode($msg);
   }
}
public function RombelBySekolahPeriode()
{
   if ($this->request->isAJAX()) {
    $sekolah_id = $this->request->getVar('sekolah_id');
    $periode_id = $this->request->getVar('periode_id');
    $mKelasRombel = new KelasRombelModel;
    $option = "";
    foreach ($mKelasRombel->RombelBySekolahPeriodeId($sekolah_id, $periode_id) as $row) {
       $option .= '<option value="'.$row['id'].'">'.$row['rombel'].'</option>';

    }
    $msg = ['kelas_rombel'=>  $option];
    echo json_encode($msg);
   }
}

public function ItemPelanggaranByJenis()
{
   if ($this->request->isAJAX()) {
      $jenis_id = $this->request->getVar('jenis_id');
      $mPelanggaranItem = new PelanggaranItemModel;
      $option = "";
      $i=1;
      foreach ($mPelanggaranItem->PelanggaranByJenis($jenis_id) as $row) {
         $option .= '<option value="'.$row['id'].'">'.$i++.'. '.$row['nama_pelanggaran'].'</option>';
  
      }
      $msg = ['item_pelanggaran'=>  $option];
      echo json_encode($msg);
     }
}


public function ItemPointById()
{
   if ($this->request->isAJAX()) {
      $id = $this->request->getVar('id');
      $mPelanggaranItem = new PelanggaranItemModel;
      $PointItemPelanggaran = $mPelanggaranItem->PointItemPelanggaran($id);
      $point = $PointItemPelanggaran->poin;
      $msg = ['point_item_pelanggaran'=>  $point];
      echo json_encode($msg);
     }
}

}
