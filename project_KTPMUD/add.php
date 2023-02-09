<?php
session_start();
include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
} else {
    $action = $_REQUEST['action'] ?? '';

    if ( 'addDepartment' == $action ) {
        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $birthday = $_REQUEST['birthday'] ?? '';
        $address = $_REQUEST['address'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $department = $_REQUEST['department'] ?? '';
        $password = $_REQUEST['password'] ?? '';
        $gender = $_REQUEST['gender'] ?? '';
        $salary = $_REQUEST['salary']??'';

        if ( $fname && $lname && $birthday && $address && $email && $department && $password && $gender && $salary ) {
            $query = "INSERT INTO account(fname,lname,birthday,address,email,phone,department,role,password,gender,salary) VALUES 
            ('{$fname}','$lname','$birthday','$address','$email','0123456789','$department',1,'$password','$gender','$salary')";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=allDepartment" );
        }
    } elseif ( 'updateDepartment' == $action ) {
        $id = $_REQUEST['id'] ?? '';
        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $birthday = $_REQUEST['birthday'] ?? '';
        $address = $_REQUEST['address'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $department = $_REQUEST['department'] ?? '';
        $gender = $_REQUEST['gender'] ?? '';
        $salary = $_REQUEST['salary']??'';

        if ( $fname && $lname && $birthday && $address && $email && $department && $password && $gender && $salary ) {
            $query = "UPDATE account SET fname='{$fname}', lname='{$lname}',birthday = '$birthday',address = '$address', email='$email',department='$department',gender = '$gender',salary='$salary' WHERE id='{$id}'";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=allDepartment" );
        }
    } elseif ( 'addStaff' == $action ) {
        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $phone = $_REQUEST['phone'] ?? '';
        $department = $_REQUEST['department'] ?? '';
        $password = $_REQUEST['password'] ?? '';
        $gender = $_REQUEST['gender'] ?? '';

        if ( $fname && $lname && $email && $phone && $department && $password && $gender ) {
            $query = "INSERT INTO account(fname,lname,email,phone,department,role,password,gender) VALUES 
            ('{$fname}','$lname','$email','$phone','$department',2,'$password','$gender')";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=allStaff" );
        }
    } elseif ( 'updateStaff' == $action ) {
        $id = $_REQUEST['id'] ?? '';
        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $phone = $_REQUEST['phone'] ?? '';
        $department = $_REQUEST['department'] ?? '';
        $gender = $_REQUEST['gender'] ?? '';

        if ( $fname && $lname && $email && $phone && $department && $gender ) {
            $query = "UPDATE account SET fname='{$fname}', lname='{$lname}', email='$email', phone='$phone',department='$department',gender = '$gender' WHERE id='{$id}'";
            mysqli_query( $connection, $query );
            header( "location:index.php?id=allStaff" );
        }

    } elseif ( 'updateProfile' == $action ) {
        
        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $phone = $_REQUEST['phone'] ?? '';
        $gender = $_REQUEST['gender'] ?? '';
        $oldPassword = $_REQUEST['oldPassword'] ?? '';
        $newPassword = $_REQUEST['newPassword'] ?? '';
        $sessionId = $_SESSION['id'] ?? '';
        $sessionRole = $_SESSION['role'] ?? '';
        $avatar = $_FILES['avatar']['name'] ?? "";

        if ( $fname && $lname && $email && $phone && $gender && $oldPassword && $newPassword ) {
            $query = "SELECT password,avatar FROM account WHERE id='$sessionId'";
            $result = mysqli_query( $connection, $query );

            if ( $data = mysqli_fetch_assoc( $result ) ) {
                $_password = $data['password'];
                $_avatar = $data['avatar'];
                $avatarName = '';
                if ( $_FILES['avatar']['name'] !== "" ) {
                    $allowType = array(
                        'image/png',
                        'image/jpg',
                        'image/jpeg'
                    );
                    if ( in_array( $_FILES['avatar']['type'], $allowType ) !== false ) {
                        $avatarName = $_FILES['avatar']['name'];
                        $avatarTmpName = $_FILES['avatar']['tmp_name'];
                        move_uploaded_file( $avatarTmpName, "assets/img/$avatar" );
                    } else {
                        header( "location:index.php?id=userProfileEdit&avatarError" );
                        return;
                    }
                } else {
                    $avatarName = $_avatar;
                }
                if ( $oldPassword == $_password ) {
                    $updateQuery = "UPDATE account SET fname='{$fname}', lname='{$lname}', email='{$email}', phone='{$phone}',gender='{$gender}', password='{$_password}', avatar='{$avatarName}' WHERE id='{$sessionId}'";
                    mysqli_query( $connection, $updateQuery );

                    header( "location:index.php?id=userProfile" );
                }

            }

        } else {
            echo mysqli_error( $connection );
        }

    }

}
