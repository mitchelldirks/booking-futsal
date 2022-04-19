<?php 
include 'config/koneksi.php';
include 'config/config.php';
include 'config/function.php';
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Register | <?php echo TITLE ?>
  </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.min3447.css?v=1.0.5" rel="stylesheet" />
  <style>
    .async-hide {
      opacity: 0 !important
    }
    #submit[disabled]{
      cursor: not-allowed;
    }
  </style>
</head>
<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 ">
              <?php echo TITLE ?>
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
              </ul>
              <li class="nav-item d-flex align-items-center">
                <span style="padding-right: 12px;">Sudah punya akun?</span>
              </li>
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  <a href="index.php" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">Masuk</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <?php 
                  if (isset($_SESSION['flash'])): ?>
                    <div class="<?php echo $_SESSION['flash']['class']; ?> mt-3 mb-3 alert-dismissible fade show"> 
                      <span class="text-white">
                        <i class="<?php echo $_SESSION['flash']['icon'] ?>"></i> 
                        <?php echo $_SESSION['flash']['label']; ?>  
                      </span>
                      <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                  <?php endif ?>
                  <h3 class="font-weight-bolder text-info text-gradient">Registrasi</h3>
                  <p class="mb-0">Registrasi untuk dapat akses</p>
                </div>
                <div class="card-body">
                  <form role="form" action="register.php" method="post">
                    <label>Nama</label>
                    <div class="mb-3">
                      <input type="text" required name="nama" class="form-control" placeholder="Nama" aria-label="name" aria-describedby="name-addon">
                    </div>
                    <label>Telpon</label>
                    <div class="mb-3">
                      <input type="tel" required name="no_telp" class="form-control" placeholder="Nomor Telpon" aria-label="tel" aria-describedby="tel-addon">
                    </div>
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" required name="email" class="form-control" placeholder="email" aria-label="email" aria-describedby="email-addon">
                    </div>
                    <label>Username</label>
                    <div class="mb-3">
                      <input type="text" required name="username" class="form-control" placeholder="username" aria-label="username" aria-describedby="username-addon">
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" required name="password" id="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                    </div>
                    <label>Konfirmasi Password</label>
                    <div class="mb-3">
                      <input type="password" required onchange="checkPasswordMatch()" id="Cpassword" class="form-control" placeholder="Konfirmasi Password" aria-label="Password" aria-describedby="password-addon">
                      <small id="passwordMatch"></small>
                    </div>
                    <div class="text-center">
                      <button type="submit" disabled id="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Daftar</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Sudah punya akun?
                    <a href="index.php" class="text-info text-gradient font-weight-bold">Masuk</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Soft by Creative Tim.
          </p>
        </div>
      </div>
    </div>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    function checkPasswordMatch() {
      var password = $("#password").val();
      var confirmPassword = $("#Cpassword").val();
      if (password != confirmPassword){
        $("#passwordMatch").html("Passwords do not match!");
        $("#passwordMatch").css("color","red");
        $("#submit").attr("disabled",true)
      }else{
        $("#passwordMatch").html("Passwords match.");
        $("#passwordMatch").css("color","linear-gradient(310deg,#2152ff,#21d4fd)");

        $("#submit").removeAttr("disabled")
      }
    }
  </script>
  <script src="assets/js/soft-ui-dashboard.min3447.js?v=1.0.5"></script>
</body>
<!-- Mirrored from demos.creative-tim.com/soft-ui-dashboard/pages/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Apr 2022 04:53:59 GMT -->
</html>
<?php unset($_SESSION['flash']) ?>