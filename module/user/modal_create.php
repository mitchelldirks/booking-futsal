<form method="POST" action="<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=create">
  <div class="row">
    <div class="col-md-12 col-xs-12 form-group">
      <label><?php echo ucwords(str_replace("_"," ", "username")) ?></label>
      <input type="text" class="form-control" name="username">
    </div>
    <div class="col-md-12 col-xs-12 form-group">
      <label><?php echo ucwords(str_replace("_"," ", "password")) ?></label>
      <input type="text" class="form-control" name="password">
    </div>
    <div class="col-md-12 col-xs-12 form-group">
      <label><?php echo ucwords(str_replace("_"," ", "nama")) ?></label>
      <input type="text" class="form-control" name="nama">
    </div>
    <div class="col-md-12 col-xs-12 form-group">
      <label><?php echo ucwords(str_replace("_"," ", "no_telp")) ?></label>
      <input type="text" class="form-control" name="no_telp">
    </div>
    <div class="col-md-12 col-xs-12 form-group">
      <label><?php echo ucwords(str_replace("_"," ", "email")) ?></label>
      <input type="text" class="form-control" name="email">
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
      <textarea class="form-control" name="alamat"></textarea>
    </div>
    <div class="col-md-12 col-xs-12 form-group">
      <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </div>
  </div>
</form>