<p class="success">
    <?php
        echo isset($_SESSION['edit_success'])? $_SESSION['edit_success'] :'';
        echo isset($_SESSION['del_success'])? $_SESSION['del_success'] :'';
        $_SESSION['edit_success'] = null;
        $_SESSION['del_success'] = null;

    ?>
</p>