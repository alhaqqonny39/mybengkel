<?php 

  include 'layout/header.php';
  include 'config/app.php';

  $idsparepart = $_GET['idsparepart'];
  //query data akun berdasarkan id
  $data_sp = select("SELECT * FROM sparepart WHERE idsparepart LIKE '$idsparepart'")[0];

  //check apakah tombol ubah ditekan
  if(isset($_POST['ubah'])){
    if(update_sp($_POST)>0){
      echo "<script>
            alert ('Data Sparepart Berhasil Diubah');
            document.location.href = 'datasparepart.php';
            </script>";

            }
            else{
      echo "<script>
            alert ('Data Sparepart Gagal Diubah');
            document.location.href = 'datasparepart.php';
            </script>";
    }
  }
  ?>
    <div class="container mt-5">
      <h1>Ubah Data Sparepart</h1>
    <hr>
    <form action="" method="post">
    <div class="mb -3">
        <label for="id" class="form-label">ID Sparepart</label>
        <input type="text" class="form-control" id="nama" name="idsparepart" value="<?=$data_sp['idsparepart'];?>" placeholder="ID Sparepart" required>
      </div>
        <div class="mb -3">
        <label for="nama" class="form-label">Nama Sparepart</label>
        <input type="text" class="form-control" id="nama" name="namasparepart" value="<?=$data_sp['namasparepart'];?>" placeholder="Nama Sparepart" required>
      </div>
      <div class="mb -3">
        <label for="sparepart" class="form-label">Harga Sparepart</label>
        <input type="number" class="form-control" id="harga" name="hargasparepart" value="<?=$data_sp['hargasparepart'];?>" placeholder="Harga Sparepart" required>
      </div>
        <button type="submit" class="btn btn-primary" style="float: right;" name="ubah">Ubah Data</button>
        </form>
    </div>   

<?php include 'layout/footer.php'; ?>