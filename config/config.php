<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    //koneksi..
    $con = new PDO('mysql:host=localhost;dbname=websitegereja', 'root', '');
    //set.eror
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    //jika.ada.eror
    echo "Koneksi Gagal : " . $e->getMessage() . "<br>";
    die();
}
