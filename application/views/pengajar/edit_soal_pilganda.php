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
                    <form action="<?= site_url('pengajar/update_soal_pilganda/'.$soal->id);?>" method="post" class="p-3" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Pertanyaan</label>
                        <textarea name="pertanyaan" class="form-control" placeholder="Masukan Pertanyaan" required><?= $soal->pertanyaan;?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Pilihan A</label>
                        <textarea name="pil_a" class="form-control" placeholder="Masukan Pilihan A" required><?= $soal->pil_a;?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Pilihan B</label>
                        <textarea name="pil_b" class="form-control" placeholder="Masukan Pilihan B" required><?= $soal->pil_b;?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Pilihan C</label>
                        <textarea name="pil_c" class="form-control" placeholder="Masukan Pilihan C" required><?= $soal->pil_c;?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Pilihan D</label>
                        <textarea name="pil_d" class="form-control" placeholder="Masukan Pilihan D" required><?= $soal->pil_d;?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Pilihan Jawaban</label>
                        <select name="kunci" class="form-control" required>
                            <?= pilihan_jawaban($soal->kunci);?>
                        </select>
                      </div>
                      <div class="form-group">
                        <a href="<?= site_url('pengajar/ujian_kelas/'.$kelas->id);?>" class="btn btn-sm btn-primary">Kembali</a>
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