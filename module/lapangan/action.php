<?php 
include '../../config/koneksi.php';
$user   = $_SESSION['id'];
$now    = date('Y-m-d H:i:s');
$table  = 'lapangan';
$module = $_GET['module'];
$act    = $_GET['act'];
if($act == 'create'){
    $sql="INSERT INTO ".$table." (nama,deskripsi,tipe,aktif,created_by,created_at,updated_by,updated_at)
    VALUES ('".$_POST['nama']."','".$_POST['deskripsi']."','".$_POST['tipe']."','1','$user','$now','$user','$now')";
    $query = mysqli_query($conn,$sql);
    $_SESSION['flash']['class']='alert alert-success';
    $_SESSION['flash']['label']='Penambahan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-check';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'edit'){
    $sql="UPDATE ".$table." SET 
    nama        = '".$_POST['nama']."',
    deskripsi   = '".$_POST['deskripsi']."',
    tipe        = '".$_POST['tipe']."',
    aktif       = '".$_POST['aktif']."',
    updated_by  = '$user',
    updated_at  = '$now'
    WHERE id = '".$_POST['id']."'";
    $query = mysqli_query($conn, $sql);
    $_SESSION['flash']['class']='alert alert-success';
    $_SESSION['flash']['label']='Pengubahan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-edit';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'cost'){
    $id = $_POST['id_lapangan'];
    for ($h=1; $h <= 7; $h++) { 
        for ($j=0; $j < 24; $j++) { 
            $cost = mysqli_num_rows(mysqli_query($conn,"SELECT price from lapangan_cost where id_lapangan = '$id' and hari = '$h' and jam = '$j'"));
            if ($cost>0) {
                $sql="UPDATE lapangan_cost SET 
                = '".$_POST['price'][$h][$j]."',
                updated_by  = '$user',
                updated_at  = '$now'
                WHERE 
                id_lapangan = '$id' and hari = '$h' and jam = '$j'
                ";
                $query = mysqli_query($conn, $sql);
            }else{
                if (strlen($_POST['price'][$h][$j])>0) {
                    $sql = "INSERT INTO lapangan_cost set 
                    id_lapangan  = '$id',
                    hari         = '$h',
                    jam          = '$j',
                    price        = '".$_POST['price'][$h][$j]."',
                    created_by   = '$user',
                    created_at   = '$now',
                    updated_by   = '$user',
                    updated_at   = '$now'
                    ";
                    $query = mysqli_query($conn, $sql);
                }
            }
        }
    }
    $_SESSION['flash']['class']='alert alert-success';
    $_SESSION['flash']['label']='Pengubahan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-edit';
    header('Location: ../../media.php?module='.$module.'&act=detail&id='.$id);
}else if($act == 'delete'){
    $query = mysqli_query($conn, "DELETE FROM ".$table." WHERE id = '".$_GET['id']."'");
    $_SESSION['flash']['class']='alert alert-danger';
    $_SESSION['flash']['label']='Penghapusan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-trash';
    header('Location: ../../media.php?module='.$module);
}
?>