<?php 
require_once('lib/database.php');
require_once('lib/function.php');

$error = [];

function isFormValidated(){
    global $error;
     return count($error) == 0;
}

function checkForm(){
    global $error;
    if (empty($_POST['continentname'])){
        $error[] = 'Continent Name is required';
    } else {
        if(strlen($_POST['continentname']) > 50){
            $error['continentname'] = 'Continent Name must not be bigger than 50 character !';
        }
    }
    
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    checkForm();
    if(isFormValidated()){
        $continent = [];
        $continent['continentid'] = $_POST['continentid'];
        $continent['continentname'] = $_POST['continentname'];
        update_continents($continent);
        $_SESSION['edit_success'] = 'Update Successfully';
        redirect_to('index_continent.php');
    }
} else {
    if(!isset($_GET['continentid'])){
        redirect_to('index_continent.php');
    }
    $id = $_GET['continentid'];
    $continent = find_continents_by_id($id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        label {
            font-weight: bold;
        }
        .error {
            color: #FF0000;
        }
        div.error{
            border: thin solid red; 
            display: inline-block;
            padding: 5px;
        }
    </style>
</head>
<body>
<?php include('share/nav_bar.php');?>
<?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && !isFormValidated()): ?> 
        <div class="error">
            <span> Please fix the following errors </span>
            <ul>
                <?php
                foreach ($error as $key => $value){
                    if (!empty($value)){
                        echo '<li>', $value, '</li>';
                    }
                }
                ?>
            </ul>
        </div><br><br>
    <?php endif; ?>
    <h1>Continent</h1>
    <form action='<?php echo $_SERVER['PHP_SELF'];?>'method = 'POST'>
    <input type='hidden' name='continentid' value='<?php echo isFormValidated() ? $continent['continentid'] : $_POST['continentid'];?>'>
    
    <label for="continentname">Continent Name:</label>
        <input type="text" name="continentname"  
        value="<?php echo isFormValidated()? $continent['continentname']: $_POST['continentname'] ?>">
        <br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    </form>
    <a href='index_continent.php'>>>Back to index</a>
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>       
</body>
</html>
<?php db_disconnect($db);?>