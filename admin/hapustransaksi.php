<?php

include 'config/app.php';

$idtransaksi = $_GET['idtransaksi'];

if(delete_trans($idtransaksi) > 0){
    echo "<script>
            alert('Data Transaksi berhasil dihapus');
            document.location.href = 'datatransaksi.php';
        </script>";
} else {
    echo "<script>
            alert('Data Transaksi gagal dihapus')
            document.location.href = 'datatransaksi.php';
        </script>";
}

?>
