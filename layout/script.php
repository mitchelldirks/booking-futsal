<?php 

foreach ($js as $key => $value) { ?>
  <script src="<?= $value ?>"></script>
  <?php 
}
?>
<script>
  $(document).ready(function(){
    
  // var win = navigator.platform.indexOf('Win') > -1;
  // if (win && document.querySelector('#sidenav-scrollbar')) {
  //   var options = {
  //     damping: '0.5'
  //   }
  //   Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  // }
  $('#datatables').DataTable();
  $('[data-toggle="tooltip"]').tooltip()

  $('.owl-carousel').owlCarousel();
});
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
  function swal_delete(url){
    Swal.fire({
      title: 'Hapus data?',
      text: "Data yang dihapus akan hilang secara permanen",
      icon: 'danger',
      showCancelButton: true,
      confirmButtonColor:'#e90607',
      cancelButtonColor: '#ccc',
      confirmButtonText: 'Hapus',
      cancelButtonText:  'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url
      }
    })
  }
</script>