<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 645956eb639146e26bf7b3ae6b15ab73"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // ambil dlm bentuk json biar bisa dipakai menggunakan php
  $array = json_decode($response, true);
  $dataProvinsi = $array["rajaongkir"]["results"];

  // tampilkan request API nya
  echo "<option value=''>Pilih Provinsi</option>"; // judul optionnya

  foreach ($dataProvinsi as $key => $provinsi) {
    // ambil index array province, dan
    // buat atribut untuk ambil id_provinsi
    echo "<option value = '".$provinsi["province_id"]."' id_provinsi = '".$provinsi["province_id"]."' >";
    echo $provinsi["province"];
    echo "</option>";
  }
}
