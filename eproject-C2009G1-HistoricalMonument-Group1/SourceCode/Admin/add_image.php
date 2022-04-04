<?php
require_once('lib/database.php');
require_once('lib/function.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Add Image</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php include('share/nav_bar.php');?>
     <?php if(isset($_GET['error'])):?>
     <p style='color:red'><?php $_GET['error'];?></p>
     <?php endif;?>
    <div class="container">
    <h1>Add Images</h1>
    <form action="validation_image.php" method="post" enctype="multipart/form-data">

    <label for='monument'>Monument:</label>
            <select name='monument'>
                <?php 
                    $list = find_all_monuments();
                    while($monument = mysqli_fetch_assoc($list)){
                ?>
                    <option value='<?php echo $monument['monumentid']?>'><?php echo $monument['monumentname'];?></option>
                <?php 
                    }
                ?>
            </select>

    <input type='file' name='img_link' class="btn btn-default">

    <input type='submit' name='submit'class="btn btn-default" value='Upload'>
    </form>
     <a href="index_image.php">>>Back to index</a> <br>
     </div>
<script src="bootstrap/js/jquery-2.2.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>   
</body>
</html>


<?php
db_disconnect($db);
?>