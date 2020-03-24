<?php  
session_start();

// if session is not set this will make new guest user
if (!isset($_SESSION['user'])) {

	$_SESSION['user'] = 'guest';

} else if ($_SESSION['user'] == 'admin'){
	header("Location: manager.php");
}

require_once 'connection.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel ="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin ="anonymous">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<title>Big Library | we have books</title>
</head>
<body class="bg-light">
	<div class="container-fluid">
		<div class="row p-3">
			<h1 class="display-1 w-100 text-left text-dark">Big<span class="text-danger">Library</span></h1>
		</div>
		<nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top border-bottom">
			<ul class="navbar-nav w-100">
				<li class="nav-item active">
    				<a  class="nav-link" href="index.php">Home</a>
    			</li>
    			<li class="nav-item">
    				<a class="nav-link" href="library.php?itm=all">Library</a>
    			</li>
                <li class="nav-item ml-auto mr-3">
                    <a class="nav-link text-primary" href="manager.php">Manage</a>
                </li>
    		</ul>
    	</nav>

    	<div class="container mt-5">
    		<div class="w-100 p-3">
    			<h1 class="text-center text-dark">Big Library</h1>
    			<h3 class="text-secondary">Spend time with benefit</h3>
    			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Donec pretium vulputate sapien nec sagittis aliquam malesuada bibendum arcu.</p>    			
    		</div>
    		<div class="row p-3">
    			<div class="col p-3">
    				<a href="library.php?itm=books" class="btn btn-info btn-lg w-100">
    					<i class='fas fa-book'></i> Books
    				</a>
    			</div>
    			<div class="col p-3">
    				<a href="library.php?itm=dvds" class="btn btn-info btn-lg w-100">
    					<i class='fas fa-compact-disc'></i> DVDs
    				</a>
    			</div>
    			<div class="col p-3">
    				<a href="library.php?itm=cds" class="btn btn-info btn-lg w-100">
    					<i class='fas fa-compact-disc'></i> CDs
    				</a>
    			</div>
    			<div class="w-100 p-3">
    				<a href="library.php?itm=all" class="btn btn-success btn-lg w-100">
    					<i class='fas fa-archive'></i> All Media
    				</a>
    			</div>
    		</div>    		
    	</div>
    	
		
	</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>