<div class="table-responsive mt-3">
    <p>
    <h6><i class="ti ti-list"></i> Pelanggaran Terbaru</h6>
    </p>
<table class="table table-sm" style="font-size:12px">
        <thead>
        <tr>
        <th class="text-center">No.</th>
        <th>Tgl. Kejadian</th>
        <th>Petugas</th>
        <th>Siswa</th>
        <th class="text-center">Poin</th>
        <th>Jenis</th>
        <th>Status</th>
        <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
      
        foreach ($news as $d) {?>
        <tr>
        <td class="text-center"><?=$i++?>.</td>
        <td><?=date('d/m/Y', strtotime($d['tgl_kejadian']))?></td>
        <td><?=$d['nm_guru']?></td>
        <td><a href="#" onclick="LihatInfo(<?=$d['id']?>)"><b><?=$d['nama_siswa']?></b></a></td>
        <td class="text-center"><?=$d['poin']?></td>
        <td><?=$d['jenis']?></td>
        <td><?=$d['status_tindak_lanjut']?>
        <?php
        if ($d['teruskan_ke'] !=NULL) {
            echo $d['teruskan_ke'];
        }
        ?>
    
    </td>
        <td>
        <?php
        if ($d['keterangan'] !=NULL) {
        ?>
        <li><?=$d['keterangan']?></li>
        <?php
        }

        ?>
        <?php
        if ($d['keterangan_final'] !=NULL) {
        ?>
        <li><?=$d['keterangan_final']?></li>
        <?php
        }
        ?>
        </td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
</div>
<div class="viewinfo"></div>
<script>
    function LihatInfo(id) {
        $.ajax({
            url: "<?=base_url('admin/pelanggaran/info')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.viewinfo').html(response.view).show()
                $('#modal-info').modal('show')

            }
        });
        
    }
</script>