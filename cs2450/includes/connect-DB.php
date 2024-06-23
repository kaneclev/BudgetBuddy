<?php 
include(ROOT_PATH . 'ADMIN/credentials.php');
$dsn = 'mysql:host=webdb.uvm.edu';
$databaseName = 'KMCLEVEL_CS2450';
$username = 'kmclevel_writer';

try {

	 $pdo = new PDO('mysql:host=webdb.uvm.edu;dbname=' . $databaseName, $username, $writer_pass);

} catch (PDOException $exception) {
	echo '<div>There was a problem connecting to the database: ';
	echo $exception->getMessage();
	echo '</div>';

}


?>
