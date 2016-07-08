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
	$result=$mysqli->query("SELECT id,fullname FROM mdl_course
		LIMIT 10");

	if ($result->num_rows > 0) {
    // output data of each row
		while($row = $result->fetch_assoc()) {
			if (provjeri_postoji_li($row['id'])){
				echo "<tr class=\"known\" id=\"".$row['id']."\"><td> " . $row["fullname"]. "</td></tr>";
			}else{
				echo "<tr id=\"".$row['id']."\"><td> " . $row["fullname"]. "</td></tr>";
			}
		}
	} else {
		echo "0 results";
	}
}

function puni_za_nepoznate(){
	include 'dbconnect.php';
	$result=$mysqli->query("SELECT id,fullname FROM mdl_course");

	if ($result->num_rows > 0) {
    // output data of each row
		while($row = $result->fetch_assoc()) {
			if (provjeri_postoji_li($row['id'])){
    		//echo "<tr data-id=\"".$row['id']."\"><td> " . $row["fullname"]. "</td></tr>";
			}else{
				echo "<tr id=\"".$row['id']."\"><td> " . $row["fullname"]. "</td></tr>";
			}
		}
	} else {
		echo "0 results";
	}
}
printHeader("Korisnička",1);
 ?>
<div class="dragulio" id="left">
    <div>One</div>
    <div>Two</div>
    <div>Three</div>
    <div>Four</div>
    <div>Five</div>
    <div>Six</div>
    <div>Seven</div>
</div>
<div class="dragulio" id="right"></div>
<script type="text/javascript">
var dragAndDrop = {

    limit: 4,
    count: 0,
    
    init: function () {
        this.dragula();
        this.eventListeners();
    },

    eventListeners: function () {
        this.dragula.on('drop', this.dropped.bind(this));
    },

    dragula: function () {
        this.dragula = dragula([document.querySelector('#left'), document.querySelector('#right')],
        {
            moves: this.canMove.bind(this),
            copy: true,
        });
    },
    
    canMove: function () {
        return this.count < this.limit;
    },
    
    dropped: function (el) {
        this.count++;
    }

};

dragAndDrop.init();    
$(document).ready(function() { //ajax unos u bazu
	$('.main table tbody tr').not('.known').click(function() {
		$(this).attr('class','known');
		var data = 'znam=true&course_id='+$(this).data('id')+'&session_id=<?php echo $_SESSION['id'] ?>';
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

