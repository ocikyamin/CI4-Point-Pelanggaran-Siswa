
<!-- Modal -->
<div class="modal fade" id="modal-entry-pelanggaran"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header shadow-sm">
        <h1 class="modal-title fs-5">Rekam Pelanggaran</h1>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form-entry-pelanggaran" enctype="multipart/form-data">
        <?=csrf_field()?>
        <input type="hidden" name="periode_langgar_id" value="<?=PeriodeAktif()->id?>">
        <input type="hidden" name="semester_langgar_id" value="<?=SemesterAktif()->id?>">
        <input type="hidden" name="user_created_id" value="<?=TeacherLogin()->id?>">
        <input type="hidden" name="siswa_kelas_id" value="<?=$siswa->siswa_kelas_id?>">
        
      <div class="modal-body">
       
          <div class="row mb-3">
            <div class="col-md-4 text-center">
            <img src="<?=base_url()?>public/assets/images/profile/<?=$siswa->foto?>" alt="siswa" width="100" height="100" class="img-fluid img-thumbnail rounded-circle m-3">
            </div>
          <div class="col-md-8">
            <ul class="list-group list-group-flush">
            <li class="list-group-item"><h5 class="card-title text-uppercase text-primary"><?=$siswa->nama_siswa?> </h5></li>
            <li class="list-group-item"><span class="fst-italic opacity-50">NISN</span> <?=$siswa->nisn?></li>
            <li class="list-group-item"><span class="fst-italic opacity-50">Gender</span> <?=$siswa->jk?></li>
            <li class="list-group-item"><span class="fst-italic opacity-50">Kelas</span> <?=$siswa->rombel?></li>
            <li class="list-group-item"><span class="fst-italic opacity-50">Hp.Ortu</span> <?=$siswa->hp_ortu?></li> 
            </ul>
     
          </div>
          </div>

        <div class="row">
          <div class="col-lg-12">
          <div class="form-floating mb-3">
              <select class="form-select" name="jenis_pelanggaran" id="jenis-pelanggaran" aria-label="Floating label select example">
              <option value="" selected> Pilih Jenis Pelanggaran</option>
              <?php
              foreach ($jenis_pelanggaran as $p):?>
              <option value="<?=$p['id']?>"><?=$p['jenis']?></option>
              <?php endforeach; ?>
              </select>
              <label for="jenis-pelanggaran">Jenis Pelanggaran</label>
              </div>

              <div class="form-floating mb-3">
              <select class="form-select" name="pelanggaran_id" id="item-pelanggaran" disabled>
              <option value="" selected> Daftar Pelanggaran</option></select>
              <label for="item-pelanggaran">Pilih Nama Pelanggaran</label>
              </div>
            <div class="form-floating mb-3">
            <input type="date" name="tgl_kejadian" class="form-control" id="tgl_kejadian">
            <label for="tgl_kejadian">Tanggal Kejadian ? </label>
            </div>
            <div>

            <div class="mb-2"><label><i class="ti ti-info-circle"></i> Status Tindak Lanjut ?</label></div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="status_tindak_lanjut" id="tl-selesai" value="selesai">
    <label class="form-check-label" for="tl-selesai">Selesai</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="status_tindak_lanjut" id="tl-teruskan" value="diteruskan">
    <label class="form-check-label" for="tl-teruskan">Teruskan</label>
</div>

<!-- Jika Tindak Lanjut selesai -->
 <div class="mb-3 mt-3" id="selesai-section" style="display: none;">
    <div class="form-floating mb-3">
    <input type="date" name="tgl_penyelesaian" class="form-control" id="tgl_penyelesaian">
    <label for="tgl_penyelesaian">Tanggal Peyelesaian </label>
    </div>
<div class="form-floating" >
    <textarea class="form-control" name="keterangan" placeholder="Catatan Tambahan / Keterangan" id="keterangan" style="height: 100px"></textarea>
    <label for="keterangan">Tuliskan Tindak Lanjut yang dilakukan oleh guru</label>
</div>
</div>
<!-- Jika Tindak Lanjut selesai -->

<!-- Jika Tindak lanjut diteruskan -->
<div class="form-floating mb-3 mt-3" id="teruskan-section" style="display: none;">
    <select class="form-select" name="teruskan_ke" id="teruskan-ke">
      <option value="">Pilih Tujuan</option>
      <?php
      if (Jabatan()) {
        foreach (Jabatan() as $j) {
          ?>
<option value="<?=$j['id']?>"><?=$j['jabatan']?></option>

          <?php
        }
      }

      ?>
    </select>
    <label for="teruskan-ke">Teruskan Ke</label>
