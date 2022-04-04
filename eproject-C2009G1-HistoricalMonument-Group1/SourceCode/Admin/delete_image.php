<?php 
require_once('lib/database.php');
require_once('lib/function.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    delete_gallery($_POST['imgid']);
    redirect_to('index_image.php');

}else {
    if(!isset($_GET['imgid'])){
        redirect_to('index_image.php');
    }
    $id = $_GET['imgid'];
    $img_link = find_gallery_by_id($id);
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
    <h2>Delete</h2>
    <p>Are you sure do you want images :</p>
    <span>Link:</span><?php echo $img_link['embedlink'];?> <br>
    <img src="uploads/<?=$img_link['embedlink']?>">
    <form action='delete_image.php' method='POST'>
    <input type='hidden' name='imgid' value='<?php echo $img_link['imgid'];?>' >
    <input type='submit' value='Delete'>
    
    </form><br><br>
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>