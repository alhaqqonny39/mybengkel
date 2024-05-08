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

    if($_SESSION["level"] != 3) {
		echo "<script>
			alert('Anda harus login sebagai operator transaksi');
			document.location.href = 'index.php';
			</script>";
			exit;
        }



    //Pagination
	$stokDataPerHalaman = 3;
	$stokData = count(select("SELECT a.*, b.*, c.* FROM servisbengkel as a INNER JOIN transaksi as b ON a.idservice = b.idservice
                            INNER JOIN sparepart as c ON b.idsparepart = c.idsparepart"));
	$stokHalaman = ceil($stokData / $stokDataPerHalaman);
	$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
	$awalData = ($stokDataPerHalaman * $halamanAktif) - $stokDataPerHalaman;

	$data_transaksi = select("SELECT a.*, b.*, c.* FROM servisbengkel as a INNER JOIN transaksi as b ON a.idservice = b.idservice
                        INNER JOIN sparepart as c ON b.idsparepart = c.idsparepart ORDER BY idtransaksi 
                        DESC LIMIT $awalData, $stokDataPerHalaman");
?>
	<div class="container mt-5">
		<h1>Data Transaksi Bengkel TOP1 Lombok Motor</h1>
        <hr>
        <a href="tambahtransaksi.php" class="btn btn-primary mb-3">
          Tambah Transaksi
		</a>
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead class="text-center">
                    <th>No</th>
                    <th>Jenis Servis</th>
					<th>Nama Sparepart</th>
					<th>Jumlah Beli Sparepart</th>
					<th>Harga Servis</th>
					<th>Total Harga Sparepart</th>
                    <th>Total Pembayaran</th>
				</thead>
				<tbody>
					<?php
                        $no = $awalData + 1;
						foreach($data_transaksi as $data):
					?>
					<tr>
                        <td class="text-center"><?= $no++; ?></td>
						<td><?= $data['jenisservice']; ?></td>
						<td><?= $data['namasparepart']; ?></td>
						<td><?= $data['jumlahbelisparepart']; ?></td>
						<td>Rp. <?= number_format($data['hargaservice'],0,',','.'); ?></td>
						<td>Rp. <?= number_format($data['totalhargasparepart'],0,',','.'); ?></td>
                        <td>Rp. <?= number_format($data['totalpembayaran'],0,',','.'); ?></td>
					</tr>
					<?php
						endforeach;
					?>
				</tbody>
			</table>
            <div class="mt-2 justify-content-end d-flex">
			<nav aria-label="Page navigation example">
				<ul class="pagination">
					<?php if($halamanAktif > 1): ?>
						<li class="page-item">
							<a class="page-link" href="?halaman=<?= $halamanAktif-1 ?>">
							<span aria-hidden="true">&laquo;</span>
							<span aria-hidden="sr-only">Previous</span>
							</a>
						</li>
					<?php endif; ?>

					<?php for($i = 1; $i <= $stokHalaman; $i++): ?>
						<?php if($i == $halamanAktif): ?>
							<li class="page-item-active"><a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a></li>
						<?php else: ?>
							<li class="page-item"><a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a></li>
						<?php endif; ?>
					<?php endfor; ?>

					<?php if($halamanAktif < $stokHalaman): ?>
						<li class="page-item">
							<a class="page-link" href="?halaman=<?= $halamanAktif+1 ?>">
							<span aria-hidden="sr-only">Next</span>
							<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</nav>
		</div>
		</div>
	</div>


<?php include 'layout/footer.php'; ?>