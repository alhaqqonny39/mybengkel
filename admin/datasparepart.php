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

  include 'layout/header.php';
  include 'config/app.php';

  if(isset($_POST['tambah'])){
    if(create_sp($_POST)>0){
      echo "<script>
            alert ('Data Sparepart Berhasil Ditambahkan');
            document.location.href = 'datasparepart.php';
            </script>";

            }
            else{
      echo "<script>
            alert ('Data Sparepart Gagal Ditambahkan');
            document.location.href = 'datasparepart.php';
            </script>";
    }
  }

//   //membatasi halaman sesuai user login
  if($_SESSION['level']!= 2){
    echo"<script>
        alert('Anda harus masuk sebagai admin akun');
        document.location.href = 'login.php';
        </script>";
    exit;
  }

//pagination
$stokDataPerhalaman = 5;
$stokData     = count(select("SELECT * FROM sparepart"));
$stokHalaman  = ceil($stokData / $stokDataPerhalaman);
$halamanAktif = (isset($_GET['halaman']) ? $_GET['halaman']:1);
$awalData = ($stokDataPerhalaman * $halamanAktif) - $stokDataPerhalaman;

$data_sp = select("SELECT * FROM sparepart ORDER BY idsparepart DESC LIMIT $awalData, $stokDataPerhalaman");

?>

    <div class="container mt-5">
      <h1>Data Sparepart Bengkel TOP1 Lombok Motor</h1>
        <hr>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modaltambah">
          Tambah Sparepart
          </button>
          <table class="table table-bordered table-striped table-hover">
           <thead>
             <tr>
            <th>No.</th>
            <th>ID Sparepart</th>
            <th>Nama Sparepart</th>
            <th>Harga Sparepart</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          <?php foreach ($data_sp as $sp) : ?>
        <tr>
            <td><?=$no++; ?></td>
            <td><?=$sp['idsparepart'];?></td>
            <td><?=$sp['namasparepart'];?></td>
            <td>Rp. <?=$sp['hargasparepart']?> </td>
            <td width="20%" class="text-center">
            <!-- <button type="button" class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#modalubah<?=$sp['idsparepart'];?>">Edit</button> -->
            <a href="ubahsparepart.php?idsparepart=<?=$sp['idsparepart'];?>" class="btn btn-warning">Edit</a>
            <a href="hapussparepart.php?idsparepart=<?=$sp['idsparepart'];?>" class="btn btn-danger">Hapus</a>
            </td>

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

<!-- Modal Tambah -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Sparepart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="tambahsparepart" enctype="multipart/form-data">
        <div class="mb -3">
            <label for="idsparepart" class="form-label">ID Sparepart</label>
            <input type="text" class="form-control" id="idsparepart" name="idsparepart" placeholder="ID Sparepart" required>
          </div>  
        <div class="mb -3">
            <label for="namasparepart" class="form-label">Nama Sparepart</label>
            <input type="text" class="form-control" id="namasparepart" name="namasparepart" placeholder="Nama Sparepart" required>
          </div>
          <div class="mb -3">
            <label for="hargasparepart" class="form-label">Harga Sparepart</label>
            <input type="number" class="form-control" id="hargasparepart" name="hargasparepart" placeholder="Harga Sparepart" required>
          </div>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>  