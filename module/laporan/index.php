<style type="text/css">
  .card{
    margin-bottom: 10px;
  }
  .bg-grad{
    background-image: linear-gradient(310deg,#7928ca,#ff0080);
  }
  h3 a{
    color: white;
  }
  h3 a: hover{
    color: grey;
  }
  canvas {
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
  }
</style>
<div class="row">
  <div class="col-sm-12">
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
  </div>
  <div class="col-sm-4">
    <div class="card p-3 bg-grad">
      <h3><a href="?module=<?php echo $_GET['module'] ?>&act=detail&timeline=harian&time=<?=date('Y-m-d')?>">Laporan Harian</a></h3>
      <p class="text-white">
        <?php 
        $res = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as total from transaksi where tanggal = '".date('Y-m-d')."'"));
        echo number_format($res['total'])." Transaksi";
        ?>
      </p>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card p-3 bg-grad">
      <h3><a href="?module=<?php echo $_GET['module'] ?>&act=detail&timeline=bulanan&time=<?=date('Y-m')?>">Laporan Bulanan</a></h3>
      <p class="text-white">
        <?php 
        $res = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as total from transaksi where tanggal like '".date('Y-m')."%'"));
        echo number_format($res['total'])." Transaksi";
        ?>
      </p>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card p-3 bg-grad">
      <h3><a href="?module=<?php echo $_GET['module'] ?>&act=detail&timeline=tahunan&time=<?=date('Y')?>">Laporan Tahunan</a></h3>
      <p class="text-white">
        <?php 
        $res = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as total from transaksi where tanggal like '".date('Y')."%'"));
        echo number_format($res['total'])." Transaksi";
        ?>
      </p>
    </div>
  </div>
  <div class="col-sm-12">
    <div class="card p-3">
      <canvas id="canvas"></canvas>
    </div>
  </div>
</div>
<!-- <script src="https://www.chartjs.org/dist/2.6.0/Chart.bundle.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script ssrc="https://www.chartjs.org/samples/2.6.0/utils.js"></script>
<script type="text/javascript">
 var ctx = document.getElementById("canvas").getContext('2d');
 var canvas = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24],
    datasets: [{
      label: 'Grafik jam booking',
      data: [
      <?php 
      for ($h=6; $h <= 24; $h++) { 
        $td = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as count from transaksi_detail where jam = '".$h."'"));
        echo $td['count'].",";
      }
      ?>
      ],
      backgroundColor: 'rgba(255, 99, 132, 0.2)',
      borderColor: 'rgba(255,99,132,1)',
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero:true
        }
      }]
    }
  }
});
</script>