<?php

ob_start("ob_gzhandler");
include('config.php');
error_reporting(0);
@ignore_user_abort(TRUE);
@set_magic_quotes_runtime(0);
session_start();
$u1=$_SESSION['username'];
$p1=$_SESSION['password'];
if(dalisam($u1, $p1) == 1) { 
$ulogovan = 1;
}
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset=utf-8>

	<title>Dumbpic - Account</title>

	<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="css/print.css" type="text/css" media="print">
        <link rel="stylesheet" href="css/theme.css" type="text/css" media="screen, projection">

        <!--[if lte IE 8]><script src="js/html5.js" type="text/javascript"></script><![endif]--> 
        <!--[if IE]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection"><![endif]-->

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/form.js"></script>
        <script type="text/javascript" src="js/corners.js"></script>
        <script type="text/javascript" src="js/jquery.jScale.js"></script>
        <script type="text/javascript">
	        DD_roundies.addRule('.span-14, fieldset, legend, input, textarea', '5px', true);
        </script>
  </head>
<body>

<div class="container">

<div class="span-14 push-5 last">

<header>
	
</header>
<nav class="nav">
   <ul>
      <li><a class="" href="index.php?s=top" title="Top pictures">Top</a></li>
      <li><a class="" href="index.php?s=recent" title="Recent pictures">Recent</a></li>
      <li><a class="" href="contact.php" title="Contact us">Contact</a></li>
<?php 
if($ulogovan == 1) { 
echo '<li><a class="" href="upload.php" title="Upload">Upload</a></li>';
echo '<li><a class="selected" href="acc.php" title="Change your info">Profile</a></li>';
echo '<li><a class="" href="logout.php" title="Logout">Logout</a></li>';
} else {
echo '<li><a class="" href="login.php" title="Login">Login</a></li>';
}
?>
   </ul>
</nav>
<section id="content">  
    <div style="display: block;" class="panels">    
      <div style="display: block; opacity: 1;" id="contact" class="panel">
<?php
switch($_GET['page']) {
default:
echo '<article>
<form action="/acc.php?page=save" method="post">
<fieldset>
<legend>Change mail</legend>
<p><label for=email accesskey=E>New e-mail:</label><input type="text" name="email"  /></p>
</fieldset>
<fieldset>
<legend>Change password</legend>
<p><label for=pass1 accesskey=P>New password:</label><input type="password" name="pass1"  /></p>
<p><label for=pass2 accesskey=A>New password (again):</label><input type="password" name="pass2"  /></p>
</fieldset>
<fieldset>
<legend>Current password</legend>
<p><label for=curpass accesskey=C>Current password:</label><input type="password" name="curpass"  /></p>
</fieldset>
<p><input type="submit" class="submit" name="submit" id="submit" value="Save" /></p>
</form></article>';
break;
case save:
echo '<article>';
if(empty($_POST['email']) && empty($_POST['pass1']) && empty($_POST['pass2']) && empty($_POST['curpass'])) {
echo '<div class="error"><h4 align="center" style="margin-bottom:0;">All fields were empty! Please try <a href="acc.php?page=change">again</a>!</h4></div>';
} else {
if(empty($_POST['email'])) {
} else {
$username = $_SESSION['username'];
$password = md5($_POST['curpass']);
$password1 = $_SESSION['password'];
$email = $_POST['email'];
if($password == $password1) {
if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
if(promenimail($username, $password1, $email) == 1) {
echo '<div class="success"><h4 align="center" style="margin-bottom:0;">Email changed successfully.</h4></div>';
} 
} else {
echo '<div class="error"><h4 align="center" style="margin-bottom:0;">Invalid email address! Please try <a href="acc.php?page=change">again</a>!</h4></div>';
}
} else {
echo '<div class="error"><h4 align="center" style="margin-bottom:0;">Wrong current password! Please try <a href="acc.php?page=change">again</a>!</h4></div>';
}
}
if(empty($_POST['pass1']) && empty($_POST['pass2'])) {
} else {
if($_POST['pass1'] == $_POST['pass2']) {
$username = $_SESSION['username'];
$password = md5($_POST['curpass']);
$password1 = $_SESSION['password'];
$newpass = md5($_POST['pass1']);
if($password == $password1) {
if(promenisifru($username, $password, $newpass) == 1) {
echo '<div class="success"><h4 align="center" style="margin-bottom:0;">Password changed successfully.</h4></div>';
}
} else {
echo '<div class="error"><h4 align="center" style="margin-bottom:0;">Wrong current password! Please try <a href="acc.php?page=change">again</a>!</h4></div>';
}
} else {
echo '<div class="error"><h4 align="center" style="margin-bottom:0;">Passwords don\'t match! Please try <a href="acc.php?page=change">again</a>!</h4></div>';
}
}
}
echo '</article>';
break;
case profile:
$strana=$_GET['strana']; 

