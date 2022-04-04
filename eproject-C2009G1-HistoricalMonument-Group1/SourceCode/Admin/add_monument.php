<?php 
 require_once('lib/database.php');
 require_once('lib/function.php');

$error = [
    'monumentname' => '',
    'nation' => '',
    'worldwonder' => '',
    'detail' => '',
    'history' => '',
    'foundation' => '',
    'recognition' => ''
];

function isFormValidated(){
    global $error;
    foreach($error as $value){
        if(!empty($value)){
            return false;
        }
    }
    return true;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($_POST['monumentname'])){
        $error['monumentname'] = 'MonumentName is not empty !';
    }
    if(!empty($_POST['monumentname']) && strlen($_POST['monumentname']) > 50){
        $error['monumentname'] = 'Monument Name not big than 50 character !';
    }
    if(empty($_POST['nation'])){
        $error['nation'] = 'Nation is not empty !';
    }
    if(!empty($_POST['nation']) && strlen($_POST['nation']) > 60){
        $error['nation'] = 'Nation not big than 60 character !';
    }
    if(empty($_POST['worldwonder'])){
        $_POST['worldwonder'] = 'No';
    }
    if(empty($_POST['detail'])){
        $error['detail'] = 'Detail is not empty !';
    }
    if(empty($_POST['history'])){
        $error['history'] = 'History is not empty !';
    }
    if(empty($_POST['foundation'])){
        $error['foundation'] = 'Foundation is not empty !';
    }
    if(empty($_POST['recognition'])){
        $error['recognition'] = 'Recognition is not empty !';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Monument</title>
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
    <div class="container" >  
    <h2><b>New Monument</b></h2>
    <form action='<?php echo $_SERVER['PHP_SELF'];?>' method='POST'>
        <div class="drop-down">
            <label for='continentname'>ContinentName:</label>
            <select name='continentname' class="form-control">
                <?php 
                    $list = find_all_continents();
                    while($continent = mysqli_fetch_assoc($list)){
                ?>
                    <option value='<?php echo $continent['continentid']?>'><?php echo $continent['continentname'];?></option>
                <?php 
                    }
                ?>
            </select>
        </div>
        <div class="form-group">    
            <label for='monumentname'>Monument Name:</label>
            <input type='text' name='monumentname' class="form-control"
            value='<?php echo isFormValidated()? '': $_POST['monumentname']; ?>'>
        </div>
        <div class="form-group"> 
            <label for='nation'>Nation:</label>
            <input type='text' name='nation' class="form-control"
            value='<?php echo isFormValidated()? '': $_POST['nation']; ?>'>
        </div> 
            <label for="worldwonder">WorldWonder:</label>
            <input type="checkbox" name='worldwonder' value='Yes'>
        <div class="form-group">     
            <label for='detail'>Detail:</label>
            <textarea rows="6" class="form-control" name='detail'><?php echo isFormValidated()? '': $_POST['detail'] ;?></textarea>
        </div>
        <div class="form-group"> 
            <label for='history'>History:</label>
            <textarea rows="10" class="form-control" name='history' ><?php echo isFormValidated()? '': $_POST['history'] ;?></textarea>
        </div>
        <div class="form-group"> 
                <label for='foundation'>Foundation:</label>
                <textarea rows="5" class="form-control" name='foundation'><?php echo isFormValidated()? '': $_POST['foundation'] ;?></textarea>
        </div>
        <div class="form-group">         
            <label for='recognition'>Recognition:</label>
            <textarea rows="3" class="form-control" name='recognition'><?php echo isFormValidated()? '': $_POST['recognition'] ;?></textarea>
        </div>
                <input type='submit' class="btn btn-default" value='Submit'>
                <input type='reset' class="btn btn-default" value='Reset'>  
    </form> 
    </div>
    <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && isFormValidated()):?>
            <?php 
                $monument = [];
                $monument['monumentname'] = addslashes($_POST['monumentname']);
                $monument['continentname'] = addslashes($_POST['continentname']);
                $monument['nation'] = addslashes($_POST['nation']);
                $monument['worldwonder'] = addslashes($_POST['worldwonder']);
                $monument['detail'] = addslashes($_POST['detail']);
                $monument['history'] = addslashes($_POST['history']);
                $monument['foundation'] = addslashes($_POST['foundation']);
                $monument['recognition'] = addslashes($_POST['recognition']);

                $result = insert_monuments($monument);
                $new_monument_id = mysqli_insert_id($db);
                ?>
        <h2>A new historical monument (ID:<?php echo $new_monument_id?>) has been created !</h2>
            <?php 
                foreach($_POST as $key => $value){
                    if($key == 'submit') 
                        continue;
                        if(!empty($value)){
                            echo '*' . $key . ':' . $value . '*'.'<br>';
                        }
                }
            
            
            ?>

    <?php endif;?>
    <a href='index_monument.php'>>>Go to index</a> 
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>  
</body>
</html>
<?php db_disconnect($db);?>