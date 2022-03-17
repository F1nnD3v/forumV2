<?php
include 'connect.php';
session_start();
$followId = $_GET['followId'];
$followerId = $_SESSION['userId'];

$sql = "SELECT id from `users` where id ='.$followId.'";
$result = mysqli_query($conn,$sql);

if(!$result){
    echo 'Something went wrong!';
}else{
    $sql = "INSERT INTO `seguidores`(pessoa,seguiu) values($followId, $followerId)";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo 'Something went wrong!';
    }
}
$lastLink = $_SERVER['HTTP_REFERER'];
header('Location: '. $lastLink);
?>