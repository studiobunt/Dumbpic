<?php
session_start();
session_destroy();
echo "<script>self.location='index.php';</script>";
?>