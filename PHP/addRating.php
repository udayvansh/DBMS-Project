<?php

$Eid = "";
$Region = "";
$Rating = 0;

if (isset($_GET["Eid"]))
{

	$Eid = $_GET["Eid"];

}

if (isset($_GET["Region"]))
{

	$Region = $_GET["Region"];

}

if (isset($_GET["Rating"]))
{

	$Rating = $_GET["Rating"];

}

$db = mysqli_connect('127.0.0.1', 'root', '', 'DBMS Project') or die('Eng to mysql server');

mysqli_query($db, "start transaction") or die("Query error");

$query = "update employee set Success = Success + $Rating - 2, E_jobs = E_jobs+1 where E_id = '$Eid' and O_name = '$Region'";

$result = mysqli_query($db, $query) or die ('Query error');

if ($result)
{

	mysqli_query($db, "commit") or die ('Query error');

}
else 
{

	mysqli_query($db, "rollback") or die ('Query error');

}

$r = array("Sucess" => 1, "Query" => $query);

echo json_encode($r);

mysqli_close($db);

?>