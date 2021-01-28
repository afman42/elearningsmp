

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Beranda</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <a href="<?= site_url('siswa/tugas');?>">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Tugas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php foreach ($jumlah_tugas as $k): ?>
                            <?= $k->jumlah; ?>
                          <?php endforeach ?>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-primary"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
            </div>

        
            <!-- Invoice Example -->
            <div class="col-xl-12 col-lg-12 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Jadwal Pelajaran</h6>
                  <a href="<?= site_url('siswa/export_jadwal');?>" class="btn btn-sm btn-primary">Print</a>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Hari</th>
                        <th>Kelas</th>
                        <th>Pengajar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach ($jadwal as $k): ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $k->mapel_nama; ?></td>
                          <td><?= $k->hari; ?></td>
                          <td><?= $k->kelas_nama; ?></td>
                          <td><?= $k->nama_pengajar; ?></td>
                        </tr>  
                      <?php endforeach ?>
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
            <!-- Message From Customer-->
            <div class="col-xl-12 col-lg-12 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pengumuman</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Deskripsi</th>
                        <th>Kelas</th>
                        <th>Pengajar</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach ($pengumuman as $k): ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $k->deskripsi; ?></td>
                          <td><?= $k->kelas_nama; ?></td>
                          <td><?= $k->pengajar_nama; ?></td>
                          <td><a href="<?= site_url('siswa/cek_pengumuman/'.$k->pengumuman_id);?>" class="btn btn-primary btn-sm">Cek</a></td>
                        </tr>
                      <?php endforeach ?>
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->