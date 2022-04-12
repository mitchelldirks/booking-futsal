<?php
include('config/koneksi.php');
$user = $_POST['username'];
$pass = md5($_POST['password']);
$sql = "SELECT * from users where password='$pass' and username='$user'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($query);
$row = mysqli_num_rows($query);
if ($row > 0) {
	if ($data['aktif']=='N') {
		$_SESSION['flash']['class']='alert alert-danger';
		$_SESSION['flash']['label']='Akun anda tidak aktif';
		$_SESSION['flash']['icon']='fa fa-ban';
		$_SESSION['flash']['username']=$_POST['username'];
		header('location: index.php');
		exit;
	}
	// else if ($data['is_approve']==null) {
	// 	$_SESSION['flash']['class']='alert alert-danger';
	// 	$_SESSION['flash']['label']='Akun anda belum dikonfirmasi, silakan hubungi admin';
	// 	$_SESSION['flash']['icon'] ='fa fa-ban';
	// 	$_SESSION['flash']['username']=$_POST['username'];
	// 	header('location: index.php');
	// 	exit;
	// }
	$_SESSION = $data;
	if (!empty($_POST["rememberme"])) {
		setcookie("username", $_POST['username']);
		setcookie("password", $_POST['password']);
	}
	if (strlen($_POST['redirect']) > 0) {
		header('location: '.$_POST['redirect']);
	}else{
		header('location: media.php');
	}
}
else {
	$_SESSION['flash']['class']='alert alert-danger';
	$_SESSION['flash']['label']='Username atau password salah';
	$_SESSION['flash']['icon']='fa fa-ban';
	$_SESSION['flash']['username']=$_POST['username'];
	header('location: index.php');
}
?>