<?php
$sql="INSERT INTO ".$table." (username,password,nama,no_telp,email,alamat,level,aktif,created_by,created_at,updated_by,updated_at) 
VALUES ('".$_POST['username']."', '".md5($_POST['password'])."','".$_POST['nama']."','".$_POST['no_telp']."','".$_POST['email']."','".$_POST['alamat']."','customer','Y','$user','$now','$user','$now')";
$query = mysqli_query($conn,$sql);
$_SESSION['flash']['class']='alert alert-success';
$_SESSION['flash']['label']='Registrasi Berhasil, silakan masuk untuk melanjutkan';
$_SESSION['flash']['icon']='fa fa-check';
header('Location: index.php');