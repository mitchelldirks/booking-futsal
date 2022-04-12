<?php 
$js = array(
  'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js',
  'assets/js/core/popper.min.js',
  'assets/js/core/bootstrap.min.js',
  'assets/js/plugins/perfect-scrollbar.min.js',
  'assets/js/plugins/smooth-scrollbar.min.js',
  'assets/js/soft-ui-dashboard.min3447.js?v=1.0.5',
  'https://cdn.jsdelivr.net/npm/sweetalert2@11',
);
foreach ($js as $key => $value) { ?>
  <script src="<?= $value ?>"></script>
  <?php 
}
?>

<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<script type="text/javascript">
  function logout(){
    Swal.fire({
      title: 'Yakin untuk logout',
      text: "Anda akan diarahkan ke laman login",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor:'#cc0c9f',
      cancelButtonColor: '#ccc',
      confirmButtonText: 'Logout',
      cancelButtonText:  'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '?logout'
      }
    })
  }
</script>