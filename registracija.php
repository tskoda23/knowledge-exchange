<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$username = $mysqli->real_escape_string($_POST['username']);
	$password = password_hash($mysqli->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
	$firstname = $mysqli->real_escape_string($_POST['firstname']);
	$lastname = $mysqli->real_escape_string($_POST['lastname']);
	$email = $mysqli->real_escape_string($_POST['email']);
	
	
	if ($mysqli->query("INSERT INTO mdl_user(confirmed, username, password, firstname, lastname, email) 
		VALUES(1, '$username', '$password', '$firstname', '$lastname', '$email')") === TRUE) {
        ?>
		<script>alert('uspješna registracija ');</script>
		<?php
    } else {
        ?>
		<script>alert('greška kod registracije...');</script>
		<?php
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login i Registracija</title>
	<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<script type="text/javascript" src="jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var x_timer;    
    $("#username").keyup(function (e){
        clearTimeout(x_timer);
        var user_name = $(this).val();
        x_timer = setTimeout(function(){
            check_username_ajax(user_name);
        }, 1000);
    }); 

function check_username_ajax(username){
    $("#user-result").html('<img src="images/ajax-loader.gif" />');
    $.post('username-checker.php', {'username':username}, function(data) {
      $("#user-result").html(data);
    });
}
});
</script>
<body>
	<center>
		<h1>Registracija</h1>
		<div id="login-form">
			<form method="post" action="registracija.php">
				<table align="center" width="30%" border="0">
					<tr>
						<td><input type="text" id ="username" name="username" placeholder="korisničko ime" required /></td><td><span id="user-result"></span></td>
					</tr>
										<tr>
						<td><input type="password" name="password" placeholder="lozinka" required /></td>
					</tr>
					<tr>
						<td><input type="text" name="firstname" placeholder="ime" required /></td>
					</tr>
										<tr>
						<td><input type="text" name="lastname" placeholder="prezime" required /></td>
					</tr>
					<tr>
						<td><input type="email" name="email" placeholder="email" required /></td>
					</tr>

					<tr>
						<td><input type="submit" name="btn-signup" value="Registriraj me"></td>
					</tr>
					<tr>
						<td><a href="index.php">Prijavi se</a></td>
					</tr>
				</table>
			</form>
		</div>
	</center>
</body>
</html>
