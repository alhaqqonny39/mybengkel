<?php

include 'config/app.php';

$idakun = (int)$_GET['idakun'];

if(delete_akun($idakun) > 0){
    echo "<script>
            alert('Data Akun berhasil dihapus');
            document.location.href = 'dataakun.php';
        </script>";
} else {
    echo "<script>
            alert('Data Akun gagal dihapus')
            document.location.href = 'dataakun.php';
        </script>";
}

?>
