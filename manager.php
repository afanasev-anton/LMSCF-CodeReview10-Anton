<?php 
session_start();
require_once 'connection.php';

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
// variables
	$mdId;
    $title = '';
    $aName = '';
    $aSname = '';
    $img;
    $descr;
    $isbn;
    $pblshr;
    $pDate;
    $status;
    $type;

// list of media
    $sql = "SELECT media.mdId, media.title, authors.name as aName, authors.surname as aSname, publishers.name as pName, media.type
		FROM media
		LEFT JOIN author_media ON media.mdId = author_media.mdId
		LEFT JOIN authors ON author_media.authId = authors.authId
		LEFT JOIN publishers ON media.publisher = publishers.pubId";
    $result = mysqli_query($conn, $sql);

// ADD to DataBase
$error = false;

if (isset($_POST['btn-add'])) {
	$title = trim($_POST['title']);
	$aName = trim($_POST['aName']);
    $aSname = trim($_POST['aSname']);

	// basic validation
	if (empty($title)) {
		$error = true ;
		$titleError = "Please enter Title.";
	}
	if (empty($aName)) {
		$error = true ;
		$anError = "Please enter Name.";
	}
	if (empty($aSname)) {
		$error = true ;
		$asnError = "Please enter Surname.";
	}

	if( !$error ) {
		$sqlAuth = "INSERT INTO authors(name, surname) VALUES ('$aName','$aSname')";
		$res = mysqli_query($conn, $sqlAuth);
		if ($res) {
			$msgTyp = "success";
			$msg = "Author has been added into database";
			
			$authId = mysqli_insert_id($conn);
			unset($aName);
			unset($aSname);
			
			$sqlMedia= "INSERT INTO media(title,publisher) VALUES ('$title',7)";
			$res = mysqli_query($conn, $sqlMedia);

			if ($res) {
				$msgTyp = "success";
				$msg = "Media have been added into database";
				$mdId = mysqli_insert_id($conn);
				unset($title);
				mysqli_query($conn, "INSERT INTO author_media(authId, mdId) VALUES ($authId,$mdId)");

				header("Location: manager.php");
			} else {
				$msgTyp = "danger";
				$msg = "Something went wrong, try again later...";
			}
		} else {
			$msgTyp = "danger";
			$msg = "Something went wrong, try again later...";
		}
	}
}

// DELETE item
if (isset($_GET['delete'])) {
	$mdId = $_GET['delete'];
	//$conn->query("DELETE FROM media WHERE mdId=$mdId") or die($conn->error());
	if (mysqli_query($conn,"DELETE FROM media WHERE mdId=$mdId")) {
		$actMsgTyp = "success";
		$actMsg = "Media have been deleted";
		header("Location: manager.php");
	} else {
		
	}
}
// EDIT item

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel ="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin ="anonymous">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<title>Library admin</title>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top border-bottom">
		<h2 class="text-center navbar-brand">Manage Library Items</h2>
		<ul class="navbar-nav w-100">
			<li class="nav-item mx-auto">
				<p class="alert alert-<?php echo $actMsgTyp ?>">
					<?php $actMsg ?>
				</p>
			</li>
			<li class="nav-item active ml-auto mr-3">
				<a href="manager.php?logout" class="btn btn-primary btn-lg">Quit</a>
			</li>
		</ul>		
	</nav>
	<div class="container p-3">
		
		<div class="w-100">
			<h3>list of Items</h3>
		</div>
		<table class="table">
			<thead>
				<tr>
					<th>title</th>
					<th>author name</th>
					<th>author surname</th>
					<th>publisher</th>
					<th>type</th>
					<th colspan="2">Actions</th>
				</tr>
			</thead>
			<?php 
			while ($row = $result-> fetch_assoc()): 
			?>
			<tr>
				<td><?php echo $row['title']; ?></td>
				<td><?php echo $row['aName']; ?></td>
				<td><?php echo $row['aSname']; ?></td>
				<td><?php echo $row['pName']; ?></td>
				<td><?php echo $row['type']; ?></td>
				<td>
					<a href="manager.php?edit=<?php echo $row['mdId']; ?>" class="btn btn-warning">Edit</a>
					<a href="manager.php?delete=<?php echo $row['mdId']; ?>" class="btn btn-danger">Delete</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</table>		
	</div>
	<div class="container p-3">
		<h4 class="text-dark">Add Media</h4>

		<?php if ( isset($msg) ) {?>
		<div  class="alert alert-<?php echo $msgTyp ?>">
			<?php echo  $msg; ?>
				
		</div>
		<?php
		}
		?>
				<form class="w-50" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
					<div class="form-group">
						<label>Title:</label>
						<input type="text" class="form-control" name="title" value = "<?php echo $title ?>">
						<span   class = "text-warning"> <?php   echo  $titleError; ?> </span>
					</div>
	    			<div class="form-group">
	    				<label for="usr-email">Author name:</label>
						<input type="text" class="form-control" name="aName" value = "<?php echo $aName ?>">
						<span   class = "text-warning"> <?php   echo  $anError; ?> </span>
					</div>
					<div class="form-group">
	    				<label for="usr-email">Author surname:</label>
						<input type="text" class="form-control" name="aSname" value = "<?php echo $aSname ?>">
						<span   class = "text-warning"> <?php   echo  $asnError; ?> </span>
					</div>
					
	    			<button class="btn btn-dark" type="submit" name="btn-add">Add info</button>
    			</form>
		
		<div class="row p-3">
			
		</div>
	</div>	

</body>
</html>