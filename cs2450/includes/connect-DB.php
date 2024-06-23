<?php 
include(ROOT_PATH . 'ADMIN/credentials.php');
$dsn = 'mysql:host=webdb.uvm.edu';
$databaseName = 'KMCLEVEL_CS2450';
$username = 'kmclevel_writer';

try {
	$pdo = new PDO($dsn, $username, $writer_pass);

} catch (PDOException $exception) {
	print('There was a problem connecting to the database: ' . $exception->getMessage());

}


?>
