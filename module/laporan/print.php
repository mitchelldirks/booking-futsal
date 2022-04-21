<?php 
include '../../config/koneksi.php';
include '../../config/assets.php';
include '../../config/function.php';
// include '../../layout/head.php';
// include '../../layout/script.php';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
<link href="../../assets/css/fontawesome.css" rel="stylesheet"/>
<link href="../../assets/css/soft-ui-dashboard.min3447.css?v=1.0.5" rel="stylesheet"/>
<style>
  .async-hide {
    opacity: 0 !important
  }
  th{
    text-align: left;
  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  window.print()
</script>
<div class="row">
  <div class="col-sm-12">
    <!-- <div class="d-print-none">
    </div> -->
    <h3 class="text-center">Laporan Transaksi <?php echo $_GET['timeline'] ?> <?php echo $_GET['timeline'] == 'harian' ? dateIndonesian($_GET['time']) : $_GET['timeline'] == 'bulanan' ? bulan(explode("-",$_GET['time'])[1])." ".explode("-",$_GET['time'])[0] : $_GET['time'] ?></h3>
  </div>
  <div class="px-0 pt-0 pb-2">
    <div class="table-responsive p-3">
      <table class="table display" id="datatables">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Transaksi</th>
            <th>Customer</th>
            <th>Lapangan</th>
            <th>Tanggal</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $no=0;
          if ($_GET['timeline']=='harian') {
            $query = mysqli_query($conn,"SELECT * from transaksi where tanggal = '".$_GET['time']."' order by tanggal,jam_mulai");
          }elseif ($_GET['timeline']=='bulanan') {
            $query = mysqli_query($conn,"SELECT * from transaksi where tanggal like '".$_GET['time']."%' order by tanggal,jam_mulai");
          }elseif ($_GET['timeline']=='tahunan') {
            $query = mysqli_query($conn,"SELECT * from transaksi where tanggal like '".$_GET['time']."%' order by tanggal,jam_mulai");
          }
          foreach ($query as $row): $no++;
            $end = $row['jam_mulai']+$row['durasi'];
            $lapangan = mysqli_fetch_array(mysqli_query($conn,"SELECT * from lapangan where id = '".$row['id_lapangan']."'"));
            ?>
            <tr>
              <td><?php echo $no ?></td>
              <td><small><b>#TRX<?php echo $row['kode_transaksi'] ?></b></small></td>
              <td><?php echo $row['nama_customer'] ?></td>
              <td><?php echo $lapangan['nama'] ?></td>
              <td><?php echo dateIndonesian($row['tanggal']) ?></td>
              <td><?php echo $row['jam_mulai'].".00" ?></td>
              <td><?php echo $end > 24 ? $end - 24 : $end ?>.00</td>
              <td><?php echo $row['harga'] ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>