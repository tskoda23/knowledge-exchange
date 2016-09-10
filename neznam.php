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
        AND user_id = ".$_SESSION['id']." AND znam = 0");
    if($result->num_rows>0){
        return true;
    }else{
        return false;
    }
}
function puni_neznam(){
    include 'dbconnect.php';
    $result=$mysqli->query("SELECT id,fullname FROM mdl_course");

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            if (provjeri_postoji_li($row['id'])){
                echo "<tr><td> " . $row["fullname"]. "</td><td><a href=\"znam.php?ukloni=".$row['id']."\" class=\"green\">Ukloni <i class=\"glyphicon glyphicon-minus
\"></i></a></td></tr>";
            }
        }
    } else {
        echo "0 results";
    }
}

printHeader("Neznam",5);
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
puni_neznam();
?>
        </table>
    </div>
</div>
<?php
print_footer();

