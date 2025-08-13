<?php

namespace App\Models\Jurnal;

use CodeIgniter\Model;

class AgendaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kelas_jurnal';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];
}
