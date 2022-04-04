<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="share/background.css">
    <title>Footer</title>
    <style> 
    </style>
</head>
<body>
<footer class="footer">
  	 <div class="container">
  	 	<div class="row">
  	 		<div class="footer-col">
  	 			<h4>Category</h4>
  	 			<ul>
  	 				<li><a href="#">Continent</a></li>
  	 				<li><a href="#">Gallery</a></li>
  	 				<li><a href="#">Seven World Wonder</a></li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
           <h4>Seven World Wonder</h4>
           <?php
            $kiquan = display_kiquan();
             $count = mysqli_num_rows($kiquan);
             for($i = 0 ; $i < $count ; $i++):
             $continent_hm = mysqli_fetch_assoc($kiquan);
            ?>
  	 			<ul>
  	 				<li><a href='<?php echo 'monument.php?monumentid=' . $continent_hm['monumentid']?>'><?php echo $continent_hm['monumentname'];?></a></li>
           </ul>
           <?php endfor;?>
         </div>
  	 		<div class="footer-col">
           <h4>Continent</h4>
           <?php 
            $continents = display_continent();
            $count = mysqli_num_rows($continents);
            for($i = 0 ; $i < $count ; $i++):
            $continent = mysqli_fetch_assoc($continents);?>
  	 			<ul>
  	 				<li><a href="<?php echo 'continent.php?continentid=' . $continent['continentid']?>"><?php echo $continent['continentname']; ?></a></li>
           </ul>
           <?php endfor;
            mysqli_free_result($continents);?>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>follow us</h4>
  	 			<div class="social-links">
          <a href="https://www.facebook.com/dev.hoang.10/" class="fa fa-facebook"></a>
          <a href="https://studio.youtube.com/channel/UC31zkAXE-hEIu69lorljWpg"  class="fa fa-youtube"></a>
          <a href="https://twitter.com/HongToNy7" class="fa fa-twitter"></a>
          <a href="tel:0353959065" class="fa fa-phone"></a>
          <a href="https://mail.google.com/mail/u/0/#inbox?compose=new" class="glyphicon glyphicon-envelope"></a><br>
          <h6>&copy;HANDTEAM</h6>
  	 			</div>
  	 		</div>
  	 	</div>
      
  	 </div>

  </footer>
  <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

    
</body>
</html>