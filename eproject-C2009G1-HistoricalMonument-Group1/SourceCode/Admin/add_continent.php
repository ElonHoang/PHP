<?php
require_once('lib/database.php');
require_once('lib/function.php');
$error = [];

function isFormValidated(){
    global $error;
    return count($error) == 0;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    if (empty($_POST['continentname'])){
        $error[] = 'Continent Name is required';
    }
    if(!empty($_POST['continentname']) && strlen($_POST['continentname']) > 50){
        $error['continentname'] = 'Continent Name not big than 50 character !';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Add Continent</title>
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
    <div class="container">
        <h1>New Continent</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="form-group">
                <label for="continentname">Continent Name:</label>
                <input type="text" name="continentname" class="form-control" 
                value="<?php echo isFormValidated()? '': $_POST['continentname'] ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-default" value="Submit">
            <input type="reset" name="reset" class="btn btn-default" value="Reset">
        </form>
    <div>
    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
        <?php 
        $continent = [];
        $continent['continentname']= $_POST['continentname'];
        $result = insert_continents($continent);
        $newcontinentid = mysqli_insert_id($db);
        ?>
        <h2>A new Continent (ID: <?php echo $newcontinentid ?>) has been created:</h2>
        <ul>
        <?php 
            foreach ($_POST as $key => $value) {
                if ($key == 'submit') continue;
                if(!empty($value)) echo '<li>', $key.': '.$value, '</li>';
            }        
        ?>
        </ul>
    <?php endif; ?>
    
    <br><br>
    <a href="index_continent.php">Back to index</a> 
    
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>   
</body>
</html>


<?php
db_disconnect($db);
?>