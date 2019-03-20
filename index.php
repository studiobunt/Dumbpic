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

	<title>Dumbpic - <?php if($_GET['s'] == "top" || empty($_GET['s'])) { echo "Top"; } else { echo "Recent"; } ?> pictures</title>

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
      <li><a class="<?php if($_GET['s'] == "top" || empty($_GET['s'])) { echo "selected"; } ?>" href="index.php?s=top" title="Top pictures">Top</a></li>
      <li><a class="<?php if($_GET['s'] == "recent") { echo "selected"; } ?>" href="index.php?s=recent" title="Recent pictures">Recent</a></li>
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
$strana=$_GET['strana']; 
$s=$_GET['s'];

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
if($s == "recent") {
$q = "SELECT * FROM images ORDER BY id DESC LIMIT $str_1,$str_2";
} else {
$q = "SELECT * FROM images ORDER BY `images`.`lajk` -  `images`.`dislike` DESC LIMIT $str_1,$str_2";
}
$r = mysql_query($q);

if ( $r !== false && mysql_num_rows($r) > 0 ) {
while ( $a = mysql_fetch_assoc($r) ) {
$naziv = stripslashes($a['naziv']);
$autor = stripslashes($a['author']);
$url = stripslashes($a['url']);
echo "<article>";
echo "<h2 style=\"margin-bottom: 0;\"><a style=\"position: relative;\" href=\"image.".$a['id'].".html\">" . $naziv . "</a></h2>";
echo "<div style='margin-left: 430px;position: absolute;margin-top: -38px;'>";
echo "<button type='button' class='minimal' onclick='vote(" . $a['id'] . ", 1)' id='image_" . $a['id'] . "_likes'> +" . $a['lajk'] . " </button>";
echo "<button type='button' class='minimal' onclick='vote(" . $a['id'] . ", 2)' id='image_" . $a['id'] . "_dislikes'> -" . $a['dislike'] . " </button>";
echo "</div>";
echo "<h4>Posted by <a href=\"profile." . $autor . ".html\">" . $autor . "</a>, " . $a['date'] . "</h4>";
echo "<img src='" . $url . "' alt='" . $naziv . "' id='slika_".$a['id']."' onload='scale(".$a['id'].")' />";
echo "</article>";
}
$r1 = mysql_query("SELECT * FROM images");
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
echo "<article><div class=\"strane\" style='text-align: center;'><a href='$s.strana.$pret.html' class=\"minimal\"><</a>";
      for($i=1;$i<$brojstrana+1;$i++) {
      echo "<a href=\"$s.strana.$i.html\" class=\"minimal\" title=\"$i\">$i</a>&nbsp;";
}
echo "<a href='$s.strana.$sled.html' span class=\"minimal\">></a></div></article>";
} else { 
echo ""; 
}
}
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
$('#image_'+id+'_dislikes').text('-'+data);
}
});
}
function scale(id) {
$('#slika_'+id+'').jScale({ls:'490px'})
}
</script>

</body></html> 