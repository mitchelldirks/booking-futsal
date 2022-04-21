<?php 
include '../../config/koneksi.php';
$user   = $_SESSION['id'];
$now    = date('Y-m-d H:i:s');
$table  = 'transaksi';
$module = $_GET['module'];
$act    = $_GET['act'];
if($act == 'create'){
    $lapangan  = mysqli_fetch_array(mysqli_query($conn,"SELECT * from lapangan where id = '".$_POST['id_lapangan']."'"));
    $jam_mulai = $_POST['jam_mulai'];
    $durasi    = $_POST['durasi'];
    $json = json_decode($lapangan['json'],true);
    $price = 0;
    if ($jam_mulai>15) {
        $price = $json[24]*$durasi;
    }else{
        for ($i=$jam_mulai; $i < ($jam_mulai + $durasi); $i++) { 
            if ($i < 16) {
                $price += $json[15];
            }else{
                $price += $json[24];
            }   
        }
    }
    if (isset($_POST['id_customer'])) {
        $nama = mysqli_fetch_array(mysqli_query($conn,"SELECT nama from users where id = ".$_POST['id_customer']))['nama'];
    }else{
        $nama = $_POST['nama_customer'];
    }
    $kode_lapangan = 100+$_POST['id_lapangan'];
    $jam = $_POST['jam_mulai'] > 10 ? $_POST['jam_mulai'] : "0".$_POST['jam_mulai'];
    $jam = str_replace("00","0",$jam);
    $kode_transaksi = str_replace("-","",$_POST['tanggal']).''.$kode_lapangan.$jam.rand(100000,999999);
    $sql="INSERT INTO ".$table." (id_customer,kode_transaksi,id_lapangan,nama_customer,jam_mulai,durasi,harga,tanggal,status,created_by,created_at,updated_by,updated_at)
    VALUES ('".@$_POST['id_customer']."', '".$kode_transaksi."','".$_POST['id_lapangan']."','".$nama."','".$_POST['jam_mulai']."','".$_POST['durasi']."','".$price."','".$_POST['tanggal']."','1','$user','$now','$user','$now')";
    $query = mysqli_query($conn,$sql);
    if ($query) {
        $id = mysqli_insert_id($conn);
        for ($i=$jam_mulai; $i < ($jam_mulai + $durasi); $i++) { 
            $td = "INSERT INTO transaksi_detail set 
            id_transaksi    = $id, 
            id_lapangan     = '".$_POST['id_lapangan']."', 
            tanggal         = '".$_POST['tanggal']."', 
            jam             = '".$i."', 
            created_by      = '$user',
            created_at      = '$now'
            ";
            $query = mysqli_query($conn,$td);
        }
    }
    $_SESSION['flash']['class']='alert alert-success';
    $_SESSION['flash']['label']='Penambahan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-check';
    if ($_SESSION['level']=='customer') {
        header('Location: ../../media.php?module='.$module.'&act=detail&id='.$id);
    }else{
        header('Location: ../../media.php?module='.$module);
    }
}else if($act == 'delete'){
    $query = mysqli_query($conn, "DELETE FROM ".$table." WHERE id = '".$_GET['id']."'");
    $td = mysqli_query($conn,"DELETE from transaksi_detail where id_transaksi = '".$_GET['id']."'");
    $_SESSION['flash']['class']='alert alert-danger';
    $_SESSION['flash']['label']='Penghapusan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-trash';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'preview'){
    if ($_GET['id_lapangan']=='Pilih Lapangan') {
        $data = array(
            'response'      => '500',
            'title'         => 'Error not found',
            'msg'           => 'Pilih Lapangan terlebih dahulu',
        );
        echo json_encode($data);
        exit;
    }
    $lapangan  = mysqli_fetch_array(mysqli_query($conn,"SELECT * from lapangan where id = '".$_GET['id_lapangan']."'"));
    $jam_mulai = $_GET['jam_mulai'];
    $durasi    = $_GET['durasi'];
    $json = json_decode($lapangan['json'],true);
    $price = 0;
    $calc = $jam_mulai + $durasi - 16;
    if ($jam_mulai>15) {
        $price = $json[24]*$durasi;
    }else{
        for ($i=$jam_mulai; $i < ($jam_mulai + $durasi); $i++) { 
            if ($i < 16) {
                $price += $json[15];
            }else{
                $price += $json[24];
            }   
            $td = mysqli_fetch_array(mysqli_query($conn,"SELECT * from transaksi_detail where tanggal = '".$_GET['tanggal']."' and id_lapangan = '".$lapangan['id']."' and jam = '".$i."'"));
            if (!empty($td)) {
                $data = array(
                    'response'      => '500',
                    'title'         => 'Lapangan tidak tersedia',
                    'msg'           => $lapangan['nama'].' jam '.$i.'.00 tidak tersedia atau sudah dipesan',
                );
                echo json_encode($data);
                exit;
            }
        }
    }
    $data = array(
        'response'      => $price == 0 ? '500':'200',
        'nama_lapangan' => $lapangan['nama'],
        'durasi'        => $durasi,
        'harga'         => $price,
        'title'         => 'Pemesanan lapangan '.$lapangan['nama'],
        'msg'           => 'Total biaya sewa selama '.$durasi.' jam adalah <b>Rp. '.$price.'</b>',
    );
    echo json_encode($data);
}else if($act == 'slot'){
    $html="";
    $lapangan  = mysqli_query($conn,"SELECT * from lapangan order by nama");
    foreach ($lapangan as $l) {
        $html .= '<div class="col-md-12"><h3>'.$l['nama'].' ('.$l['tipe'].')</h3></div>';
        for ($h=6; $h <= 24; $h++) { 
            $td = mysqli_fetch_array(mysqli_query($conn,"SELECT * from transaksi_detail where tanggal = '".$_GET['tanggal']."' and id_lapangan = '".$l['id']."' and jam = '".$h."'"));
            if (!empty($td)) {
                $t = mysqli_fetch_array(mysqli_query($conn,"SELECT * from transaksi where id = $td[id_transaksi]"));
                $tooltip    = $t['nama_customer']." (".$t['durasi']." jam)";//." Rp. ".$t['harga'];
                $credit     = 'Sudah dipesan<br><b>Nama</b> '.$t['nama_customer'].'<br><b>Durasi</b> '.$t['durasi'].' jam ';
                $html       .= '<div class="col-md-2 col-xs-12 m-3 slot slot-danger" data-toggle="tooltip" data-placement="top" title="'.$tooltip.'"><b>'.$h.'.00</b><br><small>'.$credit.'</small></div>';
            }else{
                $html       .= '<div class="col-md-2 col-xs-12 m-3 slot slot-success"><b>'.$h.'.00</b><br><small>Tersedia</small></div>';
            }
        }
    }
    echo json_encode(array(
        'html'=>$html,
    ));
}
?>