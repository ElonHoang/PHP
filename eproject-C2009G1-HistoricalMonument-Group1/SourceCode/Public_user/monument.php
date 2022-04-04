<?php 
require_once('lib/database.php');

$id = $_GET['monumentid'];
$monument = select_monument_by_id($id);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['plaintext'])) {
    $file = 'docx/'.$monument['monumentname'].'.docx';
    if (file_exists($file)) {
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment;filename="'.$file.'"');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        readfile($file);
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendername']) && isset($_POST['comment'])){
    $feedback=[];
    $feedback['sendername']= $_POST['sendername'];
    $feedback['comment']= $_POST['comment'];
    $feedback['monumentid']= $monument['monumentid'];
    add_feedback($feedback);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monuments</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="share/background.css">
    <style>
        p {
            padding-left:25px;
            padding-top:15px;
        }

        img {
            border-radius: 8px;
        }

   </style>
</head>
<body>
<?php include("share/navbar.php"); ?>
<h1 style="text-align:center;"><?php echo $monument['monumentname'];?></h1>
<div style="color:black; font-size:20px; margin: 0 5% 0 5%">
    <br> 
    <p><b>Continent:</b> <?php echo $monument['continentname']?></p>
    <p><b>Nation:</b> <?php echo $monument['nation'] ?></p>
    <p><b>Detail:</b> <?php echo $monument['detail'] ?></p>
    <p><b>History:</b> <?php echo $monument['history'] ?></p>
    <p><b>Foundation:</b> <?php echo $monument['foundation'] ?> </p>
    <p><b>Recognition:</b> <?php echo $monument['recognition'] ?> </p>
</div>
    <div class="container">
    <div class="row">
    <?php 
        $img = find_all_img($id);
        $row = mysqli_num_rows($img);
        for($i = 0; $i < $row; $i++):
            $image = mysqli_fetch_assoc($img);
    ?>
        <div class="col-lg-6">
        <img src="../Admin/uploads/<?php echo $image['embedlink']?>" style=" width:400px;height:300px;" >
        </div>
    <?php 
        endfor; 
        mysqli_free_result($img);
    ?>
 </div>
<br>

    <div class="container">
    <form action='<?php echo "monument.php?monumentid=".$monument['monumentid'];?>' method="post">
        <input type="submit" name="plaintext" value="Download Text" class="btn btn-primary btn-lg" style="border-color: #24262b; background-color: #24262b;">
    </form>

    </div><br><br>
    <div class="container">
    <div id="map-container-google-2" class="z-depth-1-half map-container">
                    <iframe src="https://maps.google.com/maps?q=<?php if($_SERVER['REQUEST_METHOD'] == 'GET')  echo $monument['monumentname'];?>&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                    style="border:0" allowfullscreen></iframe>
                </div><br><br><br>
                    <iframe width="420" height="345" src="https://www.youtube.com/embed/76wIbCOWxm4">
                    </iframe>
    </div>
  

    <form action='<?php echo "monument.php?monumentid=".$monument['monumentid'];?>' method="POST">
    <div class="container">
        <div class="form-group">
        <lable for="sendername">Name:</lable>
            <input type="text" name="sendername" class="form-control" style="width:700px;"  required><br>
        <label for="comment">Comment:</label>
            <textarea class="form-control" rows="5" id="comment" style="width:700px;" name='comment' required></textarea><br>
            <input type="submit" name="submit" value="Send" class="btn btn-default">
        </div>
    </form>
    </div>
        <div class="alert alert-info-sm" style="width:700px;">
        <strong></strong> <div class="alert alert-info">
        <strong>NOTES!</strong>All your feedback will be made public only with the consent of the administrator.
                        </div>
        </div>
    <div class="form-group"  style="width:700px; border:1px solid black;">

    <?php 
        $feedback= feedback($monument);
        $feedback_set= mysqli_num_rows($feedback);
        for($i = 0; $i < $feedback_set; $i++):
            $all_feedback_of_monument = mysqli_fetch_assoc($feedback);
    ?>
        <p><?php echo '<b style="color:blue; text-decoration: underline;" >'.'Name:'.'</b>'.$all_feedback_of_monument['sendername'] ?></p><br>
        <p ><?php echo'<b style="color:blue; text-decoration: underline;" >'.'Comment:'.'</b>' . $all_feedback_of_monument['comment']?></p><br>
     <?php endfor;
         mysqli_free_result($feedback);
    ?>
     </div>
    </div>
   


 
 <?php include("share/footer.php");?> 
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>