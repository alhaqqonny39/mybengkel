<?php

include 'config/app.php';

$idservice = $_GET['idservice'];

if(delete_servis($idservice) > 0){
    echo "<script>
            alert('Data Servis berhasil dihapus');
            document.location.href = 'dataservis.php';
        </script>";
} else {
    echo "<script>
            alert('Data Servis gagal dihapus')
            document.location.href = 'dataservis.php';
        </script>";
}

?>
