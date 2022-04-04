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
    if(empty($_POST['monumentname'])){
        $error[] = 'MonumentName is not empty !';
    }
    if(!empty($_POST['monumentname']) && strlen($_POST['monumentname']) > 50){
        $error[] = 'Monument Name not big than 50 character !';
    }
    if(empty($_POST['nation'])){
        $error[] = 'Nation is not empty !';
    }
    if(!empty($_POST['nation']) && strlen($_POST['nation']) > 60){
        $error[] = 'Nation not big than 60 character !';
    }
    if(empty($_POST['detail'])){
        $error[] = 'Detail is not empty !';
    }
    if(empty($_POST['history'])){
        $error[] = 'History is not empty !';
    }
    if(empty($_POST['foundation'])){
        $error[] = 'Foundation is not empty !';
    }
    if(empty($_POST['recognition'])){
        $error[] = 'Recognition is not empty !';
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!isset($_POST['worldwonder'])) {
        $_POST['worldwonder'] = "No";
    }
    checkForm();
    if(isFormValidated()){
        $monument = [];
        $monument['monumentid'] = $_POST['monumentid'];
        $monument['monumentname'] = addslashes($_POST['monumentname']);
        $monument['continentname'] = addslashes($_POST['continentname']);
        $monument['nation'] = addslashes($_POST['nation']);
        $monument['worldwonder'] = addslashes($_POST['worldwonder']);
        $monument['detail'] = addslashes($_POST['detail']);
        $monument['history'] = addslashes($_POST['history']);
        $monument['foundation'] = addslashes($_POST['foundation']);
        $monument['recognition'] = addslashes($_POST['recognition']);
        update_monuments($monument);
        $_SESSION['edit_success'] = 'Update Successfully';
        redirect_to('index_monument.php');
    }

} else {
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
<div class="container">
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
    <form action='<?php echo $_SERVER['PHP_SELF'];?>'method = 'POST'>
    <input type='hidden' name='monumentid' value='<?php echo isFormValidated() ? $monument['monumentid'] : $_POST['monumentid'];?>'>
        <div class="dropdown">
            <label for='continentname'>ContinentName:</label>
                <select name='continentname' class="form-control">
                    <?php 
                        $list = find_all_continents();
                        while($continent = mysqli_fetch_assoc($list)){
                    ?>
                        <option value='<?php echo $continent['continentid']?>' <?php if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                            if($continent['continentid']== $monument['continentid']) echo "selected";
                        } else {
                            if ($_POST['continentname']== $continent['continentid']) echo "selected";
                        }
                        ?>><?php echo $continent['continentname'];?></option>
                    <?php 
                        }
                    ?>
               </select>
        </div>
        <div class="form-group">
            <label for='monumentname'>Monument Name:</label>
            <input type='text' class="form-control" name='monumentname' value='<?php echo isFormValidated() ? $monument['monumentname'] : $_POST['monumentname'];?>'>
        </div>
        <div class="form-group">
            <label for='nation'>Nation</label>
            <input type='text' class="form-control" name='nation' value='<?php echo isFormValidated() ? $monument['nation'] : $_POST['nation'];?>'>
        </div>
        <div class="form-group">
            <label for='worldwonder'>WorldWonder:</label>
            <input type='checkbox' name='worldwonder' value='Yes' 
            <?php 
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if ($monument['worldwonder'] == "Yes") echo "checked";
                } else {
                    if ($_POST["worldwonder"] == "Yes") echo "checked";
                }                        
            ?>>
        </div>
        <div class="form-group">
            <label for='detail'>Detail:</label>
            <textarea rows="6"  class="form-control" name='detail'><?php echo isFormValidated()? $monument['detail']: $_POST['detail'] ;?></textarea>
            
        </div>
        <div class="form-group">
            <label for='history'>History:</label>
            <textarea rows="10"  class="form-control" name='history' ><?php echo isFormValidated()? $monument['history']: $_POST['history'] ;?></textarea>
        </div>
        <div class="form-group">   
            <label for='foundation'>Foundation:</label>
            <textarea rows="5"  class="form-control" name='foundation'><?php echo isFormValidated()? $monument['foundation']: $_POST['foundation'] ;?></textarea>
        </div>    
        <div class="form-group">
            <label for='recognition'>Recognition:</label>
            <textarea rows="3" class="form-control" name='recognition'><?php echo isFormValidated()? $monument['recognition']: $_POST['recognition'] ;?></textarea>
        </div>
        <input type='submit' class="btn btn-default" value='Submit'>
        <input type='reset' class="btn btn-default" value='Reset'>
    </form>
</div>
    <a href='index_monument.php'>>>Back to index</a>
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>   
    
</body>
</html>
<?php db_disconnect($db);?>