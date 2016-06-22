<?php
if(isset($_REQUEST))
{
include 'dbconnect.php';
$course = $_POST['course_id'];
$user = $_POST['session_id'];


$sql="INSERT INTO mdl_user_course (user_id, course_id) VALUES($user, $course)";
$result=$mysqli->query($sql);
if($result){
echo "UNESENO";
}
}
?>