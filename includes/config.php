<?php
$host='localhost';
$db = 'filezilla';
$username = 'postgres';
$password = 'postgres';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";

try{
	// create a PostgreSQL database connection
  $conn = new PDO($dsn);

} catch (PDOException $e) {
  echo $e->getMessage();
}
?>
