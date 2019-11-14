<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ovt";
$port="3306";
$conn = new mysqli($servername, $username, $password,$dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//$sql=file_get_contents();
//$conn->exec($sql);
$query = '';
$sqlScript = file("data/ovt.sql");
foreach ($sqlScript as $line)	{
	
	$startWith = substr(trim($line), 0 ,2);
	$endWith = substr(trim($line), -1 ,1);
	
	if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
		continue;
	}
		
	$query = $query . $line;
	if ($endWith == ';') {
		mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
		$query= '';		
	}
}
?>