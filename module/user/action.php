<?php 
include '../../config/koneksi.php';
$user   = $_SESSION['id_user'];
$now    = date('Y-m-d H:i:s');
$table  = 'users';
$module = $_GET['module'];
$act    = $_GET['act'];
if($act == 'create'){
    $sql="INSERT INTO ".$table." (username,password,nama,no_telp,email,alamat,level,aktif,created_by,created_at,updated_by,updated_at)
    VALUES ('".$_POST['username']."', '".md5($_POST['password'])."','".$_POST['nama']."','".$_POST['no_telp']."','".$_POST['email']."','".$_POST['alamat']."','".$_POST['level']."','Y','$user','$now','$user','$now')";
    $query = mysqli_query($conn,$sql);
    $_SESSION['flash']['class']='alert alert-success';
    $_SESSION['flash']['label']='Penambahan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-check';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'edit'){
    $changepass = strlen($_POST['password']) > 0 ? " password = '".md5($_POST['password'])."', " : "";
    $sql="UPDATE ".$table." SET 
    username    = '".$_POST['username']."',
    $changepass 
    nama        = '".$_POST['nama']."',
    no_telp     = '".$_POST['no_telp']."',
    email       = '".$_POST['email']."',
    alamat      = '".$_POST['alamat']."',
    level       = '".$_POST['level']."',
    updated_by  = '$user',
    updated_at  = '$now'
    WHERE id = '".$_POST['id']."'";
    $query = mysqli_query($conn, $sql);
    $_SESSION['flash']['class']='alert alert-success';
    $_SESSION['flash']['label']='Pengubahan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-edit';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'delete'){
    $query = mysqli_query($conn, "DELETE FROM ".$table." WHERE id = '".$_GET['id']."'");
    $_SESSION['flash']['class']='alert alert-danger';
    $_SESSION['flash']['label']='Penghapusan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-trash';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'active'){
    $sql="UPDATE ".$table." SET aktif = 'Y' where id = '".$_GET['id']."'";
    $query = mysqli_query($conn, $sql);
    $_SESSION['flash']['class']='alert alert-success';
    $_SESSION['flash']['label']='Aktivasi Akun Berhasil';
    $_SESSION['flash']['icon']='fa fa-check';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'inactive'){
    $sql="UPDATE ".$table." SET aktif = 'N' where id = '".$_GET['id']."'";
    $query = mysqli_query($conn, $sql);
    $_SESSION['flash']['class']='alert alert-danger';
    $_SESSION['flash']['label']='Akun Telah Disuspend';
    $_SESSION['flash']['icon']='fa fa-ban';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'approve'){
    $sql="UPDATE ".$table." SET 
    is_approve      = '1',
    updated_by      = '$user',
    updated_at      = '$now'
    where id = '".$_GET['id']."'";
    $query = mysqli_query($conn, $sql);
    $_SESSION['flash']['class']='alert alert-success';
    $_SESSION['flash']['label']='Konfirmasi Akun Berhasil';
    $_SESSION['flash']['icon']='fa fa-check';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'decline'){
    $reason = htmlspecialchars(rawurldecode($_GET['reason']));
    $sql="UPDATE ".$table." SET 
    is_approve      = '0', 
    decline_reason  = '".$reason."',
    updated_by      = '$user',
    updated_at      = '$now'
    where id        = '".$_GET['id']."'";
    $query  = mysqli_query($conn, $sql);
    $user   = mysqli_fetch_array(mysqli_query($conn,"SELECT * from user where id = '".$_GE['id']."'"));
    $sql    = "DELETE FROM agen where id = '".$user['id_agen']."'";
    $query  = mysqli_query($conn, $sql);
    $_SESSION['flash']['class']='alert alert-danger';
    $_SESSION['flash']['label']='<b>Akun Ditolak dengan alasan:</b> '.$reason;
    $_SESSION['flash']['icon']='fa fa-ban';
    header('Location: ../../media.php?module='.$module);
}
?>