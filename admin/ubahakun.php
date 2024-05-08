<?php 

  include 'layout/header.php';
  include 'config/app.php';

  $idakun = (int)$_GET['idakun'];
  //query data akun berdasarkan id
  $data_akun = select("SELECT * FROM akun WHERE idakun = $idakun")[0];

  //check apakah tombol ubah ditekan
  if(isset($_POST['ubah'])){
    if(update_akun($_POST)>0){
      echo "<script>
            alert ('Data Akun Berhasil Diubah');
            document.location.href = 'dataakun.php';
            </script>";

            }
            else{
      echo "<script>
            alert ('Data Akun Gagal Diubah');
            document.location.href = 'dataakun.php';
            </script>";
    }
  }
  ?>
    <div class="container mt-5">
      <h1>Ubah Data Akun</h1>
    <hr>
    <form action="" method="post">
        <input type="hidden" name="idakun" value="<?=$data_akun['idakun'];?>">
      <div class="mb -3">
        <label for="nama" class="form-label">Nama akun</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?=$data_akun['nama'];?>" placeholder="Nama akun" required>
      </div>
      <div class="mb -3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?=$data_akun['username'];?>" placeholder="Username" required>
      </div>
      <div class="mb -3">
        <label for="email" class="form-label">Email</label> 
        <input type="email" class="form-control" id="email" name="email" value="<?=$data_akun['email'];?>" placeholder="Email" required>               
      </div>
      <div class="mb -3">
        <label for="password" class="form-label">Password</label> 
        <input type="password" class="form-control" id="password" name="password" value="<?=$data_akun['password'];?>" placeholder="Password" required minlength="8">               
      </div>
      <div class="mb -3">
            <label for="level" class="form-label">Level</label>  
                <select class="form-select" id="level" name="level">
                <?php $level = $data_akun['level'];?>  
                <option value="1" <?= $level == '1' ? 'selected' : null?>>Operator Servis</option>
                <option value="2" <?= $level == '2' ? 'selected' : null?>>Operator Sparepart</option>
                <option value="3" <?= $level == '3' ? 'selected' : null?>>Operator Transaksi</option>
                <option value="4" <?= $level == '4' ? 'selected' : null?>>Operator Akun</option>
                </select>
            </div>   
        <button type="submit" class="btn btn-primary" style="float: right;" name="ubah">Ubah Data</button>
        </form>
    </div>   

<?php include 'layout/footer.php'; ?>