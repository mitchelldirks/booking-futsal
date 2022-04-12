<?php 
$id = $_GET['id'];
$detail=mysqli_fetch_array(mysqli_query($conn,"SELECT * from lapangan where id = '".$id."'"));
?>
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
      <form method="POST" action="<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=cost">
        <input type="hidden" name="id_lapangan" value="<?php echo $id ?>">
        <div class="card-header">
          <h1>Detail <?php echo $detail['nama'] ?></h1>
        </div>
        <div class="card-body px-0 pt-0 pb-2">

          <div class="table-responsive p-0">
            <table class="table display">
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
                        <input type="number" name="price[<?php echo $h ?>][<?php echo $j ?>]" class="form-control" value="<?php echo @$cost ?>">
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
            <button type="submit" class="btn btn-lg btn-primary bg-gradient-primary "><i class="fa fa-save"></i> Save changes</button>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>