<?php 
    include 'layout/header.php';
    include 'config/app.php';
    
    if(isset($_POST['tambah'])) {
        if(create_trans($_POST) > 0) {
            echo "<script>
                    alert('Data transaksi berhasil ditambahkan');
                    document.location.href = 'datatransaksi.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Data transaksi gagal ditambahkan');
                    document.location.href = 'datatransaksi.php';
                  </script>";
        }
    }
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-dark">
            <h1>Tambah Data Transaksi TOP1 Lombok Motor</h1>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="id_s" class="form-label">ID Transaksi</label>
                    <input type="text" class="form-control border border-dark" id="id_t" name="idtransaksi" placeholder="Masukkan ID Transaksi..." required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Jenis Servis</label>
                    <select class="form-select border border-dark" name="idservice">
                        <option selected>- Pilih -</option>
                        <?php
                            $data = select("SELECT * FROM servisbengkel"); 
                            foreach($data as $k): ?>
                        <option value="<?= $k['idservice']; ?>"><?= $k['jenisservice']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Sparepart</label>
                    <select class="form-select border border-dark" name="idsparepart">
                        <option selected>- Pilih -</option>
                        <?php
                            $data = select("SELECT * FROM sparepart"); 
                            foreach($data as $sp): ?>
                        <option value="<?= $sp['idsparepart']; ?>"><?= $sp['namasparepart']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Jumlah Sparepart</label>
                    <input type="number" class="form-control border border-dark" id="jml" name="jumlahbelisparepart" placeholder="Masukkan Jumlah Sparepart..." required>
                </div>
                <div class="row">
                    <div class="col-2" style="float:right;">
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-arrow-left"></i></div>
                            <a href="databarang.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                    <div class="col"><input type="submit" class="btn btn-outline-dark" style="float:right; background-color:rgba(255, 99, 71, 0.5);" name="tambah"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'layout/footer.php'; ?>