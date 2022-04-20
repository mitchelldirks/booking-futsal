<style type="text/css">
  .slot{
    height: 100px;
    border-radius: 10px;
  }
  .slot-success{
    color: #fff;
    /*background-color: #618833;*/
    background-image: linear-gradient(310deg,#618833,#4d6d28);
  }
  /*.slot-success:hover{
    background-color: #4d6d28;
  }*/

</style>
<div class="row">
  <div class="col-sm-12 mb-3">
    <div class="card">
      <div class="card-header">
        <h5><?php echo ucwords(str_replace("_"," ", $_GET['act'])) ?></h5>
      </div>
      <div class="card-body">
        <div class="col-md-12">
          <form id="myForm" method="POST" action="<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=<?php echo $_GET['act'] ?>">
            <div class="row">
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "nama_customer")) ?></label>
                <input required type="text" class="form-control" name="nama_customer" autofocus="true">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "lapangan")) ?></label>
                <select class="form-control" name="id_lapangan" id="lapangan">
                  <?php 
                  $lapangan = mysqli_query($conn,"SELECT * from lapangan order by nama");
                  foreach ($lapangan as $l): 
                    $w = json_decode($l['json'],true);
                    $waktu="";
                    foreach ($w as $key => $value) {
                      $waktu .= " | t<=".$key." = Rp. ".number_format($value);
                    }
                    ?>
                    <option value="<?php echo $l['id'] ?>"><?php echo $l['nama']." (".$l['tipe'].") ".$waktu ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "tanggal")) ?></label>
                <input required type="date" class="form-control" name="tanggal" value="<?php echo date('Y-m-d') ?>">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "jam_mulai")) ?></label>
                <!-- <input required type="time" class="form-control" name="jam_mulai"> -->
                <select class="form-control" name="jam_mulai" id="jam_mulai">
                  <option selected disabled class="text-muted">Pilih Jam Mulai</option>
                  <?php foreach (range(6, 24) as $key => $value): ?>
                    <option value="<?php echo $value ?>" <?php echo date('H')==$value ? 'selected':'' ?>><?php echo $value.".00" ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <label><?php echo ucwords(str_replace("_"," ", "durasi (jam)")) ?></label>
                <input required type="number" class="form-control" name="durasi" id="durasi" value="1">
              </div>
              <div class="col-md-12 col-xs-12 form-group">
                <a id="trx_submit" class="btn btn-primary">Submit</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-12 mb-3">
    <div class="card">
      <div class="card-header">
        <h5>Available Slot</h5>
        <div class="form-group">
          <label>Tanggal</label>
          <input type="date" id="date_request" onchange="trigger_slot()" class="form-control" value="<?php echo date('Y-m-d') ?>">
        </div>
      </div>
      <div class="card-body">
        <div class="row" id="slot">
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
  function trigger_slot() {
    request_slot($('#date_request').val())
  }
  function request_slot(tanggal=null) {
    console.log(tanggal)
    var url = "<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=slot&tanggal="+tanggal
    $.post(url, function(data) {
      var data     = JSON.parse(data);
      $("#slot").html(data.html);
    });
  }
  $(document).ready(function(){
    request_slot('<?=date("Y-m-d")?>')
  });
  $("#trx_submit").click(function(){
    var url = "<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=<?php echo $_GET['act'] ?>"
    var urlPreview = "<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=preview"
    var lapangan  = $("#lapangan option:selected").val()
    var jam_mulai = $("#jam_mulai option:selected").val()
    var durasi    = $("#durasi").val()
    Swal.fire({
      title: 'Loading..',
      timer: 3000,
      timerProgressBar: true,

      allowEscapeKey: false,
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading()
        // if (lapangan.length==0) {
        //   Swal.fire({
        //     icon: 'error',
        //     title:'Error',
        //     text: 'Pilih Lapangan terlebih dahulu',
        //     timer: 3500,
        //   })
        // }else{

          $.post(urlPreview+'&id_lapangan='+lapangan+'&jam_mulai='+jam_mulai+'&durasi='+durasi, function(data) {
            var data     = JSON.parse(data);
            if (data.response==200) {
              Swal.fire({
                title: data.title,
                html: data.msg,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor:'#cc0c9f',
                cancelButtonColor: '#ccc',
                confirmButtonText: 'Buat Pesanan',
                cancelButtonText:  'Cancel'
              }).then((result) => {
                if (result.isConfirmed) {
                  $("#myForm").submit()
                }
              })
            }else if (data.response==404){
              Swal.fire({
                icon: 'error',
                title:data.title,
                html: data.msg,
                timer: 3500,
              })
            }else{
              swal.fire({ 
                title: 'error',
                icon: 'error',
                timer: 3500,
                showConfirmButton: false,
              });
            }
          });
        // }
      },
    }).then((result) => {
      if (result.dismiss === Swal.DismissReason.timer) {
        swal.fire({ 
          title: 'error',
          icon: 'Error',
          timer: 2000,
          showConfirmButton: false,
        });
      }
    })
  });
</script>