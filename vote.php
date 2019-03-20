<?php
include('config.php');
session_start();
$u1=$_SESSION['username'];
$p1=$_SESSION['password'];
if(dalisam($u1, $p1) == 1) { 
$id = mysql_real_escape_string($_POST['id']);
$glas = $_POST['glas'];
$ak = $_POST['ak'];
$q = "SELECT * FROM images WHERE id = '$id'";
$r = mysql_query($q);
$q2 = "SELECT * FROM likes WHERE user_name= '".$u1."' AND image_id='".$id."'";
$r2 = mysql_query($q2);
if(mysql_num_rows($r2) != 0) { $vec = 1; }
if ( $r !== false && mysql_num_rows($r) > 0 ) {
while ( $a = mysql_fetch_assoc($r) ) {
if($glas == 1) {
$brojGlasova = stripslashes($a['lajk']);
if($ak == 1) {
echo $brojGlasova;
} else {
if($vec == 1) {
echo 'You already voted.';
} else {
if($a['author'] == $u1) {
echo "You can't vote on your post.";
} else {
$q1 = "UPDATE images SET lajk = $brojGlasova+1 WHERE id = $id";
$q3 = "INSERT INTO likes(image_id, user_name) VALUES(".$id.",'".$u1."')";
$r1 = mysql_query($q1);
$r3 = mysql_query($q3);
echo 'success';
}
}
}
} elseif($glas == 2) {
$brojGlasova = stripslashes($a['dislike']);
if($ak == 1) {
echo $brojGlasova;
} else {
if($vec == 1) {
echo 'You already voted.';
} else {
if($a['author'] == $u1) {
echo "You can't vote on your post.";
} else {
$q1 = "UPDATE images SET dislike = $brojGlasova+1 WHERE id = $id";
$q3 = "INSERT INTO likes(image_id, user_name) VALUES(".$id.",'".$u1."')";
$r1 = mysql_query($q1);
$r3 = mysql_query($q3);
echo 'success';
}
}
}
}
}
}
} else {
echo 'You\'re not logged in.';
}
mysql_close($connection);
?>