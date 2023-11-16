<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>
<div class="alert alert-light">
<li>Wali Kelas Bertanggung jawab penuh atas data siswa untuk kelas ini.</li>
<!-- <li>Data siswa yang telah dicatat pada kelas ini akan digunakan untuk kepentingan akademik.</li> -->
</div>

<div class="card shadow-sm p-0">
    <div class="card-body">
        <div class="row">
                <div class="col-lg-7">
                    <h5 class="card-title fw-semibold"><i class="ti ti-info-circle"></i> Informasi Kelas</h5>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-light">
                                <?php
                                if (!empty($rombel_aktif)) {
                                ?>
                                <table class="table table-sm" style="text-transform: uppercase;font-size:12px">
                                <tr>
                                <td>TP</td>
                                <td>:</td>
                                <td><?=$rombel_aktif['nm_periode']?></td>
                                </tr>
                                <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td><?=$rombel_aktif['level_kelas']?> - <?=$rombel_aktif['rombel']?></td>
                                </tr>
                                <tr>
                                <td>Sekolah</td>
                                <td>:</td>
                                <td><?=$rombel_aktif['nm_sekolah']?> (<?=$rombel_aktif['kepsek']?>)</td>
                                </tr>
                                </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card shadow-sm">
                                <div class="card-header bg-success p-1 text-center text-white">
                                    <h1><i class="ti ti-users text-white"></i></h1>
                                    Jumlah siswa melanggar
                                    <div>
                                        <strong><?php if (!empty($siswa_melanggar)) {echo $siswa_melanggar;}else{echo "Tidak ada siswa yg melanggar";}?></strong>
                                    </div>
                                </div>
                                <div class="card-body p-1">
                                <div class="d-grid gap-2">
                                <a class="btn btn-dark btn-sm" href="<?=base_url('report/pelanggaran/kelas/'.$rombel_aktif['kelas_aktif_id'].'')?>" target="_blank"> <i class="ti ti-printer"></i> Print Pelanggaran</a>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-grid gap-2">
                            <button onclick="TambahSiswaRombel(<?=!empty($rombel_aktif['kelas_aktif_id'])?$rombel_aktif['kelas_aktif_id']:null?>)" class="btn btn-primary btn-sm btn-block"><i class="ti ti-circle-plus"></i> Tambah Siswa</button>
                            <button class="btn btn-dark btn-sm mb-2"> <i class="ti ti-printer"></i> Print Siswa</button>
                            </div> 
                        </div>
                    </div>
                </div>     
            </div> 
        </div> 
        </div> 



<div class="card"><div class="card-body" id="tabel-siswa-rombel"></div></div>

<div class="modalview"></div>
<script>
    $(document).ready(function () {
        table_siswa_rombel(<?=!empty($rombel_aktif['kelas_aktif_id'])?$rombel_aktif['kelas_aktif_id']:null?>);
    });
    function TambahSiswaRombel(rombel_kelas_id) {
        $.ajax({
            url: "<?=base_url('teacher/student/add')?>",
            data: {rombel_id:rombel_kelas_id},
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.view);
                $('#modal-tambah-siswa').modal('show')
            }
        });
      }

      function table_siswa_rombel(rombel_id) {
        $.ajax({
            url: "<?=base_url('teacher/student/rombel')?>",
            data: {rombel_id:rombel_id},
            dataType: "json",
            success: function (response) {
               $('#tabel-siswa-rombel').html(response.view) 
            }
        });
        
      }



</script>

<?= $this->endSection() ?>