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
    protected $protectFields    = true;
    protected $allowedFields    = [];


    public function RombelByLevelId($id)
    {
        return $this->db->table('tm_kelas_rombel')
        ->select('tm_kelas_rombel.id,tm_kelas_rombel.rombel')
        ->where('tm_kelas_rombel.level_kelas_id', $id)
        ->get()->getResultArray();
    }

}
