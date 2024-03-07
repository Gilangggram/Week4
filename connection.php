<?php 
$conn = mysqli_connect("localhost","root","","loginpage") or 
die ("can't connect to databases");
// "localhost" -> adalah nama host dari server database
// "root"-> Default nama pengguna (username) untuk mengakses database 
//"" -> Password untuk mengakses Database 
//"loginpage" -> adalah nama database yang akan di akses  oleh aplikasi
//die -> fungsi "die" untuk menghentikan eksekusi akses database dan akan menampilakn pesan beruka "string"
?>