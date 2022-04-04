<?php 
require_once('lib/database.php');
require_once('lib/function.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    delete_feedbacks($_POST['feedbackid']);
    $_SESSION['del_success'] = 'Delete Successful';
    redirect_to('index_feedback.php');

}else {
    if(!isset($_GET['feedbackid'])){
        redirect_to('index_feedback.php');
    }
    $id = $_GET['feedbackid'];
    $feedback = find_feedbacks_by_id($id);
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
<?php include('share/success.php');?>
    <h1>Delete </h1>
    <h2>Are you sure you want to delete Feedback ?</h2>
    <span>Sendername :</span><?php echo $feedback['sendername'];?><br>
    <span>Comment :</span> <?php echo $feedback['comment'];?><br>
    <span>Monument :</span> <?php echo $feedback['monumentname'];?><br>
    <span>Visible :</span> <?php echo $feedback['visible'];?><br>
    <form action='<?php echo $_SERVER['PHP_SELF'];?>' method='POST'>
    <input type='hidden' name='feedbackid' value='<?php echo $feedback['feedbackid'];?>' >
    <input type='submit' value='Delete'>
    
    </form><br><br>
    <a href='index_feedback.php'>Bach to index</a>
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>   
</body>
</html>
<?php db_disconnect($db);?>