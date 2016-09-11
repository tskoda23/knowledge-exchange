<?php
session_start();
include 'dbconnect.php';
include ('header.php');
include ('footer.php');

if(!isset($_SESSION['id']))
{
	header("Location: index.php");
}

if(!empty($_GET['known'])){
    $mysqli->query("INSERT INTO mdl_user_course(user_id, course_id, znam) VALUES(".$_SESSION['id'].", ".$_GET['known'].", 1)");
}

if(!empty($_GET['unknown'])){
    $mysqli->query("INSERT INTO mdl_user_course(user_id, course_id, znam) VALUES(".$_SESSION['id'].", ".$_GET['unknown'].", 0)");
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

function puni_sve(){
	include 'dbconnect.php';
	$result=$mysqli->query("SELECT id,shortname FROM mdl_course");

	if ($result->num_rows > 0) {
    // output data of each row
		while($row = $result->fetch_assoc()) {
			if (!provjeri_postoji_li($row['id'])){
				echo "<tr><td class=\"col-md-6\" > " . $row["shortname"]. "</td><td class=\"col-md-3\"><a href=\"home.php?known=".$row['id']."\" class=\"green\">Znam <i class=\"glyphicon glyphicon-plus
\"></i></a></td><td class=\"col-md-3\" ><a href=\"home.php?unknown=".$row['id']."\" class=\"red\">Neznam <i class=\"glyphicon glyphicon-plus
\"></i></a></td></tr>";
			}
		}
	} else {
		echo "0 results";
	}
}

printHeader("Svi Predmeti",1);
?>
<div class ="container"
    <div class="jumbotron">
        <table class="table">
            <thead>
                <tr>
                    <th>Svi predmeti</th>
                </tr>
            </thead>
<?php
puni_sve();
?>
        </table>
    </div>
</div>
<?php
print_footer();

