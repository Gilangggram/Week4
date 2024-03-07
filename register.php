<?php 
//koneksi  folder (file)
include'./connection.php';
//pengecekan  username & password menggunakan "isset"
if(isset ($_POST ['username'] ) && isset ($_POST ['password'] ) ){
    $username = $_POST ['username']; //variable tampungan username 
    $password = $_POST ['password'];//variable tampungan password

    $checkQuery = "SELECT * FROM user where user_name ='$username' ";//sql query 
    $result = mysqli_query($conn,$checkQuery); //"$result" menjalankan mysqli_query dan menjalankan sql query $checkQuery

    if(mysqli_num_rows($result) > 0){ //pengecekan sql row di dalam database "mysqli_num_rows" & pengecakan menggunakan parameter 
        //jika terdapat duplikat data maka tidak akan diproses
        echo "username alredy exists. please choose a different usernmae.";
    }else {
        //proses insert data jika tidak ada data yang duplikat
        $query = "INSERT INTO user (user_name, user_password) values ('$username','$password')"; 
        mysqli_query($conn, $query);
        echo"RECORD INSERTED SUCCESSFULY!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>test</h1>
    <form method="POST" action="register.php"> <!--cari tau action property -->
    <!-- input text -->
    <p>username</p>
    <input type="text" name="username" required >
    <!-- input password -->
    <p>password</p>
    <input type="password" name="password" required>
    <!-- button submit register -->
    <button type="submit">Register</button>
    </form>
</body>
</html>