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

	<title>Dumbpic - Contact</title>

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
      <li><a class="selected" href="contact.php" title="Contact us">Contact</a></li>
<?php 
if($ulogovan == 1) { 
echo '<li><a class="" href="upload.php" title="Upload">Upload</a></li>';
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
      <div style="display: block; opacity: 1;" id="contact" class="panel">
        <article>
            
                                
            <form method="post" action="send.php" name="contactform" id="contactform">
            
            <fieldset>
                    
            <legend>Please fill in the following form to contact us</legend>
        
            <p><label for=email accesskey=E><span class="required">*</span> Your email</label>
            <input name="email" type="text" id="name" size="30" value="" /> </p>
        
            <p><label for=subject accesskey=S><span class="required">*</span> Subject</label>
            <input name="subject" type="text" id="email" size="30" value="" /></p>    
            
            <p><label for=comments accesskey=C><span class="required">*</span> Your message</label>
            <textarea name="comments" cols="40" rows="3"  id="comments" style="width: 440px;"></textarea></p>
        
            <p><input type="submit" class="submit" id="submit" value="Submit" /></p>
            
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