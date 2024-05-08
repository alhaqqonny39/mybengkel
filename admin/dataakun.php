<?php
   session_start();
//    //membatasi halaman sebelum login
   if(!isset($_SESSION['login'])){
     echo"<script>
         alert('silakan login terlebih dahulu');
         document.location.href = 'login.php';
         </script>";
     exit;
   }
 
//    //membatasi halaman sesuai user login
   if($_SESSION['level']!= 4){
    echo"<script>
        alert('Anda harus masuk sebagai operator akun');
        document.location.href = 'login.php';
        </script>";
    exit;
  }

  include 'layout/header.php';
  include 'config/app.php';
  //query tampil data dengan pagination
$stokDataPerhalaman = 5;
$stokData     = count(select("SELECT * FROM akun"));
$stokHalaman  = ceil($stokData / $stokDataPerhalaman);
$halamanAktif = (isset($_GET['halaman']) ? $_GET['halaman']:1);
$awalData = ($stokDataPerhalaman * $halamanAktif) - $stokDataPerhalaman;

$data_akun = select("SELECT * FROM akun ORDER BY idakun DESC LIMIT $awalData, $stokDataPerhalaman");
?>

     <div class="container mt-5">
      <h1>Data Akun</h1>
    <hr>
    <a href="tambahakun.php" class="btn btn-primary mb-3"><i class="fas fa-plus-circle"></i>Tambah Siswa</a>
      <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>No.</th>
            <th>ID Akun</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          <?php foreach ($data_akun as $akun) : ?>
        <tr>
            <td><?=$no++; ?></td>
            <td><?=$akun['idakun'];?></td>
            <td><?=$akun['nama'];?></td>
            <td><?=$akun['username'];?></td>
            <td><?=$akun['email'];?></td>
            <td><?=$akun['password'];?></td>
            <td><?=$akun['level'];?></td>
            <td width="30%" class="text-center">
            <!-- <a href="detailakun.php?idakun=<?=$akun['idakun'];?>" type="button" class="btn btn-info mb-2">Detail</a>   -->
            <a href="ubahakun.php?idakun=<?=$akun['idakun'];?>" type="button" class="btn btn-primary mb-2">Edit</a>
            <a href="hapusakun.php?idakun=<?=$akun['idakun'];?>" class="btn btn-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data akun ini?')">Hapus</a>
        </tr>
      
        <?php endforeach; ?>
        </tbody>
      </table>
      <div class="mt-2 justify-content-end d-flex">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php if ($halamanAktif > 1) : ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $stokHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
              <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php else : ?>
              <li class="page-item "><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php endif; ?>
          <?php endfor; ?>

          <?php if ($halamanAktif < $stokHalaman) : ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
      </div>
    </div>        
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>