        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">File Materi - <?= $kelas->kelas_nama; ?> - Mapel <?= $kelas->mapel_nama; ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $kelas->kelas_nama; ?> - Mapel <?= $kelas->mapel_nama; ?></li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">File Kelas <a href="<?= site_url('pengajar/tambah_file_materi_kelas/'.$kelas->mapel_idd.'/'.$kelas->kelas_idd); ?>" class="btn btn-sm btn-primary">Tambah File</a></h6>
                </div>
                <?php if(isset($_SESSION['success'])) alert($_SESSION['success'],'success');?>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Nama File</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($file as $k) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= substr($k->file, 13); ?></td>
                        <td>
                        	<a href="<?= site_url('pengajar/download_file_materi_kelas/'.$k->id);?>" class="btn btn-sm btn-primary">Download</a>
                        	<a href="<?= site_url('pengajar/hapus_file_materi_kelas/'.$k->id);?>" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
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