<?php
session_start();
include 'dbconnect.php';

if(!isset($_SESSION['id']))
{
	header("Location: index.php");
}
$res=$mysqli->query("SELECT * FROM mdl_user WHERE id=".$_SESSION['id']);
$userRow=mysqli_fetch_array($res);

function provjeri_postoji_li($course){
	include 'dbconnect.php';
	$result=$mysqli->query("SELECT user_id FROM mdl_user_course
							WHERE course_id = $course
							AND user_id = ".$_SESSION['id']);
	if($result->num_rows>0){
		return true; 
	}else{
		return false;
	}
}

function puni_za_poznate(){
	include 'dbconnect.php';
	$result=$mysqli->query("SELECT id,fullname FROM mdl_course
						    LIMIT 10");

	if ($result->num_rows > 0) {
    // output data of each row
    	while($row = $result->fetch_assoc()) {
    		if (provjeri_postoji_li($row['id'])){
    		echo "<tr class=\"known\" data-id=\"".$row['id']."\"><td> " . $row["fullname"]. "</td></tr>";
    		}else{
        	 echo "<tr data-id=\"".$row['id']."\"><td> " . $row["fullname"]. "</td></tr>";
        	}
    	}
	} else {
    echo "0 results";
	}
}

function puni_za_nepoznate(){
	include 'dbconnect.php';
	$result=$mysqli->query("SELECT id,fullname FROM mdl_course
						    LIMIT 20");

	if ($result->num_rows > 0) {
    // output data of each row
    	while($row = $result->fetch_assoc()) {
    		if (provjeri_postoji_li($row['id'])){
    		//echo "<tr data-id=\"".$row['id']."\"><td> " . $row["fullname"]. "</td></tr>";
    		}else{
        	echo "<tr data-id=\"".$row['id']."\"><td> " . $row["fullname"]. "</td></tr>";
        	}
    	}
	} else {
    echo "0 results";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Dobrodošli - <?php echo $userRow['username']; ?></title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<script type="text/javascript" src="jquery-1.12.4.min.js"></script>
</head>
<body>
	<div id="header">
		<div id="left">
			<label>Razmjena znanja</label>
		</div>
		<div id="right">
			<div id="content">
			    <?php echo $userRow['firstname']; ?>&nbsp;<a href="logout.php?logout">Odjava</a>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="main">
		<table class="mainTable">
			<thead>
				<tr>
					<th> Predmeti za koje nudim znanje </th>
				</tr>
			</thead>
			<tbody>
			<?php puni_za_poznate(); ?>
			</tbody>
		</table>
		<table class="mainTable">
			<thead>
				<tr>
					<th> Predmeti za koje tražim znanje </th>
				</tr>
			</thead>
			<tbody>
				<?php puni_za_nepoznate(); ?>
			</tbody>
		</table>
		<div>
	</div>
<script type="text/javascript">
$(document).ready(function() { //ajax unos u bazu
    $('.main table tbody tr').not('.known').click(function() {
    	$(this).attr('class','known');
    	var data = 'course_id='+$(this).data('id')+'&session_id=<?php echo $_SESSION['id'] ?>';
    	$.ajax({
        data: data,
        type: "post",
        url: "user_course.php",
        success: function(data){
             alert("Predmet dodan u listu poznatih predmeta");
        }
     });
   });
});
</script>
</body>
</html>
