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

	<title>Dumbpic - Upload</title>

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
<?php 
if($ulogovan == 1) { 
echo '<li><a class="selected" href="upload.php" title="Upload">Upload</a></li>';
echo '<li><a class="" href="acc.php" title="Profile">Profile</a></li>';
echo '<li><a class="" href="logout.php" title="Logout">Logout</a></li>';
} else {
echo '<li><a class="" href="login.php" title="Login">Login</a></li>';
}
?>
   </ul>
</nav>
<section id="content">
    <div style="display: block;" class="panels">
      <div style="display: block; opacity: 1;" id="top" class="panel">
<article>
<?php
if($ulogovan == 1) {
switch($_GET['s']) {
case upload:
if ((($_FILES["slika"]["type"] == "image/gif")
|| ($_FILES["slika"]["type"] == "image/jpeg")
|| ($_FILES["slika"]["type"] == "image/pjpeg")
|| ($_FILES["slika"]["type"] == "image/png"))
&& ($_FILES["slika"]["size"] < 2000000))
  {
  if ($_FILES["slika"]["error"] > 0) {
echo '<div class="error"><h4 align="center" style="margin-bottom:0;">An error had occurred.</h4></div>';
  }
  else
  {
$naziv = $_POST["name"];
move_uploaded_file($_FILES["slika"]["tmp_name"],"upload/" . $_FILES["slika"]["name"]);
$url="upload/" . $_FILES["slika"]["name"];
$datum = date("d-m-Y");
$upis = "INSERT INTO images(naziv,url,author,date) values('$naziv','$url','$u1','$datum')";
mysql_query($upis) or die ('<div class="error"><h4 align="center" style="margin-bottom:0;">An error had occurred.</h4></div>');
echo '<div class="success"><h4 align="center" style="margin-bottom:0;">The image has been successfully uploaded.</h4></div>';
  }
}
else
  {
  echo '<div class="error"><h4 align="center" style="margin-bottom:0;">Image is either too large or not supported.</h4></div>';
  }
break;
default:
echo '
<fieldset>
<form action="/upload.php?s=upload" method="post" enctype="multipart/form-data">
<p><label for=username accesskey=N>Image name:</label><input type="text" name="name"  /></p>
<p><input type="file" name="slika" id="file" /> </p>
<p><input type="submit" class="submit" name="submit" id="submit" value="Upload" /></p>
</form>
</fieldset>
';
break;
}
} else {
  echo '<div class="error"><h4 align="center" style="margin-bottom:0;">You are not logged in.</h4></div>';
}
mysql_close($connection);
?>
</article>
      </div>
 </div>

    </section>
    
    
    <footer>
    	Copyright (c) DumbPic.com
    </footer>
    
  </div>
  
</div>
<!--/container-->

</body></html> 