<?php
require_once('lib/function.php');

unset($_SESSION['username']);

redirect_to('index_continent.php');
exit;
?>