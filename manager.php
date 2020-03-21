<?php 
session_start();

$_SESSION['user'] = 'admin';

if ($_SESSION['user'] == 'admin') {
	
	// here should be code

} else {header("Location: index.php");}


if  (isset($_GET['logout'])) {
	unset($_SESSION['user']);
	session_unset();
	session_destroy();
	header("Location: index.php");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Library admin</title>
</head>
<body>
	<h2>Manage Library Items</h2>

	<a href="manager.php?logout">Logout</a>

</body>
</html>