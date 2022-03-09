<?php

// mengambil id_provinsi yg dikirim melalui method post sesuai yg diberi nama di ajax
$ekspedisi = $_POST['ekspedisiTerpilih'];
$distrik = $_POST['distrik'];
$berat = $_POST['berat'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=55&destination=".$distrik."&weight=".$berat."&courier=".$ekspedisi,
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    "key: 645956eb639146e26bf7b3ae6b15ab73"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;

  $array = json_decode($response,true);
  $ongkir = $array["rajaongkir"]["results"]["0"]["costs"];

  echo "<option value = ''>Pilih Paket Ongkir</option>";
  
  foreach ($ongkir as $key => $paketOngkir) {
    echo "<option
    paket = '".$paketOngkir["service"]."'
    ongkir = '".$paketOngkir["cost"]["0"]["value"]."'
    estimasi = '".$paketOngkir["cost"]["0"]["etd"]."'
    >";
    echo $paketOngkir["service"]." | ".number_format($paketOngkir["cost"]["0"]["value"])." | estimasi ".$paketOngkir["cost"]["0"]["etd"]." hari"; // menampilkan biaya & durasi pengiriman
    echo "</option>";
  }
}