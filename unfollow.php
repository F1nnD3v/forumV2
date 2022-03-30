<?php
include 'connect.php';
session_start();
$unfollowId = $_GET['unfollowId'];
$userId = $_SESSION['userId'];

$sql = "SELECT id from `users` where id ='.$unfollowId.'";
$result = mysqli_query($conn,$sql);

if(!$result){
    echo 'Something went wrong!';
}else{
    $sql = "SELECT * FROM seguidores WHERE pessoa = '$userId' AND seguiu = '$unfollowId'";
    $result = mysqli_query($conn,$sql);
    if(!$result){
        echo 'Something went wrong!';
    }else{
        $sql = "DELETE FROM `seguidores` WHERE seguidores.pessoa = '$userId' AND seguidores.seguiu = '$unfollowId'";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo 'Something went wrong!';
        }
    }
    //check if the user is following the user
    $sql = "SELECT * FROM seguidores WHERE pessoa = '$unfollowId' AND seguiu = '$userId'";
    $result = mysqli_query($conn,$sql);
    if(!$result){
        echo 'Something went wrong!';
    }else{
        $sql = "DELETE FROM `seguidores` WHERE seguidores.pessoa = '$unfollowId' AND seguidores.seguiu = '$userId'";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo 'Something went wrong!';
        }
    }
}
$lastLink = $_SERVER['HTTP_REFERER'];
header('Location: '. $lastLink);
?>