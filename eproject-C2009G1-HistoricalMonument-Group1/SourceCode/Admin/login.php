<?php
require_once('lib/function.php');
require_once('lib/database.php');
$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

function checkForm(){
    global $errors;
    $username=$_POST['username'];
    $password= sha1($_POST['pwd']);
    if (empty($_POST['username'])){
        $errors[] = 'Username is required';
    }

    if (empty($_POST['pwd'])){
        $errors[] = 'Password is required';
    }
    if(!check_login($username,$password) && !empty($_POST['username']) && !empty($_POST['pwd'])){
        $errors[] = 'PassWord or UserName invalid !';
    }
}

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    checkForm();
    if (isFormValidated()){
        $username = isset($_POST['username'])? $_POST['username']: '';

        $_SESSION['username'] = $username;
        
        redirect_to('index_continent.php');
    }
} else { 
    
}

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="share/background.css">
    <style>
        label {
            font-weight: bold;
        }
        .error {
            color: #FF0000;
        }
        div.error{
            border: thin solid red; 
            display: inline-block;
            padding: 5px;
        }
        body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

.icon {
  padding: 10px;
  background: dodgerblue;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}

/* Set a style for the submit button */
.btn {
  background-color: dodgerblue;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
    </style>
</head>
<body>
<div class="container">
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post"  style="max-width:500px;margin:20%;">
    
    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && !isFormValidated()): ?> 
        <div class="error">
            <span> Please fix the following errors </span>
            <ul>
                <?php
                foreach ($errors as $key => $value){
                    if (!empty($value)){
                        echo '<li>', $value, '</li>';
                    }
                }
                ?>
            </ul>
        </div><br><br>
    <?php endif; ?>
    <h1 style="color:white;text-align:center;">Log in</h1>

        <div class="input-container">
            <i class="fa fa-user icon"></i>
            <input type="text" id="username" name="username" class="input-field" 
                    value="<?php echo isFormValidated()? '': $_POST['username'] ?>">
        </div>

  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input type="password" id="pwd" name="pwd"  class="input-field"
            value="<?php echo isFormValidated()? '': $_POST['pwd'] ?>"> 
  </div>
  <button type="submit" class="btn" value="Login">Login</button>

    </form>
</div>
    <script src="bootstrap/js/jquery-2.2.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>