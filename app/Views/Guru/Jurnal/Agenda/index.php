<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>
<table class="table-sm w-100" style="text-transform: uppercase;font-size:12px">
            <tr class="shadow-sm">
            <td>Bidang Studi</td>
            <td>:</td>
            <td><?=$kelas->mapel?></td>
            </tr>
            <tr class="shadow-sm">
            <td>Kelas</td>
            <td>:</td>
            <td><?=$kelas->level_kelas?> - <?=$kelas->rombel?></td>
            </tr>
            <tr class="shadow-sm">
            <td>Guru Pengampu</td>
            <td>:</td>
            <td><?=$kelas->nm_guru?></td>
            </tr>
            <tr class="shadow-sm">
            <td>Tahun Pelajaran / Semester</td>
            <td>:</td>
            <td><?=$kelas->nm_periode?> / <?=$kelas->semester?></td>
            </tr>
        </table>

    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"><i class="ti ti-table"></i> Rekap Presensi</button>
    </li>
    <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><i class="ti ti-checklist"></i> Jurnal Harian</button>
    </li>
    <!-- <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Notes</button>
    </li> -->
    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
    <div id="section-rekap"></div> 

    </div>

    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    <div class="mt-3 mb-3">
        <button onclick="BuatPertemuan(<?=$kelas->id?>)" class="btn btn-success btn-sm"><i class="ti ti-plus"></i> Buat Agenda</button>
        <a href="<?=base_url('teacher/jurnal/agenda/print/'.$kelas->id)?>" target="_balank" class="btn btn-success btn-sm"><i class="ti ti-printer"></i> Cetak Jurnal</a>
    </div>
    <div id="section-agenda"></div>      
</div>

    <!-- <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
    </div> -->
    <div class="viewmodalagenda"></div>
    <div id="presensiformrekap"></div>
<script>
    $(document).ready(function () {
        DaftarAgenda()
        RekapPresensi()
    });
    function DaftarAgenda() {
        $.ajax({
            url: "<?=base_url('teacher/jurnal/agenda/list')?>",
            data: {
                jadwal_id : <?=json_encode($kelas->id)?>,
                rombel_id : <?=json_encode($kelas->rombel_walas_id)?>,
            },
            dataType: "json",
            success: function (response) {
                $('#section-agenda').html(response.list)
            }
        });  
    }
    function RekapPresensi() {
        $.ajax({
            url: "<?=base_url('teacher/jurnal/presensi/rekap')?>",
            data: {
                jadwal_id : <?=json_encode($kelas->id)?>,
                rombel_id : <?=json_encode($kelas->rombel_walas_id)?>,
            },
            dataType: "json",
            success: function (response) {
                $('#section-rekap').html(response.rekap)
            }
        });  
    }

    function BuatPertemuan(id) {
        $.ajax({
            type: "post",
            url: "<?=base_url('teacher/jurnal/agenda/add')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.viewmodalagenda').html(response.add).show()
                $('#modal-agenda').modal('show')
            }
        });
        
    }
</script>

<!-- end daftar hadir  -->
<script>
         function KehadiranSiswa(id) {
        $.ajax({
            url: "<?=base_url('teacher/jurnal/presensi/list')?>",
            data: {
                id:id,
                rombel_id: <?=json_encode($kelas->rombel_walas_id)?>
            },
            dataType: "json",
            success: function (response) {
                $('#presensiformrekap').html(response.view)
                $('#modal-presensi').modal('show')
            }
        });
        
    }
</script>
<?= $this->endSection() ?>
