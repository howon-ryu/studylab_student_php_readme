<?php
$host = '211.254.212.182:13306';
$user = 'root';
$pw = '1howtobiz';
$db_name = 'studylab';

$mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결
$mysqli->set_charset("utf8");

function sql_query($sql){
    global $mysqli;
    
	$sql = trim($sql);
    return $mysqli->query($sql);
}



?>