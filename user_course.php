<?php
if(isset($_REQUEST))
{
include 'dbconnect.php';
$course = $_POST['course_id'];
$user = $_POST['session_id'];
if(isset($_POST['znam']){
	$znam = true;
}else{
	$znam = false;
}

$sql="INSERT INTO mdl_user_course (user_id, course_id, znam) VALUES($user, $course, $znam)";
$result=$mysqli->query($sql);
if($result){
die('Uneseno')
}
}
?>