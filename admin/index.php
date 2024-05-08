<?php
session_start();
//membatasi halaman sebelum login
if(!isset($_SESSION['login'])){
  echo"<script>
      alert('silakan login terlebih dahulu');
      document.location.href = 'login.php';
      </script>";
  exit;
}

include 'layout/header.php';
include 'config/app.php';

$stokDataPerhalaman = 5;
$stokData     = count(select("SELECT * FROM servisbengkel"));
$stokHalaman  = ceil($stokData / $stokDataPerhalaman);
$halamanAktif = (isset($_GET['halaman']) ? $_GET['halaman']:1);
$awalData = ($stokDataPerhalaman * $halamanAktif) - $stokDataPerhalaman;

$data_servis = select("SELECT * FROM servisbengkel ORDER BY idservice DESC LIMIT $awalData, $stokDataPerhalaman");

?>
 <div class="container mt-5">
      <h1>Data Service TOP1 Lombok Motor</h1>
    <hr>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>No.</th>
            <th>ID Servis</th>
            <th>Jenis Servis</th>
            <th>Harga Servis</th>
        </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          <?php foreach ($data_servis as $servis) : ?>
        <tr>
            <td><?=$no++; ?></td>
            <td><?=$servis['idservice'];?></td>
            <td><?=$servis['jenisservice'];?></td>
            <td>Rp. <?= $servis['hargaservice'];?> </td>

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





<?php include 'layout/footer.php'; ?>