<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasMengajarModel extends Model
{
    protected $table            = 'kelas_mengajar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    public function ByGuru($guru_id)
    {
        return $this->db->table('kelas_mengajar')
        ->select('
            kelas_mengajar.id,
            kelas_mengajar.rombel_walas_id,
            
            semester.semester,
            mapel.mapel,
            tm_kelas_rombel.rombel,
            m_guru.nm_guru
            ')
            ->join('m_guru','kelas_mengajar.guru_id=m_guru.id')
            ->join('semester','kelas_mengajar.semester_id=semester.id')
            ->join('mapel','kelas_mengajar.mapel_id=mapel.id')

            ->join('tm_kelas_rombel_walas','kelas_mengajar.rombel_walas_id=tm_kelas_rombel_walas.id')
            ->join('tm_kelas_rombel','tm_kelas_rombel_walas.rombel_id=tm_kelas_rombel.id')
            ->where('kelas_mengajar.guru_id', $guru_id)
            ->get()
            ->getResultArray();
    }

    public function InfoKelasMengajar($id)
    {
        return $this->db->table('kelas_mengajar')
        ->select('
        kelas_mengajar.id,
        tm_kelas_rombel_walas.id as rombel_walas_id,
        mapel.mapel,
        periode.nm_periode,
        semester.semester,
        tm_kelas_rombel.rombel,
        tm_kelas_level.level_kelas,
        sekolah.nm_sekolah,
        sekolah.kepsek,
        m_guru.nm_guru
        ')
        ->join('m_guru','kelas_mengajar.guru_id=m_guru.id','right')
        ->join('semester','kelas_mengajar.semester_id=semester.id','right')
        ->join('mapel','kelas_mengajar.mapel_id=mapel.id','right')

        ->join('tm_kelas_rombel_walas','kelas_mengajar.rombel_walas_id=tm_kelas_rombel_walas.id','right')

        ->join('periode','tm_kelas_rombel_walas.periode_id=periode.id','right')
        // ->join('m_guru ','tm_kelas_rombel_walas.guru_id=m_guru.id','right')
        ->join('tm_kelas_rombel','tm_kelas_rombel_walas.rombel_id=tm_kelas_rombel.id','right')
        ->join('tm_kelas_level','tm_kelas_rombel.level_kelas_id=tm_kelas_level.id','right')
        ->join('sekolah','tm_kelas_level.sekolah_id=sekolah.id','right')
        ->where('kelas_mengajar.id', $id)
        ->get()
        ->getRow();
    }

}
