<?php
function PPSCon()
{
	return $db= \Config\Database::connect(); 
}

function JmlPoinSiswa($siswa_id =null)
{
    if ($siswa_id==null) {
        return 0;
    }
    return $builder = PPSCon()
    ->table('pelanggaran_siswa')
    ->selectSum('pelanggaran_item.poin')
    ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
    ->join('periode','pelanggaran_siswa.periode_langgar_id=periode.id')
    ->where('pelanggaran_siswa.siswa_kelas_id', $siswa_id)
    ->where('periode.status_periode', 1)
    ->get()
    ->getRow();


}