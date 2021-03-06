<?php
function printHeader($title,$active=0, $nav = true){
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $title?></title>
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="icon" type="image/ico" href="favicon.png">
		<script src="js/jquery-3.0.0.min.js"></script>
	</head>
	<body>
		<?php if($nav){
			?>
			<nav class="navbar navbar-inverse navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!--brand-->
						<a class="navbar-brand"  href="home.php">Knowledge exchange</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<?php
							switch ($active) {
								case 1:
								?>
								<li class="active"><a href="home.php">Svi Predmeti</a></li><!--home -->
                                <li><a href="znam.php">Znam</a></li>
                                <li><a href="neznam.php">Neznam</a></li>
								<!-- <li><a href="poruke.php">Poruke</a></li> -->
								<<!-- li><a href="materijali.php">Materijali</a></li> -->
								<?php
								break;
								case 2:
								?>
								<li><a href="home.php">Svi Predmeti</a></li><!--home -->
								<!-- <li class="active"><a href="poruke.php">Poruke</a></li> -->
                                <li><a href="znam.php">Znam</a></li>
                                <li><a href="neznam.php">Neznam</a></li>
								<<!-- li><a href="materijali.php">Materijali</a></li> -->
								<?php
								break;
								case 3:
								?>
								<li><a href="home.php">Svi Predmeti</a></li><!--home -->
								<!-- <li><a href="poruke.php">Poruke</a></li> -->
                                <li><a href="znam.php">Znam</a></li>
                                <li><a href="neznam.php">Neznam</a></li>
								<!-- <li class="active"><a href="materijali.php">Materijali</a></li> -->
								<?php
								break;
                                case 4:
                                ?>
                                <li><a href="home.php">Svi Predmeti</a></li><!--home -->
                                <!-- <li><a href="poruke.php">Poruke</a></li> -->
                                <li class="active"><a href="znam.php">Znam</a></li>
                                <li><a href="neznam.php">Neznam</a></li>
                                <<!-- li><a href="materijali.php">Materijali</a></li> -->
                                <?php
                                break;
                                case 5:
                                ?>
                                <li><a href="home.php">Svi Predmeti</a></li><!--home -->
                                <!-- <li><a href="poruke.php">Poruke</a></li> -->
                                <li><a href="znam.php">Znam</a></li>
                                <li class="active"><a href="neznam.php">Neznam</a></li>
                                <<!-- li><a href="materijali.php">Materijali</a></li> -->
                                <?php
                                break;
								default:
								?>
								<li><a href="home.php">Svi Predmeti</a></li><!--home -->
								<!-- <li><a href="poruke.php">Poruke</a></li> -->
                                <li><a href="znam.php">Znam</a></li>
                                <li><a href="neznam.php">Neznam</a></li>
								<<!-- li><a href="materijali.php">Materijali</a></li> -->
								<?php
							}
							?>
						</ul>

						  <ul class="nav navbar-nav navbar-right">
                            <li><a class="nohover"><?php echo $_SESSION['user']?></a></li>
							<li><a href="logout.php?logout">Odjava</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div><!-- container -->
			</div>
		</nav>
		<?php
	}
}
