<?php
session_start();
if(isset($_POST['login'])){
    include 'includes/dbh.inc.php';
    $uname = mysqli_real_escape_string($conn,$_POST['username']);
    $pwd = mysqli_real_escape_string($conn,$_POST['password']);
    $sql = "SELECT * FROM restaurants WHERE rest_username='$uname' and rest_password='$pwd'";
    $result = mysqli_query($conn,$sql);
    $resultcheck = mysqli_num_rows($result);
    if($resultcheck < 1){
        header("Location: Restaurant.php?login=nosuchusername");
        exit();
    }else{
        if($row = mysqli_fetch_assoc($result)){
            
                $sqlactivate = "SELECT * FROM restaurants WHERE rest_username='$uname'";
                $result = mysqli_query($conn,$sqlactivate);
                if($row = mysqli_fetch_assoc($result)){
                    $_SESSION['name'] = $row['rest_username'];
                    $_SESSION['password'] = $row['rest_password'];
                    header("Location: ManageRestaurant.php?login=success");
                    exit();
                }
            }
            else{
                header("Location: Restaurant.php?login=error");
                exit();
            }
        }
    }


