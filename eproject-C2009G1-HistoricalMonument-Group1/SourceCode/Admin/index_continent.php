<?php 
require_once('lib/database.php');
require_once('lib/function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List_History</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <style>
        th {
            background-color:lightblue;
        }
        .success{
            color: green;
            text-align: center;
            font-size:60px
        }
    </style>
</head>
<body>
<?php include('share/nav_bar.php');?>
<?php include('share/success.php');?>
        <h3><a href='add_continent.php'>>> Create New Continent</a></h3>
    <table class="table">
        <tr>
            <th>Continent</th>
            <th></th>
            <th></th>
        </tr>
        <?php 
            $continent_set = find_all_continents();
            $count_continent = mysqli_num_rows($continent_set);
            for($i = 0; $i < $count_continent; $i++):
                $continent = mysqli_fetch_assoc($continent_set);
        ?>
            <tr>
                <td><?php echo $continent['continentname'];?></td>
                <td><a href='<?php echo 'edit_continent.php?continentid=' . $continent['continentid']?>'><i class="fa fa-edit"></i></td>
                <td><a href='<?php echo 'delete_continent.php?continentid=' . $continent['continentid']?>'><i class="fa fa-trash-o"></i></td>
            </tr>
            <?php endfor;
            mysqli_free_result($continent_set);
            ?>
    </table>
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php db_disconnect($db);?>