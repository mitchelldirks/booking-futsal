<?php $edit=mysqli_fetch_array(mysqli_query($conn,"SELECT * from users where id = '".$_GET['id']."'")); ?>
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
                <label><?php echo ucwords(str_replace("_"," ", "username")) ?></label>
                <input required type="text" class="form-control" name="username" value="<?php echo $edit['username'] ?>">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "password")) ?> <span class="text-muted">* abaikan jika tidak ada pergantian password</span></label>
                <input type="password" class="form-control" name="password" autocomplete="off">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "nama")) ?></label>
                <input required type="text" class="form-control" name="nama" value="<?php echo $edit['nama'] ?>">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "no_telp")) ?></label>
                <input required type="text" class="form-control" name="no_telp" value="<?php echo $edit['no_telp'] ?>">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "email")) ?></label>
                <input required type="text" class="form-control" name="email" value="<?php echo $edit['email'] ?>">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "level")) ?></label>
                <select class="form-control" name="level">
                  <?php foreach (array('administrator','manager','agen') as $key => $value): ?>
                    <option value="<?php echo $value ?>" <?php echo $value==$edit['level'] ? ' selected ':'' ?>><?php echo ucwords($value) ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "alamat")) ?></label>
                <textarea class="form-control" name="alamat"><?php echo $edit['alamat'] ?></textarea>
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