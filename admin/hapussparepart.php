<?php

include 'config/app.php';

$idsparepart = $_GET['idsparepart'];

if(delete_sparepart($idsparepart) > 0){
    echo "<script>
            alert('Data Sparepart berhasil dihapus');
            document.location.href = 'datasparepart.php';
        </script>";
} else {
    echo "<script>
            alert('Data Sparepart gagal dihapus')
            document.location.href = 'datasparepart.php';
        </script>";
}

?>
