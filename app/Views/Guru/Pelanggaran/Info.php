<!-- Modal -->
<div class="modal fade" id="modal-info" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Informasi Detail Pelanggaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- IDENTITAS SISWA  -->
         <div class="row">
            <div class="col-lg-6">
                <table class="table-sm table-striped">
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td><?=$d->nisn?></td>
                    </tr>
                    <tr>
                        <td>NAMA</td>
                        <td>:</td>
                        <td><?=$d->nama_siswa?></td>
                    </tr>
                    <tr>
                        <td>OLEH</td>
                        <td>:</td>
                        <td><?=$d->nm_guru?></td>
                    </tr>
                </table>
            </div>
         </div>
        <!-- IDENTITAS SISWA  -->
         <div class="alert bg-light shadow mt-3 mb-3">
            <li>JENIS PELANGGARAN : <?=$d->jenis?></li>
            <li>NAMA PELANGGARAN : <?=$d->nama_pelanggaran?></li>
            <li>POIN : <?=$d->poin?></li>
         </div>
         <table class="table-sm table-striped mb-3">
                    <tr>
                        <td>TANGGAL KEJADIAN</td>
                        <td>:</td>
                        <td><?=$d->tgl_kejadian?></td>
                    </tr>
                    <tr>
                        <td>TANGGAL TINDAK LANJUT</td>
                        <td>:</td>
                        <td><?=$d->tgl_penyelesaian?></td>
                    </tr>
                </table>
                <div>
                  KETERANGAN 
                  <p>
                  <?=$d->keterangan?>
                  </p>
                </div>
                <div>
                    LAMPIRAN
                    <div>
                      <?php
                      if ($d->lampiran==NULL) {
                        echo "Tidak ada lampiran";
                      }else{
                        ?>
                      <img src="<?=base_url('uploads/lampiran/'.$d->lampiran)?>" alt="lampiran" class="img-fluid">
                        <?php
                      }
                      ?>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
