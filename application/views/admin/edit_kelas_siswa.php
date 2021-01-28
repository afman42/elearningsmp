        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelas Siswa</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Kelas Siswa</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Kelas Siswa</h6>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <form action="<?= site_url('admin/update_kelas_siswa/'.$kelas_siswa->id);?>" method="post" class="p-3">
                      <div class="form-group">
                          <label>Pilihan Kelas</label>

                        <select name="kelas_id" class="form-control" required>
                          <option value="">-- Pilihan Kelas --</option>
                          <?php foreach ($kelas as $k) {?>
                            <option value="<?= $k->id; ?>" <?php if($kelas_siswa->kelas_id == $k->id){ echo 'selected';} ?>><?= $k->nama;?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Pilihan Siswa</label>
                        <select name="siswa_id" class="form-control" required>
                        <option value="">-- Pilihan Siswa --</option>
                          <?php foreach ($siswa as $k) {?>
                            <option value="<?= $k->id; ?>" <?php if($kelas_siswa->siswa_id == $k->id){ echo 'selected';} ?>><?= $k->nama;?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <a href="<?= site_url('admin/kelas_siswa');?>" class="btn btn-sm btn-primary">Kembali</a>
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