<?php
ob_start("ob_gzhandler");
include('config.php');
error_reporting(E_ALL);
@ignore_user_abort(TRUE);
@set_magic_quotes_runtime(0);
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset=utf-8>

	<title>Dumbpic - Login</title>

	<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="css/print.css" type="text/css" media="print">
        <link rel="stylesheet" href="css/theme.css" type="text/css" media="screen, projection">

        <!--[if lte IE 8]><script src="js/html5.js" type="text/javascript"></script><![endif]--> 
        <!--[if IE]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection"><![endif]-->

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/form.js"></script>
        <script type="text/javascript" src="js/corners.js"></script>
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
      <li><a class="selected" href="login.php" title="Login">Login</a></li>
   </ul>
</nav>
<section id="content">  
    <div style="display: block;" class="panels">    
      <div style="display: block; opacity: 1;" id="login" class="panel">
<article>
<?php
$u1=$_SESSION['username'];
$p1=$_SESSION['password'];
if(dalisam($u1, $p1) == 1) { 
echo "<script>";
echo " self.location='index.php';";
echo "</script>";
}
switch($_GET['s']) {
case login:
$username = $_POST['username'];
$password = $_POST['password'];
if(proverilogin($username, $password) == 1) {
$_SESSION['username']= $username;
$_SESSION['password']= md5($password);
echo "<script>self.location='index.php';</script>";
}
else {
echo '
<div class="error">
<h4 align="center" style="margin-bottom:0;">Wrong username or password!</h4></div><br />
<fieldset>
<legend>Please fill in your login details</legend>
<form action="/login.php?s=login" method="post">
<p><label for=username accesskey=U>Username:</label><input type="text" name="username"  /></p>
<p><label for=password accesskey=P>Password:</label><input type="password" name="password"  /></p>
<p><input type="submit" class="submit" name="submit" id="submit" value="Login" /></p>
</form>
</fieldset>
';
}
break;
default:
echo '
<div class="notice">
<h4 align="center" style="margin-bottom:0;">Don\'t have an account? <a href="register.php">Register Here!</a></h4></div><br />
<fieldset>
<legend>Please fill in your login details</legend>
<form action="/login.php?s=login" method="post">
<p><label for=username accesskey=U>Username:</label><input type="text" name="username"  /></p>
<p><label for=password accesskey=P>Password:</label><input type="password" name="password"  /></p>
<p><input type="submit" class="submit" name="submit" id="submit" value="Login" /></p>
</form>
</fieldset>
';
break;
}
mysql_close($connection);
?>
</article>
      </div>
    </div>
</section>
<footer>Copyright (c) DumbPic.com</footer>    
</div>
  
</div>
<!--/container-->

</body></html>