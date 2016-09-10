<?php
include ('header.php');
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
	<script>location.href="index.php"</script>
	<?php
} else {
	?>
	<script>alert('greška kod registracije...');</script>
	<?php
}
}
printHeader("Registracija",0,false);
?>
<script type="text/javascript">
	$(document).ready(function() {
		var x_timer;
		$("#inputUser").keyup(function (e){
			clearTimeout(x_timer);
			var user_name = $(this).val();
			x_timer = setTimeout(function(){
				check_username_ajax(user_name);
			}, 1000);
		});

		function check_username_ajax(username){
			$.post('username-checker.php', {'username':username}, function(data) {
				$("#user-result").attr('class',data);
			});
		}
	});
</script>
<div class="container">
	<form class="form-signin" method="post" action="Registracija.php">
		<h2 class="form-signin-heading">Registracija</h2>
		<div class="inner-addon right-addon">
    		<i  id="user-result"></i>
    		<input type="text" id="inputUser" class="form-control" placeholder="Korisničko ime" name="username" required autofocus>
		</div>
		<label for="inputPassword" class="sr-only">Lozinka</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="Lozinka" name="password" required>

		<label for="inputIme" class="sr-only">Ime</label>
		<input type="text" id="inputIme" class="form-control" placeholder="Ime" name="firstname" required>

		<label for="inputPrezime" class="sr-only">Prezime</label>
		<input type="text" id="inputPrezime" class="form-control" placeholder="Prezime" name="lastname" required>

		<label for="inputEmail" class="sr-only">Email</label>
		<input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email" required>

		<input type="submit" class="btn btn-lg btn-primary btn-block" name="btn-signup" value="Registriraj me">
        <a href="index.php">Prijavite se.</a>
	</form>
</div> <!-- /container -->
<?php
?>
