<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5><?php echo ucwords(str_replace("_"," ", $_GET['act'])) ?></h5>
      </div>
      <div class="card-body">
        <div class="col-md-12">
          <form method="POST" action="<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=<?php echo $_GET['act'] ?>">
            <div class="row">
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "username")) ?></label>
                <input required type="text" class="form-control" name="username">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "password")) ?></label>
                <input required type="password" class="form-control" name="password">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "nama")) ?></label>
                <input required type="text" class="form-control" name="nama">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "no_telp")) ?></label>
                <input required type="text" class="form-control" name="no_telp">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "email")) ?></label>
                <input required type="text" class="form-control" name="email">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "level")) ?></label>
                <select class="form-control" name="level">
                  <option selected disabled class="text-muted">Pilih Level</option>
                  <?php foreach (array('admin','customer','owner') as $key => $value): ?>
                    <option value="<?php echo $value ?>"><?php echo ucwords($value) ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "alamat")) ?></label>
                <textarea class="form-control" name="alamat"></textarea>
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