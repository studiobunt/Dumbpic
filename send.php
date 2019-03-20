<?php
if (isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['comments'])) {
	$headers = 'From: '.$_POST['email'];
	if(mail ('dzenan555@hotmail.com',$_POST['subject'],$_POST['comments'],$headers)) {
        echo "<div class='success'><h4 style='margin-bottom: 0; text-align: center;'>Successfully sent!</h4></div>";
        } else {
echo "<div class='error'><h4 style='margin-bottom: 0; text-align: center;'>An error has occured. Please try again!</h4></div>";
} 
}
else {
        echo "<div class='error'><h4 style='margin-bottom: 0; text-align: center;'>Please fill in all fields!</h4></div>";
}
?>