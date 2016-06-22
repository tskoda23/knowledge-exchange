<?php
error_reporting(E_ALL);
$mysqli = new mysqli('localhost' , 'root', '', 'moodle');
    if ($mysqli->connect_error){
        die('Neuspješno spajanje na bazu!');
    }
?>