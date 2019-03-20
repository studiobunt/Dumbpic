<?php
$connection=mysql_connect("localhost", "sgquspgj_dumbpic", "d3funct1s");
mysql_select_db("sgquspgj_dumbpic", $connection) or die('Nije moguce konektovati se na bazu!');

function registruj($username, $password, $passworda, $email) {
if(proveri($username, $email) == 1) {
echo '<div class="error"><h4 align="center" style="margin-bottom:0;">Username or email is already in use!</h4></div>';
} else {
$username = mysql_real_escape_string($username);
$password = md5(mysql_real_escape_string($password));
$passworda = md5(mysql_real_escape_string($passworda));
$email = mysql_real_escape_string($email);
if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
if($password == $passworda) {
$sql = "INSERT INTO users VALUES('$id','$username','$password','$email')";
$a = mysql_query($sql);
return '<div class="success"><h4 align="center" style="margin-bottom:0;">Successfully registered.</h4></div>';
} else {
return '<div class="error"><h4 align="center" style="margin-bottom:0;">Passwords don\'t match.</h4></div>';
}
} else {
return '<div class="error"><h4 align="center" style="margin-bottom:0;">Invalid email address.</h4></div>';
}
}
}
function proveri($username, $email) {

$q = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$r = mysql_query($q);

$count1 = mysql_num_rows($r);
if($count1 == 1){
return 1;
} else {
return 0;
}
}
function proverilogin($username, $password) {
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$enpassword = md5($password);

$sql="SELECT * FROM users WHERE username='$username' and password='$enpassword'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);
if($count==1){
return 1;
} else {
return 0;
}
}
function dalisam($username, $password) {
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

$q = "SELECT * FROM users WHERE username='$username' and password='$password'";
$r = mysql_query($q);

$count1 = mysql_num_rows($r);
if($count1 == 1){
return 1;
} else {
return 0;
}
}
function promenimail($username, $password, $email) {
$username = $_SESSION['username'];
$password = mysql_real_escape_string($_POST['password']);
$email = mysql_real_escape_string($_POST['mail']);
if(empty($email)) {
echo "Email field was empty.";
} else {
echo "E-mail successfully changed.";
$q = "UPDATE users SET email='$email' WHERE username='$username' AND password='$password'";
$r = mysql_query($q);

}

if(!$r) {
return 0;
} else {
return 1;
}
}
function promenisifru($username, $password, $newpass) {
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$newpass = mysql_real_escape_string($newpass);
if(empty($newpass)) {
echo "Password field was empty.";
} else {


$q = "UPDATE users SET password='$newpass' WHERE username='$username' AND password='$password'";
$r = mysql_query($q);

}

if(!$r) {
return 0;
} else {
return 1;
}
}
?>