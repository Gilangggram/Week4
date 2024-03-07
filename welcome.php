<?php 
    session_start();
    include('connection.php');

    if(!isset($_SESSION['logged_in'])){ // cari tau kode program berikut kenapa pada bagian "isset" memiliki tanga seru "!" 
        header('location: index.php');
        exit;
    }
    
    if(isset($_GET['logout'])){
        if(isset($_SESSION['logged_in'])){
            unset($_SESSION['logged_in']);
            unset($_SESSION['user_email']);
            header('location: index.php');
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>
    <link rel="icon" href="assets/mt.jpg" width="120%" height="120%">
</head>
<body> <!-- caro penjelasan soal program body ini -->
    selamat datang 
    <?php echo $_SESSION['user_name']?> <br>
    <a href="welcome.php?logout=1" id="logout-btn"> 
    <button>    
        logout
    </button>
    </a>
</body>
</html>

<!--pada property id,nama nya harus berbeda dengan botton -->
<!--untuk setiap button harus berbeda dengan property nya -->
<!--<- nama tidak boleh sama dengan property id (case sensitif) -->