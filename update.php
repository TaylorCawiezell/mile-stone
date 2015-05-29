<?php 
$id=$_POST['id'];
$fname=$_POST['fname']; 
$lname=$_POST['lname'];
$email=$_POST['email'];
$phone=$_POST['phone'];

if(isset($_POST['color'])){
    $color=$_POST['color']; 
    $query = "UPDATE user
              SET fname='".$fname."',lname='".$lname."',color='".$color."',email='".$email."',phone='".$phone."'
              WHERE id='".$id."';";
}else{
    $query = "UPDATE user
              SET fname='".$fname."',lname='".$lname."',email='".$email."',phone='".$phone."'
              WHERE id='".$id."';";
}


$user="root";
$pass="root";
$mysql = 'mysql:host=localhost;dbname=mile-stone;port=8889';
$dbh = new PDO($mysql, $user, $pass);
$stmt = $dbh->prepare($query);
$stmt->execute();
header("location: dashboard.php?id=".$id."");


?>