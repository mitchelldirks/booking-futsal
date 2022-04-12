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
                <label><?php echo ucwords(str_replace("_"," ", "nama")) ?></label>
                <input required type="text" class="form-control" name="nama">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "tipe")) ?></label>
                <input required type="text" class="form-control" name="tipe">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "deskripsi")) ?></label>
                <textarea class="form-control" name="deskripsi"></textarea>
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