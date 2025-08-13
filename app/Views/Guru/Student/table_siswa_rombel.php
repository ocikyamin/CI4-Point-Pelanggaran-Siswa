
<div class="table-responsive">
<table class="table table-sm table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>NISN</th>
            <th>NAMA</th>
            <th>JK</th>
            <th>POINT</th>
            <th>
                <i class="ti ti-cog"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($siswa as $s):?>
        <tr>
            <td><?=$i++?>.</td>
            <td><?=$s['nisn']?></td>
            <td><?=$s['nama_siswa']?></td>
            <td><?=$s['jk']?></td>
            <td>
            <span class="badge bg-primary">-</span>
            </td>
            <td>
            <div class="dropdown">
            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ti ti-list"></i>
            </button>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?=base_url('teacher/student/pelanggaran/siswa/'.$s['siswa_rombel_id'].'')?>"><i class="ti ti-list-search"></i> Lihat Pelanggaran</a></li>
            <li><a class="dropdown-item" href="#" onclick="EditSiswa(<?=$rombel_id?>, <?=$s['id']?>)"><i class="ti ti-edit"></i> Ubah Data</a></li>
            <li><a class="dropdown-item" href="<?=base_url('report/pelanggaran/siswa/'.$s['siswa_rombel_id'].'')?>" target="_blank"><i class="ti ti-printer"></i>Print</a></li>
            </ul>
            </div>
        </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<div class="modalview"></div>
<script>
    function EditSiswa(rombel_id,siswa_id) { 
        $.ajax({
            url: "<?=base_url('teacher/student/edit')?>",
            data: {
                rombel_id: rombel_id,
                siswa_id : siswa_id
            },
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.view);
                $('#modal-edit-siswa').modal('show')
            }
        });

     }
</script>