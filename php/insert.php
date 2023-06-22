<?php
require "database.php";

$email = $_POST['email'];
$password = $_POST['password'];
$pwhash = password_hash($password, PASSWORD_DEFAULT);

$accounts = $conn->prepare("
insert into account values
(
id=1, :email, :pwhash
)
");
$accounts->execute([
    "email" => $email,
    "pwhash" => $pwhash
]);

include 'login.php';
echo "<script>alert('Uw account is geregistreerd! U kunt nu inloggen')</script>";
?>