$strana = stripslashes($strana);
$strana = mysql_real_escape_string($strana);
$po_stranici = 5;
if($strana == "1") {
$strana1 = $strana+1;
} else {
$strana1 = $strana;
}
if(!$strana) {
$str_1 = $strana*$po_stranici;
$str_2 = ($strana+1)*$po_stranici;
} else {
$str_1 = ($strana-1)*$po_stranici;
$str_2 = ($strana1-1)*$po_stranici;
}
$name = mysql_real_escape_string($_GET['name']);
echo "<article>";
echo "<h2 style=\"margin-bottom: 0;text-align:center;\">" . $name . "'s uploads</h2>";
echo "</article>";
$q = "SELECT * FROM images WHERE author='$name' LIMIT $str_1,$str_2";
$r = mysql_query($q);
if ( $r !== false && mysql_num_rows($r) > 0 ) {
while ( $a = mysql_fetch_assoc($r) ) {
$naziv = stripslashes($a['naziv']);
$autor = stripslashes($a['author']);
$url = stripslashes($a['url']);
echo "<article>";
echo "<h2 style=\"margin-bottom: 0;\"><a style=\"position: relative;\" href=\"image.php?id=".$a['id']."\">" . $naziv . "</a></h2>";
echo "<div style='margin-left: 430px;position: absolute;margin-top: -38px;'>";
echo "<button type='button' class='minimal' onclick='vote(" . $a['id'] . ", 1)' id='image_" . $a['id'] . "_likes'> +" . $a['lajk'] . " </button>";
echo "<button type='button' class='minimal' onclick='vote(" . $a['id'] . ", 2)' id='image_" . $a['id'] . "_dislikes'> -" . $a['dislike'] . " </button>";
echo "</div>";
echo "<h4>Posted by " . $autor . ", " . $a['date'] . "</h4>";
echo "<img src='" . $url . "' alt='" . $naziv . "' id='slika_".$a['id']."' onload='scale(".$a['id'].")' />";
echo "</article>";
}
$r1 = mysql_query("SELECT * FROM images WHERE author='$name'");
$broj_slika = mysql_num_rows($r1);
$po_stranici = 5;
$brojstrana = $broj_slika/$po_stranici;
if($broj_slika > 5) {
if($_GET['strana']) {
$str = $_GET['strana'];
} else {
$str = "1";
}
$brojstrana = ceil($brojstrana);
if($_GET['strana'] == "1") {
$pret = "1";
} else {
$pret = $_GET['strana']-1;
}
if($_GET['strana'] == $brojstrana) {
$sled = $brojstrana;
} else {
$sled = $_GET['strana']+1;
}
if(!isset($_GET['strana']) || empty($_GET['strana'])) {
$sled = "2";
$pret = "1";
} 
echo "<article><div class=\"strane\" style='text-align: center;'><a href='profile.$name.strana.$pret.html' class=\"minimal\"><</a>";
      for($i=1;$i<$brojstrana+1;$i++) {
      echo "<a href=\"profile.$name.strana.$i.html\" class=\"minimal\" title=\"$i\">$i</a>&nbsp;";
}
echo "<a href='profile.$name.strana.$sled.html' span class=\"minimal\">></a></div></article>";
} else { 
echo ""; 
}
}
mysql_close($connection);
break;
}
?>
        </article>
      </div>
    </div>
</section>
<footer>Copyright (c) DumbPic.com</footer>    
</div>
  
</div>
<!--/container-->

<script type="text/javascript">
function vote(id,glas) {
$.post("vote.php", { id: id, glas: glas }, function(data) {
if(data == 'success') {
vote_get(id, glas);
} else {
alert(data);
}
});
}
function vote_get(id,glas) {
$.post("vote.php", { id: id, glas: glas, ak: 1 }, function(data) {
if(glas == 1) {
        $('#image_'+id+'_likes').text('+'+data);
} else {
$('#image_'+id+'_dislikes').text('+'+data);
}
});
}
function scale(id) {
$('#slika_'+id+'').jScale({ls:'490px'})
}
</script>

</body></html>