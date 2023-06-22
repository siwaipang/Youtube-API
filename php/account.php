<?php

require "database.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * from account";

$accounts = $conn->prepare($sql);
$accounts->execute();

foreach ($accounts as $account) {
    if ($email == $account["email"]) {
        if (password_verify($password, $account["password"])) {
            header("location: ../home.html");
        } else {
            include 'login.php';
            echo "<script>alert('Uw email en/of wachtwoord is fout! Probeer het opnieuw')</script>";
            break;
        }
    } else {
        include 'login.php';
        echo "<script>alert('Uw email en/of wachtwoord is fout! Probeer het opnieuw')</script>";
        break;
    }
}