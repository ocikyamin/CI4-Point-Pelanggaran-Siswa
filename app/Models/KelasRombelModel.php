<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasRombelModel extends Model
{
    protected $table            = 'tm_kelas_rombel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];


    public function RombelByLevelId($id, $periode)
    {
        return $this->db->table('tm_kelas_rombel')
        ->select('tm_kelas_rombel.id,tm_kelas_rombel.rombel')
        ->where('tm_kelas_rombel.periode_id', $periode)
        ->where('tm_kelas_rombel.level_kelas_id', $id)
        ->get()->getResultArray();
    }
    public function RombelBySekolahPeriodeId($sekolah=null, $periode=null)
    {
        return $this->db->table('tm_kelas_rombel')
        ->select('
        tm_kelas_rombel.id,
        tm_kelas_level.level_kelas,
        tm_kelas_rombel.rombel
        ')
        ->join('periode','tm_kelas_rombel.periode_id=periode.id')
        ->join('tm_kelas_level','tm_kelas_rombel.level_kelas_id=tm_kelas_level.id')
        ->where('tm_kelas_rombel.periode_id', $periode)
        ->where('tm_kelas_level.sekolah_id', $sekolah)
        ->get()->getResultArray();
    }


    public function InfoRombel($id)
    {
        return $this->db->table('tm_kelas_rombel')
        ->select('
        tm_kelas_rombel.id,
        periode.id as periode_id,
        periode.nm_periode,
        semester.id as semester_id,
        semester.semester,
        sekolah.id as sekolah_id,
        sekolah.nm_sekolah,
        sekolah.kepsek,
        tm_kelas_level.level_kelas,
        tm_kelas_rombel.rombel,
        m_guru.nuptk,
        m_guru.nm_guru as walas
        ')
        ->join('periode','tm_kelas_rombel.periode_id=periode.id')
        ->join('semester','semester.periode_id=semester.id', 'left')
        ->join('tm_kelas_level','tm_kelas_rombel.level_kelas_id=tm_kelas_level.id')
        ->join('sekolah','tm_kelas_level.sekolah_id=sekolah.id')
        ->join('m_guru','tm_kelas_rombel.guru_id=m_guru.id')
        ->where('tm_kelas_rombel.id', $id)
        ->get()->getRow();
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

->join('tm_kelas_rombel','m_siswa_kelas.rombel_id=tm_kelas_rombel.id','right')

->join('periode','tm_kelas_rombel.periode_id=periode.id','right')
->join('m_guru','tm_kelas_rombel.guru_id=m_guru.id','right')
->join('tm_kelas_level','tm_kelas_rombel.level_kelas_id=tm_kelas_level.id','right')
->join('sekolah','tm_kelas_level.sekolah_id=sekolah.id','right')
->where('m_siswa_kelas.id', $id)
->get()
->getRow();

}

  

}
