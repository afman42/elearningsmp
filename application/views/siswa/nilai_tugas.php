        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Nilai Tugas</h1>
            <ol class="breadcrumb">
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tugas</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Jadwal</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($nilai as $k) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $k->mapel_nama; ?></td>
                        <td><?= $k->hari; ?></td>
                        <td><?= $k->tgl_dibuat; ?></td>
                        <td><a href="<?= site_url('siswa/cek_nilai/'.$k->id_topik_tugas);?>" class="btn btn-sm btn-primary">Cek</a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->