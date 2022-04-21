<meta charset="utf-8" />
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="assets/img/favicon.png">
<title><?php echo isset($_GET['module']) ? ucwords(str_replace("_"," ",$_GET['module']))." | ".TITLE : " Dashboard "." | ".TITLE ?></title>

<?php 

foreach ($css as $key => $value) { 
  ?>
  <link href="<?= $value ?>" rel="stylesheet"/>
  <?php
}
?>
<style>
  .async-hide {
    opacity: 0 !important
  }
  th{
    text-align: left;
  }
</style>