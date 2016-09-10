<?php
session_start();
include 'dbconnect.php';
include ('header.php');
include ('footer.php');

if(!isset($_SESSION['id']))
{
    header("Location: index.php");
}

if(!empty($_GET['ukloni'])){
    $mysqli->query("DELETE FROM mdl_user_course where course_id = ".$_GET['ukloni']."");
}

$res=$mysqli->query("SELECT * FROM mdl_user WHERE id=".$_SESSION['id']);
$userRow=mysqli_fetch_array($res);

function puni_znalce($course_id){
    include 'dbconnect.php';
    $result=$mysqli->query("SELECT mdl_course.id, mdl_user.username, mdl_user.email FROM mdl_course
                            INNER JOIN mdl_user_course
                            ON mdl_user_course.course_id = mdl_course.id
                            INNER JOIN mdl_user
                            ON mdl_user.id = mdl_user_course.user_id
                            WHERE mdl_course.id =".$course_id."
                            AND mdl_user_course.user_id != ".$_SESSION['id']."
                            AND znam = 1");

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
                echo "<tr class=\"znalci\"><td></td><td>".$row["username"]." <a href=\"mailto:".$row["email"]."\">".$row["email"]."</a> <i class=\"glyphicon glyphicon-envelope
\"></i></a></td></tr>";
        }
    } else {
        echo "0 results";
    }
}

function puni_neznam(){
    include 'dbconnect.php';
    $result=$mysqli->query("SELECT mdl_course.id, mdl_course.shortname FROM mdl_course
                            INNER JOIN mdl_user_course
                            ON mdl_user_course.course_id = mdl_course.id
                            WHERE mdl_user_course.user_id = ".$_SESSION['id']."
                            AND mdl_user_course.znam = 0");

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {

                echo "<tr><td> " . $row["shortname"]. "</td><td><a href=\"neznam.php?ukloni=".$row['id']."\" class=\"green\">Ukloni <i class=\"glyphicon glyphicon-minus
\"></i></a></td></tr>";
                puni_znalce($row['id']);
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
                    <th>
                        <a id="prikazi_znalce" href="#">Prikaži znalce <i class="glyphicon glyphicon-resize-full"></i></a>
                        <a id="sakrij_znalce" href="#">Sakrij znalce <i class="glyphicon glyphicon-resize-small"></i></a>
                    </th>
                </tr>
            </thead>
<?php
puni_neznam();
?>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        $("#prikazi_znalce").click(function(){
            $(".znalci").show();
            $("#prikazi_znalce").hide();
            $("#sakrij_znalce").show();

        });

        $("#sakrij_znalce").click(function(){
            $(".znalci").hide();
            $("#prikazi_znalce").show();
            $("#sakrij_znalce").hide();
        });
    });
</script>
<?php
print_footer();

