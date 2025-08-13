<?php

namespace App\Models\Jurnal;

use CodeIgniter\Model;

class KehadiranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kelas_kehadiran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

}
