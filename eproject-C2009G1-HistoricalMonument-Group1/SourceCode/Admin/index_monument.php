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
        <h3><a href='add_monument.php'>>> Create New Historical Monuments</a></h3>
    <table class="table">
        <tr>
            <th>Monument Name</th>
            <th>Continent</th>
            <th>Nation</th>
            <th>World Wonder</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php 
            $monument_set = find_all_monuments();
            $count_monument = mysqli_num_rows($monument_set);
            for($i = 0; $i < $count_monument; $i++):
                $monument = mysqli_fetch_assoc($monument_set);
        ?>
            <tr>
                <td><?php echo $monument['monumentname'];?></td>
                <td><?php echo $monument['continentname'];?></td>
                <td><?php echo $monument['nation'];?></td>
                <td><?php echo $monument['worldwonder'];?></td>
                <td><a href='<?php echo 'view_monument.php?monumentid=' . $monument['monumentid'] ?>'><i class="fa fa-eye"></i></a></t>
                <td><a href='<?php echo 'edit_monument.php?monumentid=' . $monument['monumentid']?>'><i class="fa fa-edit"></i></a></td>
                <td><a href='<?php echo 'delete_monument.php?monumentid=' . $monument['monumentid']?>'><i class="fa fa-trash-o"></i></a></td>
            </tr>
            <?php endfor;
            mysqli_free_result($monument_set);
            ?>
    </table>

    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php db_disconnect($db);?>