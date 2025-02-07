<?php
    session_start();
    include_once "config.php";
    $connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( !$connection ) {
        echo mysqli_error( $connection );
        throw new Exception( "Database cannot Connect" );
    }
    if(isset($_GET['submit'])){
        $email = $_GET['email'];
        $password = $_GET['password'];
        $query = "SELECT * FROM account WHERE email='$email'";
        $result = mysqli_query( $connection, $query );
        $data = mysqli_fetch_assoc( $result);
        if($data){
            $_passsword = $data['password'] ?? '';
            $_email = $data['email'] ?? '';
            $_id = $data['id'] ?? '';
            $_role = $data['role'] ?? '';

            if($_email == $email && $_passsword == $password){
                $_SESSION['id'] = $_id;
                $_SESSION['role'] = $_role;
                header("location:index.php");
                die();
            }
            else{
                header("location:login.php?error");
            }
        }
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/icon/themify-icons/themify-icons.css">
    <title>Dashboard</title>
</head>

<body>

    <!--------------------------------- Main section -------------------------------->
    <section class="main">
        <div class="container">

            <div class="main__form">
                <div class="main__form--title text-center">Sign In</div>
                <div class="social-container">
                    <a href="https://www.facebook.com/profile.php?id=100053764159648" class="social"><i class="ti-facebook"></i></a>
                    <a href="#" class="social"><i class="ti-google"></i></a>
                    <a href="#" class="social"><i class="ti-linkedin"></i></a>
			    </div>
                <h4>or use your account</h4>
                <form action="login.php" method="GET">
                    <div class="form-row">
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-envelope left"></i>
                                <input type="text" name="email" placeholder="Email" required>
                            </label>
                        </div>
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-key"></i>
                                <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                <i id="pwd" class="fas fa-eye right"></i>
                            </label>
                        </div>
                        <input type="hidden" name="action" value="login">
                        <?php if ( isset( $_REQUEST['error'] ) ) {
                                echo "<h5 class='text-center' style='color:red;width: 100%;'>Email, Password Doesn't match Or Something is Wrong</h5>";
                            }?>
                        <div class="col col-12">
                            <input type="submit" name= "submit" value="Submit">
                        </div> 
                    </div>
                </form>    
            </div>
        </div>
    </section>

    <!--------------------------------- #Main section -------------------------------->



    <!-- Optional JavaScript -->
    <script></script>
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script src="./assets/js/app.js"></script>
</body>

</html>
