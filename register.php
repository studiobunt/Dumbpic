<?php
ob_start("ob_gzhandler");
include('config.php');
error_reporting(0);
@ignore_user_abort(TRUE);
@set_magic_quotes_runtime(0);
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset=utf-8>

	<title>Dumbpic - Register</title>

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
      <li><a class="" href="login.php" title="Login">Login</a></li>
   </ul>
</nav>
<section id="content">  
    <div style="display: block;" class="panels">    
      <div style="display: block; opacity: 1;" id="login" class="panel">
<article>
<div id="message"></div>
<form action="/reg.php" method="post" name="regform" id="regform">
<fieldset>
<legend>Please fill in your details</legend>
<p><label for=username accesskey=U><span class="required">*</span> Username:</label><input type="text" name="username" id="username" /></p>
<p><label for=password accesskey=P><span class="required">*</span> Password:</label><input type="password" name="password" id="password" /></p>
<p><label for=password accesskey=P><span class="required">*</span> Password (again):</label><input type="password" name="passworda" id="passworda" /></p>
<p><label for=email accesskey=P><span class="required">*</span> E-mail:</label><input type="email" name="email" id="email" /></p>
<p><input type="submit" class="submit" name="submit" id="submit" value="Register" /></p>
</fieldset>
</form>
</article>
      </div>
    </div>
</section>
<footer>Copyright (c) DumbPic.com</footer>    
</div>
  
</div>
<!--/container-->

</body></html>