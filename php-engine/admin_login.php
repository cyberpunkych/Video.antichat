<?php
session_start();
if(isset($_SESSION['userName']))
{
  header("Location: admin.php");
}
else
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
include ('settings.php');
include ('config.php');
?>
<html>
<head>
<title>Administration Section</title>
<style>
body
{
font-family: Arial, Sans-serif;
background-color: black;
text-align: center;
font-weight: bold;
margin-top: 30%;
color: white;
}

input 
{
margin-bottom: 10px;
}
</style>
</head>
<body>
<?php
$posted_username = mysql_real_escape_string($_POST["username"]);
$posted_password = mysql_real_escape_string($_POST["password"]);
if ($posted_username == $settings_username & $posted_password == $settings_password)
{
$_SESSION['userName'] ="$posted_username";
$_SESSION['password'] ="$posted_password"; 
echo "You have succesfully logged in : " . $_SESSION['userName'] . " please click <a href='admin.php'>here </a> to continue to the administration section.";
}
else
{
echo '
<div id="login">
<span id="login-title"><p>Invalid login, please login below to continue..</p></span> <br />
<span id="login-title"><p>Login section for administration panel. Administrators only.</p></span> <br />
<form name="input" action="admin_login.php" method="post">
Username: <input type="text" name="username" /> <br />
Password: <input type="text" name="password" /> <br />
<input type="submit" value="Submit" />
</form> 
</div>
';
}
}
?>
</body>
</html>

