<?php
session_start();
include_once 'dbconnect.php';
include ('header.php');
include ('footer.php');
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

printHeader("Prijava",0, false); //false je da se ne prikaze nav
?>
    <div class="container">
      <form class="form-signin" method="post" action="index.php">
        <h2 class="form-signin-heading">Prijava</h2>
        <label for="inputUser" class="sr-only">Korisničko ime</label>
        <input type="text" id="inputUser" class="form-control" placeholder="Korisničko ime" name="username" required autofocus>
        <label for="inputPassword" class="sr-only">Lozinka</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
        <input type="submit" class="btn btn-lg btn-primary btn-block" name="btn-login" value="Prijavi se">
        <a href="Registracija.php">Nemate račun? Registrirajte se.</a>
      </form>
    </div> <!-- /container -->
<?php

?>