<?php 
require_once('lib/database.php');
require_once('lib/function.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    delete_monuments($_POST['monumentid']);
    $_SESSION['del_success'] = 'Delete Successful';
    redirect_to('index_monument.php');

}else {
    if(!isset($_GET['monumentid'])){
        redirect_to('index_monument.php');
    }
    $id = $_GET['monumentid'];
    $monument = find_monuments_by_id($id);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include('share/nav_bar.php');?>
    <h1>Delete </h1>
    <h2>Are you sure you want to delete Historical Monuments ?</h2>
    <span>Monumentname :</span><?php echo $monument['monumentname'];?><br>
    <span>Nation :</span> <?php echo $monument['nation'];?><br>
    <span>Worldwonder :</span><?php echo $monument['worldwonder'];?><br>
    <span>Detail :</span><?php echo $monument['detail'];?><br>
    <span>History :</span><?php echo $monument['history'];?><br>
    <span>Foundation :</span><?php echo $monument['foundation'];?><br>
    <span>Recognition :</span><?php echo $monument['recognition'];?><br>

    <form action='<?php echo $_SERVER['PHP_SELF'];?>' method='POST'>
    <input type='hidden' name='monumentid' value='<?php echo $monument['monumentid'];?>' >
    <input type='submit' value='Delete'>
    
    </form><br><br>
    <a href='index_monument.php'>Bach to index</a>
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>   
</body>
</html>
<?php db_disconnect($db);?>