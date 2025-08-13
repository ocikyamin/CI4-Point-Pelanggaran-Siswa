<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table            = 'm_guru';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    public function GuruCode($kode)
    {
        return $this->db->table('m_guru')->where('nuptk', $kode)->get()->getRow();
    }


    public function HistoryWalas($guru_id)
    {
        return $this->db->table('tm_kelas_rombel')
        ->select('
        sekolah.nm_sekolah,
        sekolah.kepsek,
        periode.nm_periode,
        periode.status_periode,
        tm_kelas_level.level_kelas,
        tm_kelas_rombel.rombel,
        tm_kelas_rombel.id as kelas_aktif_id,
        ')
        ->join('periode','tm_kelas_rombel.periode_id=periode.id','right')
        ->join('tm_kelas_level','tm_kelas_rombel.level_kelas_id=tm_kelas_level.id', 'right')
        ->join('sekolah','tm_kelas_level.sekolah_id=sekolah.id','right')
        ->where('tm_kelas_rombel.guru_id', $guru_id)->get()->getResultArray();
    }

    public function RombelWalasAktif($guru_id)
    {
        return $this->db->table('tm_kelas_rombel')
        ->select('
        sekolah.nm_sekolah,
        sekolah.kepsek,
        periode.nm_periode,
        periode.status_periode,
        tm_kelas_level.level_kelas,
        tm_kelas_rombel.rombel,
        tm_kelas_rombel.id as kelas_aktif_id
        ')
        ->join('periode','tm_kelas_rombel.periode_id=periode.id','right')
        ->join('tm_kelas_level','tm_kelas_rombel.level_kelas_id=tm_kelas_level.id', 'right')
        ->join('sekolah','tm_kelas_level.sekolah_id=sekolah.id','right')
        ->where('tm_kelas_rombel.guru_id', $guru_id)
        // ->where('tm_kelas_rombel.status_walas', 1)
        ->get()->getRowArray();
    }




}
