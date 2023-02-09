

<?php
session_start();
include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}
else{
    $action = $_REQUEST['action'] ?? '';
    if('updateProfile' == $action){
        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $phone = $_REQUEST['phone'] ?? '';
        $gender = $_REQUEST['gender'] ?? '';
        $newPassword = $_REQUEST['newPassword'] ?? '';
        $confirmPwd = $_REQUEST['confirmPassword'] ?? '';
        $oldPassword = $_REQUEST['oldPassword'] ?? '';
        $sessionId = $_SESSION['id'] ?? '';
        $sessionRole = $_SESSION['role'] ?? '';
        $avatar = $_FILES['avatar']['name'] ?? "";
        if($fname && $lname && $email && $phone && $gender &&$oldPassword){
            $query = "SELECT password FROM account WHERE id='$sessionId'";
            $result = mysqli_query( $connection, $query );
            if ( $data = mysqli_fetch_assoc( $result ) ) {
                $_password = $data['password'];
                if($newPassword == ''){
                    if ( $oldPassword == $_password ) {
                        $updateQuery = "UPDATE account SET fname='{$fname}', lname='{$lname}', email='{$email}', phone='{$phone}',gender='{$gender}' WHERE id='{$sessionId}'";
                        mysqli_query( $connection, $updateQuery );
                        header( "location:index.php?id=userProfile" );
                    }
                    else{
                        echo "Bạn nhập sai mật khẩu!";
                        header("location:index.php?id=userProfileEdit");           
                    }
                }
                else{
                    if($newPassword == $confirmPwd &&  $oldPassword == $_password){
                        $updateQuery = "UPDATE account SET fname='{$fname}', lname='{$lname}', email='{$email}', phone='{$phone}', password = '{$newPassword}',gender='{$gender}'WHERE id='{$sessionId}'";
                        mysqli_query( $connection, $updateQuery );
                        header( "location:index.php?id=userProfile" );
                    }
                    else{
                        echo "Bạn nhập sai mật khẩu!";
                        header("location:index.php?id=userProfileEdit");
                    }
                }  
            }
        }   
    }
}
?>