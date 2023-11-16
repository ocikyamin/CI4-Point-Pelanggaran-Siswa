<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasLevelModel extends Model
{
    protected $table            = 'tm_kelas_level';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    public function LevelBySekolahId($id)
    {
        return $this->db->table('tm_kelas_level')->where('sekolah_id', $id)->get()->getResultArray();
    }

}
