<?php 
require_once('lib/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Continent</title>
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
<?php include('share/navbar.php')?>
<div class="container"> 
    <div class="btn-group btn-group-justified">
    <?php 
      $continents = display_continent();
      $count = mysqli_num_rows($continents);
       for($i = 0 ; $i < $count ; $i++):
          $continent = mysqli_fetch_assoc($continents);?>
                <a href="<?php echo 'continent.php?continentid=' . $continent['continentid']?>" class="btn btn-primary btn-lg" style="border-color: #24262b; background-color: #24262b;"><?php echo $continent['continentname']; ?></a>
                <?php endfor;
     mysqli_free_result($continents);?>

    </div>
    <div class="row">
  </div>
</div>
<br><br>

<div class="container">
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET)){
        $id = $_GET['continentid'];
        $continent = h_m_in_continent($id);
    }
    $count = mysqli_num_rows($continent);
     for($i = 0 ; $i < $count ; $i++):
        $continent_hm = mysqli_fetch_assoc($continent);

    ?>
            <div class="col-lg-6 text-center">
                    <a href='<?php echo 'monument.php?monumentid=' . $continent_hm['monumentid']?>'>
                    <img style="width:400px; height:300px;"  src="../Admin/uploads/<?php 

                        $img = img_from_monument_id($continent_hm['monumentid']);
                        echo $img['embedlink']; 
                    ?>">
                    </a>
                    <a href='<?php echo 'monument.php?monumentid=' . $continent_hm['monumentid']?>'><h3 ><?php echo $continent_hm['monumentname'];?></h3></a>
            </div>
     <?php endfor;
     mysqli_free_result($continent);?>
     </div> 
</div> 
<?php include("share/footer.php");?>   
     <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>    
 
</body>
</html> 