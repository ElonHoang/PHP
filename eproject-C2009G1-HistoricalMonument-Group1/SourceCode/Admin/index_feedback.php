
<?php 
require_once('lib/database.php');
require_once('lib/function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
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
    <table class="table">
        <tr>
            <th>Sender Name</th>
            <th>Comment</th>
            <th>Monument</th>
            <th>Visible</th>
            <th></th>
            <th></th>
        </tr>
        <?php 
            $feedback_set = find_all_feedbacks();
            $count_feedback = mysqli_num_rows($feedback_set);
            for($i = 0; $i < $count_feedback; $i++):
                $feedback = mysqli_fetch_assoc($feedback_set);
        ?>
            <tr>
                <td><?php echo $feedback['sendername'];?></td>
                <td><?php echo $feedback['comment'];?></td>
                <td><?php echo $feedback['monumentname'];?></td>
                <td><?php echo $feedback['visible'];?></td>
                <td><a href='<?php echo 'edit_feedback.php?feedbackid=' . $feedback['feedbackid'];?>'><i class="fa fa-edit"></i></td>
                <td><a href='<?php echo 'delete_feedback.php?feedbackid=' . $feedback['feedbackid'];?>'><i class="fa fa-trash-o"></i></td>
            </tr>
            <?php endfor;
            mysqli_free_result($feedback_set);
            ?>
    </table>

<script src="bootstrap/js/jquery-2.2.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>    
</body>
</html>
<?php db_disconnect($db);?>