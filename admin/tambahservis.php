<?php 

  include 'layout/header.php';
  include 'config/app.php';

  if(isset($_POST['tambah'])){
    if(create_servis($_POST)>0){
      echo "<script>
            alert ('Data Servis Berhasil Ditambahkan');
            document.location.href = 'dataservis.php';
            </script>";

            }
            else{
      echo "<script>
            alert ('Data Servis Gagal Ditambahkan');
            document.location.href = 'dataservis.php';
            </script>";
    }
  }
  ?>
    <div class="container mt-5">
      <h1>Tambah Data Servis</h1>
    <hr>
    <form action="" method="post" id="tambahservis">
    <div class="mb -3">
            <label for="idservice" class="form-label">ID Service</label>
            <input type="text" class="form-control" id="idservice" name="idservice" placeholder="ID Service" required>
          </div>
          <div class="mb -3">
            <label for="jenisservice" class="form-label">Jenis Service</label>
            <input type="text" class="form-control" id="jenisservice" name="jenisservice" placeholder="Jenis Service" required>
          </div>
          <div class="mb -3">
            <label for="hargaservice" class="form-label">Harga Service</label>
            <input type="number" class="form-control" id="hargaservice" name="hargaservice" placeholder="Harga Service" required>
          </div>
        <input type="submit" class="btn btn-primary" style="float: right;" name="tambah">
        <button type="button" class="btn btn-danger" style="float: right;" onclick="clearForm()">Hapus</button>
        </form>
        <script>
           function clearForm() {
            document.getElementById("tambahservis").reset();
             }
        </script>
    </div>   

<?php include 'layout/footer.php'; ?>