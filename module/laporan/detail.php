
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
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <div class="d-print-none">
          <form>
            <input type="hidden" name="module" value="<?php echo $_GET['module'] ?>">
            <input type="hidden" name="act" value="detail">
            <input type="hidden" name="timeline" value="<?php echo $_GET['timeline'] ?>">
            <div class="form-group">
              <div class="input-group">
                <?php if ($_GET['timeline']=='harian'): ?>
                  <input type="date" name="time" class="form-control" value="<?=isset($_GET['time']) ? $_GET['time'] : date('Y-m-d') ?>">
                <?php elseif ($_GET['timeline']=='bulanan') : ?>
                  <input type="month" name="time" class="form-control" value="<?=isset($_GET['time']) ? $_GET['time'] : date('Y-m') ?>">
                <?php elseif ($_GET['timeline']=='tahunan') : ?>
                  <input type="number" name="time" class="form-control" min="2020" max="2077" value="<?=isset($_GET['time']) ? $_GET['time'] : date('Y') ?>">
                <?php endif ?>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit" style="margin-bottom: 0;">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
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
                  <td><?php echo $row['tanggal'] ?></td>
                  <td><?php echo $row['jam_mulai'].".00" ?></td>
                  <td><?php echo $end > 24 ? $end - 24 : $end ?>.00</td>
                  <td><?php echo $row['harga'] ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="module/<?php echo $_GET['module'] ?>/print.php?<?=http_build_query($_GET)?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i></a>
      </div>
    </div>
  </div>
</div>