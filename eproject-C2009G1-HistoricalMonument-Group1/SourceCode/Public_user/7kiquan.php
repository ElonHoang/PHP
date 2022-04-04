<?php 
require_once('lib/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Wonder</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="share/background.css">
    <style>
        img {
            border-radius: 8px;
            border: 1px solid hidden;
        }
    </style>
</head>
<body>
<?php include("share/navbar.php"); ?>
<div class="container">
<div class="row" >
    <?php
    $kiquan = display_kiquan();
    $count = mysqli_num_rows($kiquan);
     for($i = 0 ; $i < $count ; $i++):
        $continent_hm = mysqli_fetch_assoc($kiquan);
     ?>
            <div class="col-lg-6 ">
                    <a href='<?php echo 'monument.php?monumentid=' . $continent_hm['monumentid']?>'><h3 ><?php echo $continent_hm['monumentname'];?></h3></a><br>
                    <a href='<?php echo 'monument.php?monumentid=' . $continent_hm['monumentid']?>'>
                    <img src="../Admin/uploads/<?php $image = img_from_monument_id($continent_hm['monumentid']);
                                                                echo $image['embedlink'];
                                                ?>" style=" width:400px; height:300px;">
                   </a>
            </div>
     <?php endfor;?>
     </div>
    </div><br><br><br>
    <?php include("share/footer.php");?>
 
</div>
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>