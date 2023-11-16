<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasRombelWalasModel extends Model
{
    protected $table            = 'tm_kelas_rombel_walas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['periode_id','rombel_id','guru_id','status_walas'];


public function CheckWalas($periode,$rombel,$guru)
{
   return $this->db->table('tm_kelas_rombel_walas')
   ->select('tm_kelas_rombel_walas.id')
   ->where('tm_kelas_rombel_walas.periode_id', $periode)
   ->where('tm_kelas_rombel_walas.rombel_id', $rombel)
   ->where('tm_kelas_rombel_walas.guru_id', $guru)
   ->get()
   ->getRow();

}

public function ListOfRombelWalas()
{
   return $this->db->table('tm_kelas_rombel_walas')
   ->select('tm_kelas_rombel_walas.id,tm_kelas_rombel.rombel')
   ->join('tm_kelas_rombel','tm_kelas_rombel_walas.rombel_id=tm_kelas_rombel.id')
   ->join('periode','tm_kelas_rombel_walas.periode_id=periode.id')
   ->where('periode.status_periode', 1)
   ->orderBy('tm_kelas_rombel.id', 'asc')
   ->get()
   ->getResultArray();

}



public function DetailInfoRombelWalas($id)
{
   return $this->db->table('m_siswa_kelas')
   ->select('
   periode.nm_periode,
   tm_kelas_rombel.rombel,
   tm_kelas_level.level_kelas,
   sekolah.nm_sekolah,
   sekolah.kepsek,
   m_guru.nm_guru,
   m_siswa.nisn,
   m_siswa.nama_siswa')
   ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id','right')
   ->join('tm_kelas_rombel_walas','m_siswa_kelas.rombel_walas_id=tm_kelas_rombel_walas.id','right')
   ->join('periode','tm_kelas_rombel_walas.periode_id=periode.id','right')
   ->join('m_guru','tm_kelas_rombel_walas.guru_id=m_guru.id','right')
   ->join('tm_kelas_rombel','tm_kelas_rombel_walas.rombel_id=tm_kelas_rombel.id','right')
   ->join('tm_kelas_level','tm_kelas_rombel.level_kelas_id=tm_kelas_level.id','right')
   ->join('sekolah','tm_kelas_level.sekolah_id=sekolah.id','right')
   ->where('m_siswa_kelas.id', $id)
   ->get()
   ->getRow();

}

public function InfoRombelWalas($id)
{
   return $this->db->table('tm_kelas_rombel_walas')
   ->select('
   tm_kelas_rombel_walas.id as rombel_id,
   periode.nm_periode,
   tm_kelas_rombel.rombel,
   tm_kelas_level.level_kelas,
   sekolah.nm_sekolah,
   sekolah.kepsek,
   m_guru.nm_guru,')
   ->join('periode','tm_kelas_rombel_walas.periode_id=periode.id','right')
   ->join('m_guru','tm_kelas_rombel_walas.guru_id=m_guru.id','right')
   ->join('tm_kelas_rombel','tm_kelas_rombel_walas.rombel_id=tm_kelas_rombel.id','right')
   ->join('tm_kelas_level','tm_kelas_rombel.level_kelas_id=tm_kelas_level.id','right')
   ->join('sekolah','tm_kelas_level.sekolah_id=sekolah.id','right')
   ->where('tm_kelas_rombel_walas.id', $id)
   ->get()
   ->getRow();

}

}
