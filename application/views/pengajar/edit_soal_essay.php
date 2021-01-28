        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Soal Siswa <?= $kelas->kelas_nama; ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Soal Siswa</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Soal</h6>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <?php if (isset($error)): ?>
                      <?= $error; ?>
                    <?php endif ?>
                    <form action="<?= site_url('pengajar/update_soal_essay/'.$soal->id);?>" method="post" class="p-3" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Pertanyaan</label>
                        <textarea name="pertanyaan" class="form-control" placeholder="Masukan Pertanyaan" required><?= $soal->pertanyaan;?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                      </div>
                      <div class="form-group">
                        <a href="<?= site_url('pengajar/soal_essay/'.$ujian->id);?>" class="btn btn-sm btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-secondary">Kirim</button>
                      </div>
                    </form>
                  </div>
                  <?php if ($soal->gambar != null): ?>                    
                    <div class="col-lg-6">
                      <img src="<?= base_url().$soal->gambar; ?>" height="300" width="300">
                    </div>
                  <?php endif ?>
                </div>
              </div>
            </div>
            
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->