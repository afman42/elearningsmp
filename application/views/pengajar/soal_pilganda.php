        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelas <?= $kelas->kelas_nama; ?> - <?= $kelas->mapel_nama; ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Kelas</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Soal <?= $ujian->judul; ?>
                  <a href="<?= site_url('pengajar/tambah_soal_pilganda/'.$ujian->id); ?>" class="btn btn-sm btn-primary">Tambah</a></h6>
                </div>
                <?php if(isset($_SESSION['success'])) alert($_SESSION['success'],'success');?>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Nama Soal</th>
                        <th>Jawaban</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($soal as $k) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $k->pertanyaan; ?></td>
                        <td><?= $k->kunci; ?></td>
                        <td><a href="<?= site_url('pengajar/edit_soal_pilganda/'.$k->soal_id);?>" class="btn btn-sm btn-danger">Edit</a> <a href="<?= site_url('pengajar/hapus_soal_pilganda/'.$k->soal_id);?>" class="btn btn-sm btn-warning">Hapus</a></td>
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