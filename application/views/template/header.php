<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title><?= $header; ?></title>
  <link href="<?= base_url();?>/RuangAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url();?>/RuangAdmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url();?>/RuangAdmin/css/ruang-admin.min.css" rel="stylesheet">
  <link href="<?= base_url();?>/RuangAdmin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
   <?php if($this->session->userdata('level') == 1) {?>
   <?php include 'sidebar_admin.php'; ?>
   <?php }else if($this->session->userdata('level') == 2) { ?>
   <?php include 'sidebar_pengajar.php'; ?>
   <?php }else{
     include 'sidebar_siswa.php'; 
    }  
   ?>
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <?php
                if($this->session->userdata('level') == 2 || $this->session->userdata('level') == 1){
                  $pengajar = $this->db->get_where('pengajar',['id' => $_SESSION['id_pengajar'] ])->row(); 
                }else{
                  $pengajar = $this->db->get_where('siswa',['id' => $_SESSION['id_siswa']])->row();
                }
                if($pengajar->foto != null){
                ?>
                <img class="img-profile rounded-circle" src="<?= base_url().$pengajar->foto; ?>" style="max-width: 60px">
                <?php }else{ ?>
                <img class="img-profile rounded-circle" src="<?= base_url();?>/RuangAdmin/img/boy.png" style="max-width: 60px">
                <?php } ?>
                <span class="ml-2 d-none d-lg-inline text-white small"><?= $pengajar->nama; ?></span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->