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
$id=mysql_real_escape_string($_GET['id']); 

$q = "SELECT * FROM images WHERE id = '".$id."'";
$r = mysql_query($q);
$a = mysql_fetch_assoc($r);
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset=utf-8>

	<title>Dumbpic - <?php echo $a['naziv']; ?></title>

	<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="css/print.css" type="text/css" media="print">
        <link rel="stylesheet" href="css/theme.css" type="text/css" media="screen, projection">

        <!--[if lte IE 8]><script src="js/html5.js" type="text/javascript"></script><![endif]--> 
        <!--[if IE]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection"><![endif]-->

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/corners.js"></script>
        <script type="text/javascript" src="js/jquery.jScale.js"></script>
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
<?php

$naziv = stripslashes($a['naziv']);
$autor = stripslashes($a['author']);
$url = stripslashes($a['url']);
echo "<article>";
echo "<h2 style=\"margin-bottom: 0;\">" . $naziv . "</h2>";
echo "<div style='text-align: right;position: relative;margin-top: -38px;'>";
echo "<button type='button' class='minimal' onclick='vote(" . $a['id'] . ", 1)' id='image_" . $a['id'] . "_likes'> +" . $a['lajk'] . " </button>";
echo "<button type='button' class='minimal' onclick='vote(" . $a['id'] . ", 2)' id='image_" . $a['id'] . "_dislikes'> -" . $a['dislike'] . " </button>";
echo "</div>";
echo "<h4>Posted by " . $autor . ", " . $a['date'] . "</h4>";
echo "<img src='" . $url . "' alt='" . $naziv . "' id='slika_".$a['id']."' onload='scale(".$a['id'].")' />";
echo "<br /><hr>";
echo "<div id=\"disqus_thread\"></div></article>";
mysql_close($connection);
?>  
      </div>
 </div>

    </section>
    
    
    <footer>
    	Copyright &copy; DumbPic.com
    </footer>
    
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
<script type="text/javascript">
    var disqus_shortname = 'dumbpic';

    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>

</body></html> 