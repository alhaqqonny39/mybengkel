<?php 

  include 'layout/header.php';
  include 'config/app.php';

  if(isset($_POST['tambah'])){
    if(create_akun($_POST)>0){
      echo "<script>
            alert ('Data Akun Berhasil Ditambahkan');
            document.location.href = 'dataakun.php';
            </script>";

            }
            else{
      echo "<script>
            alert ('Data Akun Gagal Ditambahkan');
            document.location.href = 'dataakun.php';
            </script>";
    }
  }
  ?>
    <div class="container mt-5">
      <h1>Tambah Data Akun</h1>
    <hr>
    <form action="" method="post" id="tambahakun">
    <div class="mb -3">
            <label for="nama" class="form-label">Nama Akun</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Akun" required>
          </div>
          <div class="mb -3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
          </div>
          <div class="mb -3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
          </div>
          <div class="mb -3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required minlength="6">
          </div>
          <div class="mb -3">
            <label for="level" class="form-label">Level</label>  
                <select class="form-select" id="level" name="level">
                <option selected>Pilih salah satu</option>
                <option value="1">Operator Servis</option>
                <option value="2">Operator Sparepart</option>
                <option value="3">Operator Transaksi</option>
                <option value="3">Operator Akun</option>
                </select>
            </div>
        <input type="submit" class="btn btn-primary" style="float: right;" name="tambah">
        <button type="button" class="btn btn-danger" style="float: right;" onclick="clearForm()">Hapus</button>
        </form>
        <script>
           function clearForm() {
            document.getElementById("tambahbarang").reset();
             }
        </script>
    </div>   

<?php include 'layout/footer.php'; ?>