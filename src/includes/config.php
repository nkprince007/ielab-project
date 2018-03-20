<?php
$host='localhost';
$db = 'filezilla';
$username = 'naveen';
$password = 'postgres';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";

try{
	// create a PostgreSQL database connection
  $conn = new PDO($dsn);
  // echo var_dump($conn);

} catch (PDOException $e) {
  echo $e->getMessage();
}
?>
