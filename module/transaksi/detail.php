<?php 
$id = $_GET['id'];
$trx      = mysqli_fetch_array(mysqli_query($conn,"SELECT * from transaksi where kode_transaksi = '".$id."'"));
$lapangan = mysqli_fetch_array(mysqli_query($conn,"SELECT * from lapangan where id = '".$trx['id_lapangan']."'"));
// print_r($lapangan);exit;
$json = json_decode($lapangan['json'],true);
?>
<style>
  .image-container {
    position: relative;
  }
  .image {
    opacity: 1;
    display: block;
    transition: .5s ease;
    backface-visibility: hidden;
    height: 200px;
    max-width:200px;
    max-height:200px;
    border-radius: 10px;
  }
  .image-middle {
    transition: .5s ease;
    opacity: 0;
    /*position: absolute;*/
    transform: translate(-17%, -100%);
    -ms-transform: translate(-17%, -100%);
    text-align: center;
  }
  .image-container:hover .image {
    opacity: 0.3;
  }
  .image-container:hover .image-middle {
    opacity: 1;
  }
  .image-text {
    background-color: #04AA6D;
    color: white;
    font-size: 16px;
    padding: 16px 32px;
  }
  .btn-add{
    border-radius: 10px;
    align-items: middle;
    color: white;
    text-align: center;
  }
  .btn-add span{
    align-items: middle;
    margin-top: 50%;
  }
  .btn-add:hover {
    background-color: black;
  }
  th,td{
    padding-right: 10px;
    padding-top: 10px;
    padding-bottom: 10px;
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
  <div class="col-sm-12 mb-2">
    <div class="card">
      <div class="card-header">
        <h5 class="text-primary"><b>Pemesanan <?php echo "#TRX".$trx['kode_transaksi'] ?></b></h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 col-xs-12">
            <?php 
            $media = mysqli_query($conn,"SELECT * from lapangan_media where id_lapangan = '".$lapangan['id']."' limit 1");
            foreach ($media as $row): ?>
              <div class="image-container">
                <img src="<?php echo $row['path'] ?>" alt="Avatar" class="image">
              </div>
            <?php endforeach ?>
          </div>
          <div class="col-lg-4 col-xs-12">
            <table>
              <tr>
                <th class="text-primary">Lapangan</th>
                <td style="padding-right:20px">&nbsp;</td>
                <td><?php echo $lapangan['nama'] ?></td>
              </tr>
              <tr>
                <th class="text-primary">Durasi</th>
                <td style="padding-right:20px">&nbsp;</td>
                <td><?php echo $trx['durasi']." jam" ?></td>
              </tr>
              <tr>
                <th class="text-primary">Jam Mulai</th>
                <td style="padding-right:20px">&nbsp;</td>
                <td><?php echo $trx['jam_mulai'].".00" ?></td>
              </tr>
              <tr>
                <th class="text-primary">Biaya</th>
                <td style="padding-right:20px">&nbsp;</td>
                <td><b><?php echo "Rp. ".number_format($trx['harga']) ?></b></td>
              </tr>
            </table>
          </div>
          <div class="col-lg-4 col-xs-12">
            <?php 
            $user=mysqli_fetch_array(mysqli_query($conn,"SELECT * from users where id = '".$trx['id_customer']."'"));
            ?>
            <table>
              <tr>
                <th class="text-primary">Pemesan</th>
                <td style="padding-right:20px">&nbsp;</td>
                <td><?php echo $trx['nama_customer'] ?></td>
              </tr>
              <?php if (!empty($user)): ?>
                <tr>
                  <th class="text-primary">Telpon</th>
                  <td style="padding-right:20px">&nbsp;</td>
                  <td><a target="_blank" href="//wa.me/62<?php echo $user['no_telp'] ?>"><?php echo $user['no_telp'] ?></a></td>
                </tr>
                <tr>
                  <th class="text-primary">Email</th>
                  <td style="padding-right:20px">&nbsp;</td>
                  <td><a target="_blank" href="mailto:<?php echo $user['email'] ?>"><?php echo $user['email'] ?></a></td>
                </tr>
              <?php endif ?>
              <tr>
                <th class="text-primary">Waktu Pesan</th>
                <td style="padding-right:20px">&nbsp;</td>
                <td><?php echo dateIndonesian(explode(" ",$trx['created_at'])[0])." ".explode(" ",$trx['created_at'])[1] ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>