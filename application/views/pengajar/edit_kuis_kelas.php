        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kuis Kelas <?= $kelas->kelas_nama; ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Kuis Siswa</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Kuis</h6>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <form action="<?= site_url('pengajar/update_kuis_siswa/'.$kelas->id);?>" method="post" class="p-3">
                      <div class="form-group">
                        <label>Nama Kuis</label>
                        <input type="text" name="nama_ujian" class="form-control" placeholder="Masukan Nama Kuis" value="<?= $ujian->nama_ujian; ?>">
                      </div>
                      <div class="form-group">
                        <label>Jumlah Soal</label>
                        <input type="number" name="jsoal" class="form-control" placeholder="Masukan Jumlah Soal" value="<?= $ujian->jsoal; ?>" required>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-lg-6">
                            <label>Jam Mulai</label>
                            <input type="datetime-local" name="jam_mulai" class="form-control" placeholder="Masukan Jam Mulai" value="<?= date('Y-m-d\TH:i', strtotime($ujian->jam_mulai)); ?>" required>
                          </div>
                          <div class="col-lg-6">
                            <label>Jam Selesai</label>
                            <input type="datetime-local" name="jam_selesai" class="form-control" placeholder="Masukan Jam Selesai" value="<?= date('Y-m-d\TH:i', strtotime($ujian->jam_selesai)); ?>"  required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Tanggal Berakhir</label>
                        <input type="datetime-local" name="tgl_expired" class="form-control" placeholder="Masukan Tanggal Berakhir" value="<?= date('Y-m-d\TH:i', strtotime($ujian->tgl_expired)); ?>" required>
                      </div>
                      <div class="form-group">
                        <a href="<?= site_url('pengajar/kuis_kelas/'.$kelas->id);?>" class="btn btn-sm btn-primary">Kembali</a>
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