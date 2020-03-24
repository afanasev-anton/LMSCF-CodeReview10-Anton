<?php  

session_start();
if ($_SESSION['user'] == 'admin'){
	header("Location: manager.php");
}

require_once 'connection.php';
require_once 'classes.php';
$list = array(); //array with list of media

//$_SESSION['list'] = $list;

//List of all media
if ($_GET['itm'] == 'all') {
	$queryList = mysqli_query($conn, "SELECT media.mdId, media.title, authors.name as aName, authors.surname as aSname, media.img, media.isbn, media.descr, publishers.name as pName, media.publish_date, media.status, media.type
		FROM media
		LEFT JOIN author_media ON media.mdId = author_media.mdId
		LEFT JOIN authors ON author_media.authId = authors.authId
		LEFT JOIN publishers ON media.publisher = publishers.pubId");

	if($queryList->num_rows > 0){
	    $rows = $queryList->fetch_all(MYSQLI_ASSOC);
	    foreach ($rows as $value){
	        
	        $author = ''.$value['aName'].' '.$value['aSname'];

	        array_push($list,new Media ($value['mdId'],$value['title'],$author,$value['img'],$value['descr'],$value['isbn'],$value['pName'],$value['publish_date'],$value['status'],$value['type']) );

	        $queryMsg = "All Media from Library";
	    }
	    $_SESSION['list'] = $list;
	    $_SESSION['queryMsg'] = $queryMsg;
	} else {
		$queryMsg = "There is nothing in library right now, sorry :(";
		$_SESSION['list'] = array();
	    $_SESSION['queryMsg'] = $queryMsg;
	}

} elseif ( ($_GET['itm'] == 'book') || ($_GET['itm'] == 'DVD') || ($_GET['itm'] == 'CD') ) {
	$type = $_GET['itm'];
	$queryList = mysqli_query($conn, "SELECT media.mdId, media.title, authors.name as aName, authors.surname as aSname, media.img, media.isbn, media.descr, publishers.name as pName, media.publish_date, media.status, media.type
		FROM media
		LEFT JOIN author_media ON media.mdId = author_media.mdId
		LEFT JOIN authors ON author_media.authId = authors.authId
		LEFT JOIN publishers ON media.publisher = publishers.pubId
		WHERE media.type='$type'");
	if($queryList->num_rows > 0){
	    $rows = $queryList->fetch_all(MYSQLI_ASSOC);
	    foreach ($rows as $value){
	        
	        $author = ''.$value['aName'].' '.$value['aSname'];

	        array_push($list,new Media ($value['mdId'],$value['title'],$author,$value['img'],$value['descr'],$value['isbn'],$value['pName'],$value['publish_date'],$value['status'],$value['type']) );

	        $queryMsg = "All ".$type."`s";	        
	    }
	    $_SESSION['list'] = $list;
	    $_SESSION['queryMsg'] = $queryMsg;
	} else {
		$queryMsg = "Sorry, we can not find it...";
		$_SESSION['list'] = array();
	    $_SESSION['queryMsg'] = $queryMsg;
	}

} else {
	$queryList = mysqli_query($conn, "SELECT media.mdId, media.title, authors.name as aName, authors.surname as aSname, media.img, media.isbn, media.descr, publishers.name as pName, media.publish_date, media.status, media.type
		FROM media
		LEFT JOIN author_media ON media.mdId = author_media.mdId
		LEFT JOIN authors ON author_media.authId = authors.authId
		LEFT JOIN publishers ON media.publisher = publishers.pubId
		WHERE media.mdId=".$_GET['itm']);
	if($queryList->num_rows > 0){
	    $rows = $queryList->fetch_all(MYSQLI_ASSOC);
	    foreach ($rows as $value){
	        
	        $author = ''.$value['aName'].' '.$value['aSname'];

	        array_push($list,new Media ($value['mdId'],$value['title'],$author,$value['img'],$value['descr'],$value['isbn'],$value['pName'],$value['publish_date'],$value['status'],$value['type']) );

	        $queryMsg = "Details";	        
	    }
	    $_SESSION['list'] = $list;
	    $_SESSION['queryMsg'] = $queryMsg;
	} else {
		$queryMsg = "Sorry, we can not find it...";
		$_SESSION['list'] = array();
	    $_SESSION['queryMsg'] = $queryMsg;
	}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel ="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin ="anonymous">
	<title>Big Library</title>
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
                    <a  class="nav-link text-primary" href="manager.php">Manage</a>
                </li>
    		</ul>
    	</nav>

    	<div class="row p-3">
    		<h3 class="w-100 text-center text-info"><?php echo $queryMsg; ?></h3>
    		<?php 
    		if (($_GET['itm'] == 'all') || ($_GET['itm'] == 'book') || ($_GET['itm'] == 'DVD') || ($_GET['itm'] == 'CD')) {
	    		foreach ($list as $val) {
	    			$res=$val->printCards();
	    			echo $res;
	            }
            } else {
            	foreach ($list as $val) {
	    			$res=$val->printDetails();
	    			echo $res;
	            }
            }
            ?>
    	</div>
		
	</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>