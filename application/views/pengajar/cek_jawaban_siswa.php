        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cek Nilai Tugas Siswa<?= $siswa->nama; ?></h1>
            <ol class="breadcrumb">
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pilihan Ganda</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Soal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;

                        foreach ($nilai_pilganda as $k):
                        $jumlah = 0 + $k->persentase;
                      ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $k->pertanyaan; ?></td>
                        </tr>
                      <?php endforeach ?>
                      <tr>
                          <td>Nilai</td>
                          <td><?php if (isset($jumlah)) {
                            echo $jumlah;
                          } else {
                            echo "Kosong";
                          } ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Essay</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Jawaban</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      $jum = 0;
                      foreach ($nilai_essay as $e) {
                      ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $e->pertanyaan; ?></td>
                          <td><?= $e->jawaban; ?></td>
                        </tr>
                      <?php } ?>
                      <tr>
                          <td colspan="2">Nilai</td>
                          <td>
                            <?php if ($hitung_essay != null): ?>
                              <?= $hitung_essay->nilai;?>
                            <?php else: ?>
                              <?= 'Kosong'; ?>
                            <?php endif ?>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="row mt-4">
                    <form class="form-inline" method="post" action="<?= site_url('pengajar/nambah_nilai_essay/');?>">
                      <input type="hidden" name="siswa_id" value="<?= $this->uri->segment(4);?>">
                      <input type="hidden" name="mapel_kelas_id" value="<?= $this->uri->segment(3);?>">
                      <div class="form-group mx-sm-3 mb-2">
                        <label for="Nilai" class="sr-only">Nilai</label>
                        <input type="number" name="nilai" class="form-control" placeholder="Masukan Nilai Essay">
                      </div>
                      <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->