<?php  

$servername = "feira_trajano.mysql.dbaas.com.br";
$username 	= "feira_trajano";
$password 	= "tr4j4n0@!f31r4";
$dbname 	= "feira_trajano";

$conn 	= mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}else{
	
}

?>