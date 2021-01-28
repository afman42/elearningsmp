        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Pengumuman Siswa <?= $kelas->kelas_nama; ?> - <?= $kelas->mapel_nama; ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Pengumuman Siswa</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Pengumuman</h6>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <form action="<?= site_url('pengajar/update_pengumuman_kelas/'.$kelas->mapel_kelas_id);?>" method="post" class="p-3">
                      <div class="form-group">
                        <label>Deskripsi :</label>
                        <textarea name="deskripsi" id="post-content"><?= $pengumuman->deskripsi;?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Tanggal Berakhir :</label>
                        <input type="date" name="tgl_berakhir" class="form-control" value="<?= $pengumuman->tgl_berakhir;?>">
                      </div>
                      <div class="form-group">
                        <a href="<?= site_url('pengajar/pengumuman_kelas/'.$kelas->mapel_kelas_id);?>" class="btn btn-sm btn-primary">Kembali</a>
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