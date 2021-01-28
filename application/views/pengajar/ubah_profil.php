        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Profil</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Ubah Profil</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Ubah Profil</h6>
                </div>
                <?php if(isset($_SESSION['success'])) alert($_SESSION['success'],'success');?>
                <?php
                if(isset($error)){
                  echo $error;
                }
                ?>
                <div class="row">
                  <div class="col-lg-6">
                    <form action="<?= site_url('pengajar/update_ubah_profil/'.$admin->is_pengajar);?>" method="post" class="p-3" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukan Email" required value="<?= $admin->email; ?>">
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukan Password" required>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label>Nip</label>
                        <input type="text" class="form-control" name="nip" placeholder="Masukan Nip" value="<?= $pengajar->nip; ?>">
                      </div>
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" value="<?= $pengajar->nama; ?>">
                      </div>
                      <div class="form-group">
                        <label>Jenis Kelamin</label><br>
                        <input type="radio" name="jk" value="1" <?php if($pengajar->jk == 1) { echo 'checked';} ?>>Laki - Laki
                        <input type="radio" name="jk" value="0" <?php if($pengajar->jk == 0) { echo 'checked';} ?>>Perempuan
                      </div>
                      <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukan Tempat Lahir" value="<?= $pengajar->tempat_lahir; ?>">
                      </div>
                      <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir" placeholder="Masukan Tanggal Lahir" value="<?= $pengajar->tgl_lahir; ?>">
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" placeholder="Masukan Alamat"><?= $pengajar->alamat; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-secondary">Kirim</button>
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-6">
                    <?php if ($pengajar->foto != null) {?>
                        <img src="<?= base_url().$pengajar->foto;?>" height="300" width="300">
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->