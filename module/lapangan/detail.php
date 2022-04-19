<?php 
$id = $_GET['id'];
$detail=mysqli_fetch_array(mysqli_query($conn,"SELECT * from lapangan where id = '".$id."'"));
$json = json_decode($detail['json'],true);
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
        <h3>Preview <span class="text-primary"><?php echo $detail['nama'] ?></span></h3>
      </div>
      <div class="card-body">
        <div class="owl-carousel owl-theme mb-3">
          <?php 
          $media = mysqli_query($conn,"SELECT * from lapangan_media where id_lapangan = '".$detail['id']."'");
          foreach ($media as $row): ?>
            <div class="image-container">
              <img src="<?php echo $row['path'] ?>" alt="Avatar" class="image">
              <div class="image-middle">
                <a href="<?php echo $row['path'] ?>"  data-toggle="tooltip" data-placement="top" title="Preview" target="_blank" class="btn btn-secondary btn-xs"><i class="fa fa-eye"></i></a>
                <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="swal_delete('<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=drop_img&id_lapangan=<?php echo $detail['id'] ?>&id=<?php echo $row['id']; ?>')"><i class="fa fa-trash"></i></a>
              </div>
            </div>
          <?php endforeach ?>
          <div class="image-container">
            <img class="image" style="background:#eee;border: none;" alt="Add more">
            <div class="image-middle">
              <a href="?module=<?php echo $_GET['module'] ?>&act=upload&id=<?php echo $detail['id'] ?>" class="btn btn-add"><i class="fa fa-plus"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-12">
    <div class="card">
      <form method="POST" action="<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=cost">
        <input type="hidden" name="id_lapangan" value="<?php echo $id ?>">
        <div class="card-header">
          <h3>Rincian <?php echo $detail['nama'] ?></h3>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table display">
              <tr>
                <th class="bg-gradient-primary text-white">06.00 s/d 15.00</th>
                <td>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <!-- <span class="input-group-text" id="basic-addon15">Rp.</span> -->
                    </div>
                    <input type="number" name="price[15]" class="form-control" aria-describedby="basic-addon15" value="<?php echo $json[15] ?>">
                  </div>
                </td>
              </tr>
              <tr>
                <th class="bg-gradient-primary text-white">16.00 s/d 24.00</th>
                <td>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <!-- <span class="input-group-text" id="basic-addon24">Rp.</span> -->
                    </div>
                    <input type="number" name="price[24]" aria-describedby="basic-addon24" class="form-control" value="<?php echo $json[24] ?>">
                  </div>
                </td>
              </tr>

            </table>
            <table class="table display" hidden>
              <thead class="bg-gradient-primary text-white">
                <tr>
                  <th rowspan="2">Jam</th>
                  <th colspan="7" class="text-center">Hari</th>
                  <th rowspan="2" class="d-print-none"></th>
                </tr>
                <tr>
                  <?php for ($i=1; $i<=7; $i++) { 
                    echo '<th>'.hari($i).'</th>';
                  } ?>
                </tr>
              </thead>
              <tbody>
                <?php 
                for ($j=0; $j <= 23; $j++) { 
                  ?>
                  <tr>
                    <th><b><?php echo $j.":00" ?></b></th>
                    <?php 
                    for ($h=1; $h<=7; $h++) { 
                      $cost = mysqli_fetch_array(mysqli_query($conn,"SELECT price from lapangan_cost where id_lapangan = '$id' and hari = '$h' and jam = '$j'"));
                      $cost = @$cost['price'];
                      ?>
                      <td>
                        <!-- <input type="number" name="price[<?php echo $h ?>][<?php echo $j ?>]" class="form-control" value="<?php echo @$cost ?>"> -->
                      </td>
                      <?php
                    }
                    ?>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="col-sm-12 form-group p-4">
            <button type="submit" class="btn btn-lg btn-primary bg-gradient-primary pull-right"><i class="fa fa-save"></i> Save changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>