   <!-- Sidebar -->
   <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="<?= base_url('assets/pendidikan.png');?>">
        </div>
        <div class="sidebar-brand-text mx-3">E-learning</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item <?php active_link('index') ?>">
        <a class="nav-link" href="<?= site_url('pengajar/index'); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Beranda</span></a>
      </li>
      <!-- <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Featuress
      </div> -->

      <li class="nav-item <?php active_link('file_materi') ?>">
        <a class="nav-link" href="<?= site_url('pengajar/file_materi'); ?>">
          <i class="fas fa-fw fa-atlas"></i>
          <span>File Materi</span>
        </a>
      </li>

      <li class="nav-item <?php active_link('pengumuman') ?>">
        <a class="nav-link" href="<?= site_url('pengajar/pengumuman'); ?>">
          <i class="fas fa-fw fa-balance-scale"></i>
          <span>Pengumuman</span>
        </a>
      </li>

      <li class="nav-item <?php active_link('tugas') ?>">
        <a class="nav-link" href="<?= site_url('pengajar/tugas'); ?>">
          <i class="fas fa-fw fa-stream"></i>
          <span>Tugas</span>
        </a>
      </li>

      <li class="nav-item <?php active_link('ujian') ?>">
        <a class="nav-link" href="<?= site_url('pengajar/laporan_nilai'); ?>">
          <i class="fas fa-fw fa-caret-square-down"></i>
          <span>Laporan Nilai</span>
        </a>
      </li>
      
      <li class="nav-item <?php active_link('ubah_profil') ?>">
        <a class="nav-link" href="<?= site_url('pengajar/ubah_profil'); ?>">
          <i class="fas fa-fw fa-cog"></i>
          <span>Ubah Profil</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('utama/logout'); ?>">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
          aria-controls="collapseTable">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tables</h6>
            <a class="collapse-item" href="simple-tables.html">Simple Tables</a>
            <a class="collapse-item" href="datatables.html">DataTables</a>
          </div>
        </div>
      </li> -->
      
    </ul>
    <!-- Sidebar -->