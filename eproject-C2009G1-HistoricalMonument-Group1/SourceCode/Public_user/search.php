<?php 
    require_once('lib/database.php');
    $output=[];
    if (isset($_POST['search'])) {
        $monument = $_POST['search'];
        $result= search($monument);
        $count=  mysqli_num_rows($result);
        if ($count == 0) {
            $output[]='There was no search result';
        } else {
            while ($row= mysqli_fetch_array($result)) {
                $monumentid = $row['monumentid'];
                $monumentname = $row['monumentname'];
                $output[]= '<div><a href="monument.php?monumentid='.$monumentid.'">'.$monumentname.'</a></div>';
                global $output;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="share/background.css">
</head>
<body>
<?php include('share/navbar.php'); ?>
<!-- <div class="container"> -->
<h2 style="color:blue;padding-left:40%">RESULT :</h2>
    <?php
        foreach ($output as $key => $value){
            if (!empty($value)){
                echo '<h4 style="padding-left:40%;">'.'<div class="well well-sm" style="width:300px;">'. $value. '</div>' . '</h4>';
            }
        }
    ?>

<!-- </div> -->
<!-- <?php include("share/footer.php");?> -->
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">   
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
