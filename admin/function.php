<?php

function rupiah($angka) {
    $rupiah = "Rp " . number_format($angka,0,',','.');
    return $rupiah;
}

// persiapan funct untuk upload file
function upload() {
    $namesFoto = $_FILES['foto']['name'];
    $locationsFoto = $_FILES['foto']['tmp_name'];

    // cek apakah yg diupload gambar / bukan
    // $eksfotovalid = ['jpg', 'jpeg', 'png'];
    // $eksfoto = explode('.', $namesFoto);
    // nama.jpg, maka yg diambil [yg terakhir yaitu:] jpg -nya
    // $eksfoto = strtolower(end($eksfoto));
    // kalo yg diupload ekstensinya beda dgn yg dideklarasikan diatas, maka
    // if(!in_array($eksfoto, $eksfotovalid)) {
    //     echo "<script>
    //             alert ('Yang anda upload bukan gambar');
    //           </script>";
    //     return false;
    // }
    // $namafotobaru = $namesFoto;
    // jika file lolos pengujian, maka upload
    // generate nama file baru
    // $namafotobaru = uniqid();
    // $namafotobaru .= '.';
    // $namafotobaru .= $eksfoto;

    // lalu pindahkan, dari locationFoto ke folder file dgn nama yg ada di $namafilebaru 
    move_uploaded_file($locationsFoto[0], "../img/" .$namesFoto[0]);
    return $namesFoto[0];
}

function upload_bukti() {
    $namaBukti = $_FILES['foto_bukti']['name'];
    $ukuran_foto_bukti = $_FILES['foto_bukti']['size'];
    $lokasi = $_FILES['foto_bukti']['tmp_name'];
    $nama_real = date('YmdHis').$namaBukti; // biar gak sama kayak user lain

    // cek jika ukuran file terlalu besar
    if($ukuran_foto_bukti > 500000) {
        echo "<script>
                alert ('Ukuran file terlalu besar...!');
              </script>";
        return false;
    }

    move_uploaded_file($lokasi, "struk/" .$nama_real);
    return $nama_real;
}

?>