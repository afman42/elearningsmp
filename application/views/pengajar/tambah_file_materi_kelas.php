        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">File Siswa <?= $kelas->kelas_nama; ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">File Siswa</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tambah File doc/docx/pptx/ppt/pdf</h6>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <?php if (isset($error)): ?>
                      <?= $error; ?>
                    <?php endif ?>
                    <form action="<?= site_url('pengajar/insert_file_materi/'.$kelas->mapel_idd.'/'.$kelas->kelas_idd);?>" method="post" class="p-3" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>File :</label>
                        <input type="file" name="file" class="form-control">
                      </div>
                      <div class="form-group">
                        <a href="<?= site_url('pengajar/file_materi_kelas/'.$kelas->mapel_idd);?>" class="btn btn-sm btn-primary">Kembali</a>
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