<?php
use App\Models\JabatanModel;

function Penerusan($id){
    
    $jabM = new JabatanModel();
    return $jabM->select('jabatan')->where('id',$id)->get()->getRow();
}

