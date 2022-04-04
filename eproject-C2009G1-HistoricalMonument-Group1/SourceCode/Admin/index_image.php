<?php 
require_once('lib/database.php');
require_once('lib/function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <style>
        th {
            background-color:lightblue;
        }
        .fix-img{
            width:200px;
            border-radius: 8px;
            height: 200px;
        }
    </style>
</head>
<body>
<?php include('share/nav_bar.php');?>
<h1><a href="add_image.php">>>>Add Image</a></h1>
    <table class="table">
        <tr>
            <th>img</th>
            <th>Monument</th>
            <th></th>
            <th></th>
        </tr>
        <?php 
            $link_set = select_gallery();
            $count_link = mysqli_num_rows( $link_set);
            for($i = 0; $i < $count_link; $i++):
                $row = mysqli_fetch_assoc($link_set);
        ?>
            <tr>
                <td><img src="uploads/<?=$row['embedlink']?>"  class="fix-img"></td>
                <td><?php echo $row['monumentname'] ?></td>
                <td><a href='<?php echo 'view_image.php?imgid=' . $row['imgid'] ?>'><i class="fa fa-eye"></i></a></t>
                <td><a href='<?php echo 'delete_image.php?imgid=' . $row['imgid']?>'><i class="fa fa-trash-o"></i></a></td>
            </tr>
            <?php endfor;
            mysqli_free_result($link_set);
            ?>
    </table>
<script src="bootstrap/js/jquery-2.2.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>   
</body>
</html>
<?php
db_disconnect($db);
?>