        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $kelas->kelas_nama; ?> - Mapel <?= $kelas->mapel_nama; ?></h1>
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
                  <h6 class="m-0 font-weight-bold text-primary">Jawaban Siswa</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($siswa as $k) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $k->siswa_nama; ?></td>
                        <td>
                        	<?php 
                        	if($k->jk == 1) {
                        		echo "Laki - Laki";
                        	}else{
                        		echo "Perempuan";
                        	}?>
                        </td>
                        <td><a href="<?= site_url('pengajar/cek_jawaban_siswa/'.$k->mapel_kelas_id.'/'.$k->siswa_id);?>" class="btn btn-sm btn-primary">Cek</a></td>
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