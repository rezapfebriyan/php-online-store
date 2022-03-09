<?php

// mengambil id_provinsi yg dikirim melalui method post
$idProvinsiTerpilih = $_POST['id_provinsi'];
$curl = curl_init();

// URL menerima request id_provinsi, jadi distrik ditampilkan menurut provinsinya
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$idProvinsiTerpilih, 
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
  // jadikan ke array biar bisa dipakai menggunakan php
  $array = json_decode($response, true);
  $dataDistrik = $array["rajaongkir"]["results"];

  echo "<option value=''>Pilih Distrik</option>"; // judul optionnya

  foreach ($dataDistrik as $key => $distrik) {
    echo "<option value=''
    id_distrik = '".$distrik["city_id"]."'
    namaProvinsi = '".$distrik["province"]."'
    tipeDistrik = '".$distrik["type"]."'
    namaDistrik = '".$distrik["city_name"]."'
    kodePos = '".$distrik["postal_code"]."' 
    >";

    // tampilkan valuenya berdasarkan type + berdasarkan city_name = kota bandung dlsb.
    echo $distrik["type"]." ".$distrik["city_name"]; 
    echo "</option>";
  }

}