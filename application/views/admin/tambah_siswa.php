        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Siswa</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Siswa</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tambah Akun Siswa</h6>
                </div>
                <?php if (isset($error)) { echo $error;}?>
                <div class="row">
                  <div class="col-lg-12">
                    <form action="<?= site_url('admin/insert_siswa');?>" method="post" class="p-3" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>NIS</label>
                        <input type="text" class="form-control" name="nis" placeholder="Masukan Nis" required>
                        <?php echo form_error('nis', '<span class="text-danger">', '</span>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required>
                      </div>
                      <div class="form-group">
                        <label>Jenis Kelamin</label><br>
                        <input type="radio" name="jk" value="1">Laki - Laki
                        <input type="radio" name="jk" value="0">Perempuan
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required placeholder="Masukan Alamat"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukan Tempat Lahir" required>
                      </div>
                      <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir" placeholder="Masukan Tanggal Lahir" required>
                      </div>
                      <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto" required>
                      </div>
                      <div class="form-group">
                        <label>Tahun Masuk</label>
                        <input type="text" class="form-control" name="tahun_masuk" placeholder="Masukan Tahun Masuk" required>
                      </div>
                      <div class="form-group">
                        <label>Agama</label>
                        <select name="agama" class="form-control" required>
                            <?php agama() ?>
                        </select>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukan Email" required>
                        <?php echo form_error('email', '<span class="text-danger">', '</span>'); ?>
                      </div>
                      <div class="form-group">
                        <a href="<?= site_url('admin/siswa');?>" class="btn btn-sm btn-primary">Kembali</a>
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