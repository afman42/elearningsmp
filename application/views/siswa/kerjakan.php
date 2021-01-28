        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ujian <?= $kerjakan->mapel_nama; ?></h1>
            <ol class="breadcrumb">
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="table-responsive p-3">
                <form method=POST action='<?= site_url('siswa/kerjakan_soal'); ?>' target='_blank'>
                  <input type=hidden name='waktu' value='<?= $kerjakan->waktu_pengerjaan; ?>'>
                  <input type=hidden name='id' value='<?= $kerjakan->id_ujian; ?>'>
                  <h4>Baca dengan seksama dan teliti sebelum mengerjakan Ujian / Quiz</h4>
                  <h4>1. Pastikan koneksi anda terjamin dan bagus, misalnya Warnet.<br>
                  2. Jika menggunakan Modem, pastikan menggunakan operator yang handal.<br>
                  3. Pilih browser yang support dengan Elearning yaitu Mozilla Firefox.<br>
                  4. Jika mati lampu hubungi Pengajar Mata Pelajaran terkait untuk bisa Ujian Kembali.</h4><br>
                  <input type=submit class='btn btn-sm btn-primary' value='Mulai Mengerjakan' onclick='window.location.reload()'>
                  <a href="<?= site_url('siswa/tugas');?>" class='btn btn-sm btn-warning'>Kembali</a>
                </form>
                </div>
              </div>
            </div>
            
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->