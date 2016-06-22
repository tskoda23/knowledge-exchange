<?php
session_start();
include_once 'dbconnect.php';
if(isset($_SESSION['id'])!="")
{
	header("Location: home.php");
}
if(isset($_POST['btn-login']))
{
	
	$username = $mysqli->real_escape_string($_POST['username']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$res = $mysqli->query("SELECT * FROM mdl_user WHERE username='$username'");
	
	if($res){
		$row = mysqli_fetch_array($res);
		
	if(password_verify ( $password, $row['password']))
	{
		$_SESSION['id'] = $row['id'];
		header("Location: home.php");
	}
	}
	else
	{
		?>
		<script>alert('pogrešni podaci');</script>
		<?php
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login i registracija</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
	<center>
		<h1>Prijava</h1>
		<div id="login-form">
			<form method="post" action="index.php">
				<table align="center" width="30%" border="0">
					<tr>
						<td><input type="text" name="username" placeholder="korisničko ime" required /></td>
					</tr>
					<tr>
						<td><input type="password" name="password" placeholder="lozinka" required /></td>
					</tr>
					<tr>
						<td><input type="submit" name="btn-login" value="Prijavi se"></td>
					</tr>
					<tr>
						<td><a href="registracija.php">Registriraj se</a></td>
					</tr>
				</table>
			</form>
		</div>
	</center>
</body>
</html>
<?php
?>