</div>
<!-- Jika Tindak lanjut diteruskan -->

            <div class="form-check form-switch mb-3 mt-3">
            <input class="form-check-input" type="checkbox" value="" role="switch" id="cbLampiran">
            <label class="form-check-label" for="cbLampiran">Lampiran / Bukti Melanggar ?</label>
            </div>

            <div class="lampiran mb-3" id="fileInputContainer" style="display: none;">
    <label for="fileLampiran" class="form-label">Gambar (jpg, jpeg, png)</label>
    <input class="form-control form-control-sm" id="fileLampiran" name="lampiran" type="file">
</div>
          </div>
        </div>
<hr>
        <div class="text-center mt-3 mb-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Buat</button>
      </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div> -->
     
      </form>
    </div>
  </div>
</div>
<script>

$(document).ready(function() {

  $('input[name="status_tindak_lanjut"]').change(function() {
            if ($(this).val() === 'selesai') {
                $('#selesai-section').show();
                $('#teruskan-section').hide();
            } else if ($(this).val() === 'diteruskan') {
                $('#teruskan-section').show();
                $('#selesai-section').hide();
            }
        });






$('#cbLampiran').change(function() {
if ($(this).is(':checked')) {
$('#fileInputContainer').show();
} else {
$('#fileInputContainer').hide();
}
});




});

  $('#jenis-pelanggaran').change(function (e) { 
    e.preventDefault();
    if ($(this).val() !== "") {
      $('#item-pelanggaran').prop('disabled', false);
      $.ajax({
        type: "post",
        url: "<?=base_url('master/item-pelanggaran')?>",
        data: {jenis_id:$(this).val()},
        dataType: "json",
        success: function (response) {
          if (response.item_pelanggaran) {
            $('#item-pelanggaran').html('<option value="" selected> Daftar Pelanggaran</option>'+response.item_pelanggaran)
          }else{
            $('#item-pelanggaran').html('<option value="" selected> Daftar Pelanggaran</option>')
          }
          
        }
      });

      
    }else{
      $('#item-pelanggaran').prop('disabled', true);
      $('#item-pelanggaran').html(`<option value="" selected> Daftar Pelanggaran</option>`);

    }

    
  });

  
  // let point_lama = parseInt($('#jml-poin').val());
  // $('#item-pelanggaran').change(function (e) { 
   
  //   $.ajax({
  //     type: "post",
  //     url: "<?=base_url('master/item-point')?>",
  //     data: {id:$(this).val()},
  //     dataType: "json",
  //     success: function (response) {
  //       // alert(response.point_item_pelanggaran)
  //       let tambah_point = parseInt(response.point_item_pelanggaran);
  //       let hasil_tambah = point_lama + tambah_point;
  //       $('#jml-poin').val(hasil_tambah);

  //       if ($('#jml-poin').val() > 100) {
  //         $('#info-tindakan').html('Dikeluarkan')
  //       }else{
  //         $('#info-tindakan').html('')
  //       }


  //     }
  //   });
  // });

  $('#form-entry-pelanggaran').submit(function (e) { 
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "post",
            url: "<?=base_url('teacher/student/pelanggaran/save')?>",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.error) {
                    if (response.error.jenis_pelanggaran) {
                        $('#jenis-pelanggaran').addClass('is-invalid');
                        Toastify({
                            text: response.error.jenis_pelanggaran      
                        }).showToast();
                    }

                    if (response.error.pelanggaran_id) {
                        $('#item-pelanggaran').addClass('is-invalid');
                        Toastify({
                            text: response.error.pelanggaran_id      
                        }).showToast();
                    }

                    if (response.error.tgl_kejadian) {
                        $('#tgl_kejadian').addClass('is-invalid');
                        Toastify({
                            text: response.error.tgl_kejadian      
                        }).showToast();
                    }
                    if (response.error.status_tindak_lanjut) {
                        // $('#tgl_kejadian').addClass('is-invalid');
                        Toastify({
                            text: response.error.status_tindak_lanjut      
                        }).showToast();
                    }

                    if (response.error.lampiran) {
                        $('#fileLampiran').addClass('is-invalid');
                        Toastify({
                            text: response.error.lampiran
                        }).showToast();
                    }
                }

                if (response.success) {
                    $('#modal-entry-pelanggaran').modal('hide');
                    Toastify({
                        text: 'Data Pelanggaran Berhasil disimpan'     
                    }).showToast();
                    // Optionally, reload the page or perform any other necessary actions
                    // location.reload();
                }
            }
        });
    });
</script>