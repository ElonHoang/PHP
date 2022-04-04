<?php
    require_once('lib/database.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gallery</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="share/background.css">
        <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style>
            div.gallery {
                margin: 5px;
                border: 1px solid hidden;
                float: left;
                width: auto;
                border-radius: 8px;
            }
            div.desc {
                text-align: center;
            }
            img {
                border-radius: 8px;
            }

        </style>
    </head>
    <body>
    <?php include("share/navbar.php");?>
    <div class="container">
    <div class="row">
        <?php 
            $gallery = display_gallery();
            $gallery_set = mysqli_num_rows($gallery);
            for($i = 0; $i < $gallery_set; $i++):
                $all_img = mysqli_fetch_assoc($gallery);
        ?>

            <div class="col-lg-4">
                    <div class="gallery">
                            <img src="../Admin/uploads/<?php echo $all_img['embedlink']; ?>" width="350" height="300" onclick="onClick(this)">
                            <div class="desc"><h3><?php echo $all_img['monumentname'];?></h3></div>
                    </div>
            </div>
        <?php endfor;
         mysqli_free_result($gallery);?>
    </div>
    </div>


    <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
            <span class="w3-button w3-hover-red w3-xlarge w3-display-topright"> &times; </span>
                <div class="w3-modal-content w3-animate-zoom">
                    <img id="img01" style="width:100%">
                </div>
    </div>

    <?php include("share/footer.php");?>
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        function onClick(element) {
            document.getElementById("img01").src = element.src;
            document.getElementById("modal01").style.display = "block";
        }
    </script>
    </body>
</html>

<?php
    db_disconnect($db);
?>