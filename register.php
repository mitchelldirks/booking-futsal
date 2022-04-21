<?php
include 'config/koneksi.php';
$table = 'users';
$user  = 0;
$now   = date('Y-m-d H:i:s');
$username   = mysqli_fetch_array(mysqli_query($conn,"SELECT username from ".$table." where username = '".$_POST['username']."'"));
$no_telp  	= mysqli_fetch_array(mysqli_query($conn,"SELECT no_telp from ".$table." where no_telp = '".$_POST['no_telp']."'"));
$email   	= mysqli_fetch_array(mysqli_query($conn,"SELECT email from ".$table." where email = '".$_POST['email']."'"));
if (!empty($username)||!empty($no_telp)||!empty($email)) {
	if (!empty($username)) {  
		$_SESSION['flash']['label']='Username telah digunakan';
	}elseif (!empty($no_telp)) {  
		$_SESSION['flash']['label']='Nomor Telpon telah digunakan';
	}elseif (!empty($email)) {  
		$_SESSION['flash']['label']='Email telah digunakan';
	}
	$_SESSION['flash']['class']='alert alert-danger';
	$_SESSION['flash']['icon']='fa fa-times';
	$_SESSION['flash']['credidential']=$_POST;
	header('Location: registration.php');
}else{
	$sql="INSERT INTO ".$table." (username,password,nama,no_telp,email,alamat,level,aktif,created_by,created_at,updated_by,updated_at) 
	VALUES ('".$_POST['username']."', '".md5($_POST['password'])."','".$_POST['nama']."','".$_POST['no_telp']."','".$_POST['email']."','".@$_POST['alamat']."','customer','Y','$user','$now','$user','$now')";
	$query = mysqli_query($conn,$sql);
	$_SESSION['flash']['class']='alert alert-success';
	$_SESSION['flash']['label']='Registrasi Berhasil, silakan masuk untuk melanjutkan';
	$_SESSION['flash']['icon']='fa fa-check';
	header('Location: index.php');
}