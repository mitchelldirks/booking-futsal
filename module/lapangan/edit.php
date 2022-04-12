<?php $edit=mysqli_fetch_array(mysqli_query($conn,"SELECT * from lapangan where id = '".$_GET['id']."'")); ?>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5><?php echo ucwords(str_replace("_"," ", $_GET['act'])) ?></h5>
      </div>
      <div class="card-body">
        <div class="col-md-12">
          <form method="POST" action="<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=<?php echo $_GET['act'] ?>">
            <input required type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <div class="row">
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "nama")) ?></label>
                <input required type="text" class="form-control" name="nama" value="<?php echo $edit['nama'] ?>">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "tipe")) ?></label>
                <input required type="text" class="form-control" name="tipe" value="<?php echo $edit['tipe'] ?>">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "deskripsi")) ?></label>
                <textarea class="form-control" name="deskripsi"><?php echo $edit['deskripsi'] ?></textarea>
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customCheck1" name="aktif" value="1" <?php echo $edit['aktif']==1?'checked':'' ?>>
                  <label class="custom-control-label" for="customCheck1">Aktif</label>
                </div>
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>