
<?php 
require_once('lib/database.php');
require_once('lib/function.php');

$id = $_GET['imgid'];
$img_link = find_gallery_by_id($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include('share/nav_bar.php');?>
<img src="uploads/<?=$img_link['embedlink']?>">
<script src="bootstrap/js/jquery-2.2.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>   
</body>
</html>




