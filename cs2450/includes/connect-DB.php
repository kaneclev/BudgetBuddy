<?php 
include(ROOT_PATH . 'ADMIN/credentials.php');
$dsn = 'mysql:host=webdb.uvm.edu';
$databaseName = 'KMCLEVEL_CS2450';
$username = 'kmclevel_writer';

try {

	 $pdo = new PDO('mysql:host=webdb.uvm.edu;dbname=' . $databaseName, $username, $writer_pass);

} catch (PDOException $exception) {
	
	echo 'Query error: ' . htmlspecialchars($exception->getMessage());
}
?>

