<?php 
$id = $_GET['id'];
$detail=mysqli_fetch_array(mysqli_query($conn,"SELECT * from lapangan where id = '".$id."'"));
?>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Upload Gambar</h5>
      </div>
      <div class="card-body">
        <form id="img" method="POST" enctype="multipart/form-data" action="<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=upload&id=<?php echo $detail['id'] ?>">
          <div class="form-group">
            <input type="file" name="images" class="form-control" accept="image/*" required>
          </div>
          <div class="form-group">
            <button class="btn btn-outline-primary btn-xs" type="submit">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>