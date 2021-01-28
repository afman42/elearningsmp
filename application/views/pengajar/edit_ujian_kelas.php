        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tugas Kelas <?= $kelas->kelas_nama; ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tugas Siswa</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Tugas</h6>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <form action="<?= site_url('pengajar/update_tugas_siswa/'.$ujian->id);?>" method="post" class="p-3">
                      <div class="form-group">
                        <label>Nama Tugas</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukan Judul" required value="<?= $ujian->judul; ?>">
                      </div>
                      <div class="form-group">
                        <label>Waktu Pengerjaan</label>
                        <input type="number" name="waktu_pengerjaan" class="form-control" placeholder="Masukan Waktu Pengerjaan" required value="<?= $ujian->waktu_pengerjaan; ?>">
                      </div>
                      <div class="form-group">
                        <label>Terbit</label><br>
                        <input type="radio" name="terbit" value="Y" <?php if($ujian->terbit == 'Y'){echo 'checked';} ?> required>Ya
                        <input type="radio" name="terbit" value="N" <?php if($ujian->terbit == 'N'){echo 'checked';} ?>>Tidak
                      </div>
                      <div class="form-group">
                        <a href="<?= site_url('pengajar/tugas_kelas/'.$kelas->id);?>" class="btn btn-sm btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-secondary">Kirim</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->