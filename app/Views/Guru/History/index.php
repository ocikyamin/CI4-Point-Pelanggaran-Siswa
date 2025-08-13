<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>
<div class="alert bg-primary text-white shadow-sm p-2 mt-3">
<b><i class="ti ti-info-circle"></i></b>
Berikut riwayat rekam pelanggaran Santri yang telah bapak/ibu lakukan
</div>
<div class="table-responsive">
<table class="table table-sm table-hover mid" id="tabel-history">
    <thead>
        <tr>
            <th class="text-center" width="1">No.</th>
            <th><i class="ti ti-user"></i> Siswa</th>
            <th>Tgl</th>
            <th>Pelanggaran</th>
            <th>Status</th>
            <!-- <th>Ket</th> -->
            <!-- <th class="text-center"><i class="ti ti-settings"></i></th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($history as $d) {?>
        <tr>
            <td class="text-center"><?=$i++?>.</td>
            <td>
              <div><b><?=$d['nama_siswa']?></b></div>
              
            <a href="#" class="badge rounded-pill text-bg-primary" onclick="LihatInfo(<?=$d['id']?>)"><i class="ti ti-folders"></i> Info Detail</a>
            <a href="#" onclick="EditPelanggaran(<?=$d['id']?>)" class="badge rounded-pill text-bg-dark"><i class="ti ti-edit"></i></a>
            <a href="#" onclick="HapusPelanggaran(<?=$d['id']?>)" class="badge rounded-pill text-bg-dark"><i class="ti ti-trash"></i></a>
          </td>
            <td><?=date('d/m/Y', strtotime($d['tgl_kejadian']))?></td>
            <td><?=$d['jenis']?> (<?=$d['poin']?>) </td>
            <td><?=$d['status_tindak_lanjut']?></td>
            <!-- <td><?=$d['keterangan']?></td> -->
            <!-- <td class="text-center">
             
                <button onclick="DetailPelanggaran(<?=$d['id']?>)" class="btn btn-dark btn-sm"><i class="ti ti-layers-subtract"></i></button>
            </td> -->
        </tr>
        <?php } ?>

    </tbody>
</table>
</div>
<!-- 
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Riwayat</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

..


  </div>
  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
  <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
</div>
 -->



<div class="modaleditpelanggaran"></div>
<script>
        $(document).ready(function () {
            $('#tabel-history').DataTable();
        });
    function HapusPelanggaran(id) {
            Swal.fire({
            title: 'Apakah Yakin?',
            text: "Tindakan ini akan menghapus data pelanggaran",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?=base_url('teacher/history/delete')?>",
                    data: {id:id},
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            location.reload();
                        }
                    }
                });
            }
            })
    }
</script>




<script>
    function EditPelanggaran(id) {
       $.ajax({
        type: "post",
        url: "<?=base_url('teacher/student/pelanggaran/edit')?>",
        data: {id:id},
        dataType: "json",
        success: function (response) {
            $('.modaleditpelanggaran').html(response.view)
            $('#modal-entry-pelanggaran').modal('show')
        }
       });

    }
</script>


<div class="viewinfo"></div>
<script>
    function LihatInfo(id) {
        $.ajax({
            url: "<?=base_url('teacher/student/pelanggaran/info')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.viewinfo').html(response.view).show()
                $('#modal-info').modal('show')

            }
        });   
    }

</script> 
<?= $this->endSection() ?>