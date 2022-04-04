<?php
require_once('lib/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
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
  <div class="container text-center"> 
    <div id="myCarousel" class="carousel slide" data-ride="carousel" >
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active" class="active">
          <img src="image/img4.jpg" alt="Display-1" >
        </div>
        <div class="item">
          <img src="image/img2.jpg" alt="Display-3" >
        </div>
        <div class="item">
            <img src="image/img3.jpg" alt="Display-4">
        </div>
      </div>

      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div> 
   <br><br>
   
    <div class="row">
      <div class="col-lg-5 text-center"><?php $monument = display_monuments($monumentimg = rand(1,4));?>
        <a href='<?php echo 'monument.php?monumentid=' . $monument['monumentid']?>'><h3 ><?php echo $monument['monumentname'];?></h3></a>
        <a href='<?php echo 'monument.php?monumentid=' . $monument['monumentid']?>'><img style=" width:500px;height:400px;"  src="../Admin/uploads/<?=$monument['embedlink']?>"></a>
      </div>
      <div class="col-lg-offset-2 col-lg-5  text-center"><?php $monument = display_monuments($monumentimg = rand(10,14));?>
        <a href='<?php echo 'monument.php?monumentid=' . $monument['monumentid']?>'><h3 ><?php echo $monument['monumentname'];?></h3></a>
        <a href='<?php echo 'monument.php?monumentid=' . $monument['monumentid']?>'><img style=" width:500px;height:400px;"  src="../Admin/uploads/<?=$monument['embedlink']?>"></a>
      </div>
      </div>
    </div><br><br><br>
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <?php include("share/footer.php");?>
</body>
</html>