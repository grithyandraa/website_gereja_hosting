<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    //koneksi localhost
    // $con = new PDO("mysql:host=localhost;dbname=websitegereja", "root", "");

    //koneksi hosting
    $con = new PDO('mysql:host=localhost;dbname=u152600978_websitegereja', "u152600978_website_gereja", "G0dsGrace33");

    //set.eror
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    //jika.ada.eror
    echo "Koneksi Gagal : " . $e->getMessage() . "<br>";
    die();
}
