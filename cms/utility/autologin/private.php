<?php
include 'config.php';
 echo "<pre>";
               print_r($_COOKIE);
               echo "</pre>";
// Check if the user is logged in
if(!isSet($_SESSION['username']))
{
header("Location: login.php");
exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE>Private Page</TITLE>
  <META name="Author" Content="Bit Repository">
  <META name="Keywords" Content="private">
  <META name="Description" Content="Private Page">
</HEAD>

 <BODY>

Welcome, <?php echo $_SESSION['username']; ?> | <a href="logout.php">Logout</a><br /><br />

This is your private page. You can put specific content here.

 </BODY>
</HTML>