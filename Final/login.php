<?php
session_start();
if(isset($_POST['login'])){
    include 'includes/dbh.inc.php';
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pwd = mysqli_real_escape_string($conn,$_POST['password']);
    $sql = "SELECT * FROM administrator WHERE email='$email' and password='$pwd'";
    $result = mysqli_query($conn,$sql);
    $resultcheck = mysqli_num_rows($result);
    if($resultcheck < 1){
        header("Location: administrator.php?login=nosuchemail");
        exit();
    }else{
        if($row = mysqli_fetch_assoc($result)){
            
                $sqlactivate = "SELECT * FROM administrator WHERE email='$email'";
                $result = mysqli_query($conn,$sqlactivate);
                if($row = mysqli_fetch_assoc($result)){
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    header("Location: RestaurantDetails.php?login=success");
                    exit();
                }
            }
            else{
                header("Location: administrator.php?login=error");
                exit();
            }
        }
    }


