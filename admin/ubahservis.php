<?php 

  include 'layout/header.php';
  include 'config/app.php';

  $idservice = $_GET['idservice'];
  //query data servis berdasarkan id
  $data_servis = select("SELECT * FROM servisbengkel WHERE idservice LIKE '$idservice'")[0];


  //cek apakah tombol submit sudah ditekan atau belum
  if(isset($_POST['ubah'])){
    if(update_servis($_POST)>0){
      echo "<script>
            alert ('Data Servis Berhasil Diubah');
            document.location.href = 'dataservis.php';
            </script>";

            }
            else{
      echo "<script>
            alert ('Data Servis Gagal Diubah');
            document.location.href = 'dataservis.php';
            </script>";
    }
  }
  ?>
    <div class="container mt-5">
      <h1>Ubah Data Servis</h1>
    <hr>
    <form action="" method="post">
    <input type="hidden" name="idservice" value="<?=$data_servis['idservice'];?>">
          <div class="mb -3">
            <label for="jenisservice" class="form-label">Jenis Service</label>
            <input type="text" class="form-control" id="jenisservice" name="jenisservice" value="<?=$data_servis['jenisservice'];?>" placeholder="Jenis Service" required>
          </div>
          <div class="mb -3">
            <label for="hargaservice" class="form-label">Harga Service</label>
            <input type="number" class="form-control" id="hargaservice" name="hargaservice" value="<?=$data_servis['hargaservice'];?>" placeholder="Harga Service" required>
          </div>
        <input type="submit" class="btn btn-primary" style="float: right;" name="ubah">
        <button type="button" class="btn btn-danger" style="float: right;" onclick="clearForm()">Hapus</button>
        </form>
        <script>
           function clearForm() {
            document.getElementById("ubahservis").reset();
             }
        </script>
    </div>   

<?php include 'layout/footer.php'; ?>