<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>E-learning SMP - Login</title>
  <link href="<?= base_url();?>RuangAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url();?>RuangAdmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url();?>RuangAdmin/css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login" style="background-color: #909aab;">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row">
      <div class="col-xl-8 col-lg-8 col-md-8 my-5">
      	<div class="alert alert-primary" role="alert">
		  Selamat Datang Di Elearning Sekolah Menengah Pertama
		</div>
      	<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
		    <ol class="carousel-indicators">
		      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
		      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
		      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
		    </ol>
		    <div class="carousel-inner">
		      <div class="carousel-item active">
		        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSN99wVIKr5zts06P7ElqNCOJqXgCqCsEgoXA&usqp=CAU" class="d-block w-100" alt="...">
		        <div class="carousel-caption d-none d-md-block">
		          <h5>First slide label</h5>
		          <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
		        </div>
		      </div>
		      <div class="carousel-item">
		        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfKtn0Z8YU3OrGB9gz3BUrLn1xyFtAOMhqDg&usqp=CAU" class="d-block w-100" alt="...">
		        <div class="carousel-caption d-none d-md-block">
		          <h5>Second slide label</h5>
		          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
		        </div>
		      </div>
		      <!-- <div class="carousel-item">
		        <img src="..." class="d-block w-100" alt="...">
		        <div class="carousel-caption d-none d-md-block">
		          <h5>Third slide label</h5>
		          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
		        </div>
		      </div> -->
		    </div>
		    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
		      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		      <span class="sr-only">Previous</span>
		    </a>
		    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
		      <span class="carousel-control-next-icon" aria-hidden="true"></span>
		      <span class="sr-only">Next</span>
		    </a>
		</div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-4">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <p><img src="<?= base_url('assets/pendidikan.png');?>" height="100"></p>
                    <h1 class="h4 text-gray-900 mb-4">Website E-learning <br> Sekolah Menengah Pertama <br> Di Kecamatan Pontianak Utara</h1>
                  </div>
                  <?php if(isset($_SESSION['error'])) alert($_SESSION['error'],'danger');?>
                  <form class="user" action="<?= site_url('utama/login'); ?>" method="post">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control" aria-describedby="emailHelp"
                        placeholder="Masukan Alamat Email">
                      <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                      <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="<?= base_url();?>RuangAdmin/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url();?>RuangAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url();?>/RuangAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?= base_url();?>/RuangAdmin/js/ruang-admin.min.js"></script>
</body>

</html>