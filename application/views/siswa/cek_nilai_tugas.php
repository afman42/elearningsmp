        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cek Nilai Tugas <?= $mapel->mapel_nama; ?> <a href="<?= site_url('siswa/nilai_tugas');?>" class="btn btn-sm btn-primary">Kembali</a></h1>
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

                        foreach ($cek_nilai as $k):
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
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      $jum = 0;
                      foreach ($cek_nilai_essay as $e) {
                      $juma = $jum + $e->nilai_essay_nilai;
                      ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $e->pertanyaan; ?></td>
                        </tr>
                      <?php } ?>
                      <tr>
                          <td>Nilai</td>
                          <td><?php if(isset($juma)) {echo $juma;} else { echo "Kosong"; } ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->