   <!-- Sidebar -->
   <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="<?= base_url('assets/pendidikan.png');?>">
        </div>
        <div class="sidebar-brand-text mx-3">E-learning</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?= site_url('siswa/index'); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Beranda</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('siswa/tugas'); ?>">
          <i class="fas fa-fw fa-archive"></i>
          <span>Tugas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('siswa/file_materi'); ?>">
          <i class="fas fa-fw fa-book"></i>
          <span>File Materi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('siswa/nilai_tugas'); ?>">
          <i class="fas fa-fw fa-bell"></i>
          <span>Nilai</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('siswa/ubah_profil'); ?>">
          <i class="fas fa-fw fa-user-circle"></i>
          <span>Profil</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('utama/logout'); ?>">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span>
        </a>
      </li>
    </ul>
    <!-- Sidebar -->