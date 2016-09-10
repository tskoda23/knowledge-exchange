<?php
session_start();
include 'dbconnect.php';
include ('header.php');
include ('footer.php');

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
	$result=$mysqli->query("SELECT id,shortname FROM mdl_course
						    LIMIT 10");

	if ($result->num_rows > 0) {
    // output data of each row
    	while($row = $result->fetch_assoc()) {
    		if (provjeri_postoji_li($row['id'])){
    		echo "<tr class=\"known\" data-id=\"".$row['id']."\"><td> " . $row["shortname"]. "</td></tr>";
    		}else{
        	 echo "<tr data-id=\"".$row['id']."\"><td> " . $row["shortname"]. "</td></tr>";
        	}
    	}
	} else {
    echo "0 results";
	}
}

function puni_za_nepoznate(){
	include 'dbconnect.php';
	$result=$mysqli->query("SELECT id,shortname FROM mdl_course");

	if ($result->num_rows > 0) {
    // output data of each row
    	while($row = $result->fetch_assoc()) {
    		if (provjeri_postoji_li($row['id'])){
    		//echo "<tr data-id=\"".$row['id']."\"><td> " . $row["shortname"]. "</td></tr>";
    		}else{
        	echo "<tr data-id=\"".$row['id']."\"><td> " . $row["shortname"]. "</td></tr>";
        	}
    	}
	} else {
    echo "0 results";
	}
}
printHeader("Materijali",3);
?>

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
<?php
print_footer();

