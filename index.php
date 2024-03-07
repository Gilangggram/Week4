<?php 
    session_start(); //Fungsi ini memulai session PHP. Session adalah mekanisme yang memungkinkan 
                    //server untuk menyimpan data pengguna selama periode waktu tertentu, 
                    //even ketika pengguna berpindah antar halaman.  atau untuk mempertahankan data pengguna saat pengguna berinteraksi dengan website.
    include('connection.php'); //Baris ini menginclude file connection.php ke dalam program. 

    if(isset($_SESSION['logged_in'])){ //$_SESSION (variable global session) mengecek apa logged_in memiliki nilai TRUE (1)
        header('location: welcome.php'); //header('location: index.php'); <- sebelum nya
        exit;
    }

    if(isset($_POST['login_btn'])){
        $email = $_POST['user_email']; //mengirin data user_email
        $password =$_POST['user_password']; //mengirim data user_password

        $query = "SELECT * FROM user WHERE user_email = ? AND user_password = ? LIMIT 1"; //sql query   "LIMIT 1 ":membatasi pengambilan data pada database hanya 1 baris 

        $stmt_login = $conn->prepare ($query); //menampung data user & "$stm_login"
        $stmt_login-> bind_param('ss',$email,$password);

            if($stmt_login -> execute()){ //
                $stmt_login-> bind_result(
                    $user_id,
                    $user_name,
                    $user_email,
                    $user_password,
                    $user_phone,
                    $user_address,
                    $user_city,
                    $user_photo
                );
                    $stmt_login->store_result();

                if($stmt_login -> num_rows() == 1){  //component 
                    $stmt_login -> fetch();

                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['user_email'] =$user_email;
                    $_SESSION['user_phone'] =$user_phone;
                    $_SESSION['user_address'] =$user_address;
                    $_SESSION['user_city'] =$user_city;
                    $_SESSION['user_photo']=$user_photo;
                    $_SESSION['logged_in']= true; //mengisi variable dengan nilai true

                    header('location: welcome.php?message=Logged in sucessfully'); 
                }else{
                    header('location: index.php?error=Cound not verify your account');
                }
            }else{
                header('location: index.php?error=Something went wrong');
            }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="wrapper"> <!-- 1 -->
        <div class="top">
            <img src="" alt="Logo">
            <h2>Selamat Datang</h2>
        </div>
    <form autocomplete="off" id="login-form" method="POST" action="index.php">
        <?php if(isset($_GET['error'])) ?> <!-- tambahkan { dan } -->
        <div role="alert">
        <?php if (isset($_GET['error'])) {
            echo $_GET['error']; //memunculkan teks 'error'
        } 
        
        ?>
    <div class="bottom">
        <div class="form">
            <input autocomplete="new-email" type="email" name="user_email" placeholder="Email ">
            <input autocomplete="new-password" type="password" name="user_password" placeholder="Password">
        </div>
        <div class="button-login">
            <!-- <button>button-login</button> -->
            <input type="submit" id="login-btn" name="login_btn" value="login">
            </div>
        </div>
    </div>
</form>

        <!-- 3 -->
        <div class="footer">
            <a href="Forgot Password">Forgot password</a>
            <a href="register.php">Dont have account</a>
        </div>
    </div>
</body>
</html>

<!-- post adalah method untuk mengirin data -->
<!-- get adalah method untuk mendapatkan data -->