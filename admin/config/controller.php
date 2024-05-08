<?php 

  include 'database.php';
  
//Fungsi untuk menampilkan (hanya read)
function select($query)
  {
    global $db;

    $result = mysqli_query($db, $query);
    $rows =[];

    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
    
  }


//fungsi untuk tambah servis
  function create_servis($post){
    global $db;

    $idservice = strip_tags($post['idservice']);
    $jenis = strip_tags($post['jenisservice']);
    $harga = strip_tags($post['hargaservice']);

    //query tambah data
    $query = "INSERT INTO servisbengkel VALUES ('$idservice','$jenis','$harga')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
  }

  //fungsi untuk tambah akun
  function create_akun($post){

    global $db;
    
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email = strip_tags($post['email']);
    $password1 = strip_tags($post['password']);
    $level = strip_tags($post['level']);
    
    //enkripsi password
    $password = password_hash($password1, PASSWORD_DEFAULT);

    //query tambah data
    $query = "INSERT INTO akun VALUES (null,'$nama','$username','$email','$password','$level')";
    mysqli_query($db, $query);
    
    return mysqli_affected_rows($db);
    }

  //fungsi untuk tambah spareparts
  function create_sp($post){
    global $db;

    $idsparepart = strip_tags($post['idsparepart']);
    $namasparepart = strip_tags($post['namasparepart']);
    $hargasparepart = strip_tags($post['hargasparepart']);

    //query tambah data
    $query = "INSERT INTO sparepart VALUES ('$idsparepart','$namasparepart','$hargasparepart')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
  }
  

  //fungsi hapus servis
  function delete_servis($idservice){
    global $db;

    //query hapus data
    $query = "DELETE FROM servisbengkel WHERE idservice LIKE '$idservice'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
  }

  //fungsi hapus sparepart
  function delete_sparepart($idsparepart){
    global $db;

    //query hapus data
    $query = "DELETE FROM sparepart WHERE idsparepart LIKE '$idsparepart'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
  }

  //fungsi hapus transaksi
  function delete_trans($idtransaksi){
    global $db;

    //query hapus data
    $query = "DELETE FROM transaksi WHERE idtransaksi LIKE '$idtransaksi'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
  }

  //fungsi hapus akun
  function delete_akun($idakun){
    global $db;

    //query hapus data
    $query = "DELETE FROM akun WHERE idakun=$idakun";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
  }


//fungsi ubah akun
function update_akun($post){
  global $db;
  
  $idakun = $post['idakun'];
  $nama = $post['nama'];
  $username = $post['username'];
  $email = $post['email'];
  $password2 = $post['password'];
  $level = $post['level'];

  //enkripsi password
  $password = password_hash($password2, PASSWORD_DEFAULT);

//query ubah data
$query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email' , password = '$password', level = $level WHERE idakun = $idakun";
mysqli_query($db, $query);

return mysqli_affected_rows($db);
}

  //Fungsi ubah data servis
  function update_servis($post){
    global $db;
    
    $idservice = $post['idservice'];
    $jenisservice = $post['jenisservice'];
    $hargaservice = $post['hargaservice'];

  //query ubah data
  $query = "UPDATE servisbengkel SET jenisservice = '$jenisservice', hargaservice = '$hargaservice' WHERE idservice LIKE '$idservice'";
  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
  }

  //Fungsi ubah data sparepart
  function update_sp($post){
    global $db;
    
    $idsparepart = $post['idsparepart'];
    $namasparepart = $post['namasparepart'];
    $hargasparepart = $post['hargasparepart'];

  //query ubah data
  $query = "UPDATE sparepart SET namasparepart = '$namasparepart', hargasparepart = '$hargasparepart' WHERE idsparepart LIKE '$idsparepart'";
  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
  }

    // fungsi menambahkan transaksi (create)
  function create_trans($post)
  {
    global $db;
    // var_dump($post);

    $idtransaksi = strip_tags($post['idtransaksi']);
    $idservice = strip_tags($post['idservice']);
    $idsparepart = strip_tags($post['idsparepart']);
    $jumlahbelisparepart = strip_tags($post['jumlahbelisparepart']);
    $hargasparepart = select("SELECT * FROM sparepart WHERE idsparepart = '$idsparepart'")[0];
    $hargaservice = select("SELECT * FROM servisbengkel WHERE idservice = '$idservice'")[0];

    $totalhargasparepart = $jumlahbelisparepart * $hargasparepart['hargasparepart'];
    $totalpembayaran = $hargaservice['hargaservice'] + $totalhargasparepart;

    // qquery tambah data
    $query = "INSERT INTO transaksi VALUES('$idtransaksi', '$idservice', '$idsparepart','$jumlahbelisparepart','$totalhargasparepart','$totalpembayaran')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
  }
?>