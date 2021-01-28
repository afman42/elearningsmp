        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cek Pengumuman - <?= $pengumuman->mapel_nama; ?></h1>
            <ol class="breadcrumb">
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><?= $pengumuman->pengajar_nama; ?> - <?= $pengumuman->tgl_dibuat;?></h6>
                </div>
                <div class="table-responsive p-3">
                  <div class="mt-3">
                    <?= htmlspecialchars_decode($pengumuman->deskripsi); ?>
                  </div>
                  <div class="mt-3">
                    Tanggal Berakhir : <?= $pengumuman->tgl_berakhir;?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->