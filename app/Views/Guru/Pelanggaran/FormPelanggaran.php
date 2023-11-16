<!-- Modal -->
<div class="modal fade" id="modal-entry-pelanggaran"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary shadow-sm">
        <h1 class="modal-title text-white fs-5"><i class="ti ti-pencil"></i> Catat Pelanggaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form-entry-pelanggaran">
        <?=csrf_field()?>
        <input type="hidden" name="periode_langgar_id" value="<?=PeriodeAktif()->id?>">
        <input type="hidden" name="user_created_id" value="<?=TeacherLogin()->id?>">
        <input type="hidden" name="siswa_kelas_id" value="<?=$siswa->siswa_kelas_id?>">
        
      <div class="modal-body">
       
          <div class="row mb-3">
            <div class="col-md-4">
              <img src="<?=base_url()?>public/assets/images/profile/user-1.jpg" class="img-fluid rounded-start" alt="siswa">
            </div>
          <div class="col-md-8">
            <ul class="list-group list-group-flush">
            <li class="list-group-item"><h5 class="card-title text-uppercase"><?=$siswa->nama_siswa?></h5></li>
            <li class="list-group-item"><span class="fst-italic opacity-50">NISN</span> <?=$siswa->nisn?></li>
            <li class="list-group-item"><span class="fst-italic opacity-50">Gender</span> <?=$siswa->jk?></li>
            <li class="list-group-item"><span class="fst-italic opacity-50">Rombel</span> <?=$siswa->rombel?></li>
            <li class="list-group-item"><span class="fst-italic opacity-50">Hp.Ortu</span> <?=$siswa->hp_ortu?></li>
            </ul>
              <!-- <a class="btn btn-light shadow-sm text-dark">
              Jumlah Poin <input type="text" class="form-control text-center text-bold" id="jml-poin" value="4">
              </a>
              <div class="alert alert-warning" id="info-tindakan"> 

              </div>-->

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
              <select class="form-select" name="pelanggaran_id" id="item-pelanggaran" disabled aria-label="Floating label select example">
              <option value="" selected> Daftar Pelanggaran</option></select>
              <label for="item-pelanggaran">Pilih Nama Pelanggaran</label>
              </div>

            <div class="form-floating mb-3">
            <textarea class="form-control" name="keterangan" placeholder="Catatan Tambahan / Keterangan" id="keterangan" style="height: 100px"></textarea>
            <label for="keterangan">Tindak Lanjut / Keterangan / Catatan Tambahan</label>
            </div>

            <div class="form-floating mb-3">
            <input type="date" name="tgl_kejadian" class="form-control" id="tgl_kejadian">
            <label for="tgl_kejadian">Tanggal Kejadian ? </label>
            </div>

            <!-- <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control" type="file" id="formFile">
            </div> -->

          </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan Pelanggaran</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>

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
    $.ajax({
      type: "post",
      url: "<?=base_url('teacher/student/pelanggaran/save')?>",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
       // If in-valid 
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

        }


        // Is Sukses 
        if (response.sukses) {
            $('#modal-entry-pelanggaran').modal('hide')
            Toastify({
            text: 'Data Pelanggaran Berasil disimpan'     
            }).showToast();

           
          // window.location= '<?=base_url('teacher')?>';
        }




        
      }
    });
  
    
  });
</script>