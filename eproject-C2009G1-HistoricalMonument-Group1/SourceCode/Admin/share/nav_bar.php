<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <img src="../Public_user/image/logohm.png" width="50px" height="50px">
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index_continent.php">Continent</a></li>
            <li><a href="index_monument.php">Monument</a></li>
            <li><a href="index_feedback.php">Feedback</a></li>
            <li><a href="index_image.php">Gallery</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a><span class="glyphicon glyphicon-user"></span><?php echo isset($_SESSION['username'])?$_SESSION['username']: ''; ?></a></li>
      <li><a href=<?php echo 'logout.php'; ?>><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
    </div>
</nav>