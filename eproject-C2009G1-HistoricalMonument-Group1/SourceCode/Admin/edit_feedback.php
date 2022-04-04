<?php 
require_once('lib/database.php');
require_once('lib/function.php');

$error=[];

function isFormValidated(){
    global $error;
     return count($error) == 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!isset($_POST['visible'])){
        $_POST['visible'] = "No";
    }
    if(isFormValidated()){
        $feedback = [];
        $feedback['feedbackid'] = $_POST['feedbackid'];
        $feedback['visible'] = $_POST['visible'];
        update_feedbacks($feedback);
        $_SESSION['edit_success'] = 'Update Successfully';
        redirect_to('index_feedback.php');
    }

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
    <title>Edit</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include('share/nav_bar.php');?>
<div class="container">
    
    <p>Sender:<?php echo $feedback['sendername'] ?></p>
    <p>Comment:<?php echo $feedback['comment'] ?></p>
    <p>Monument:<?php echo $feedback['monumentname']?></p>
    
    <form action='<?php echo $_SERVER['PHP_SELF'];?>' method = 'POST'>
        <input type='hidden' name='feedbackid' value='<?php echo isFormValidated() ? $feedback['feedbackid'] : $_POST['feedbackid'];?>'>
    
        <label for="visible">Visible:</label>
        <input type="checkbox" name="visible" value="Yes" 
            <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if ($feedback['visible'] == "Yes") echo "checked";
            } else {
                if ($_POST["visible"] == "Yes") echo "checked";
            }     
            ?> 
        >

        <input type='submit' class="btn btn-default" value='Submit'>
        <input type='reset' class="btn btn-default" value='Reset'>
    </form>
    <a href='index_feedback.php'>>>Back to index</a>
</div>

    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>   
</body>
</html>
<?php db_disconnect($db);?>