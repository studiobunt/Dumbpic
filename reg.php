<?php
include('config.php');
$username = $_POST['username'];
$password = $_POST['password'];
$passworda = $_POST['passworda'];
$email = $_POST['email'];
echo registruj($username, $password, $passworda, $email);
mysql_close($connection);
?>