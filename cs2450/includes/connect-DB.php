<?php 
include($_SERVER['DOCUMENT_ROOT'] . '/cs2450/config.php');
include(ROOT_PATH . 'ADMIN/credentials.php');
session_start();
$dsn = 'mysql:host=webdb.uvm.edu';
$databaseName = 'KMCLEVEL_CS2450';
$username = 'kmclevel_admin';

try {

	 $pdo = new PDO('mysql:host=webdb.uvm.edu;dbname=' . $databaseName, $username, $admin_pass);

} catch (PDOException $exception) {
	
	echo 'Query error: ' . htmlspecialchars($exception->getMessage());
}
?>

