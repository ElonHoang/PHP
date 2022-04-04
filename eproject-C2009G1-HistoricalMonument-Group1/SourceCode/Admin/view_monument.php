<?php 
    require_once('lib/database.php');
    require_once('lib/function.php');
    $id = $_GET['monumentid'];
    $monument = find_monuments_by_id($id);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding:0 0 0 10% ;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
/* Style the buttons */
.btn {
  border: none;
  outline: none;
  padding: 12px 16px;
  background-color: #f1f1f1;
  cursor: pointer;
}

.btn:hover {
  background-color: #ddd;
}

.btn.active {
  background-color: #666;
  color: white;
}
</style>
</head>
<body>
<?php include('share/nav_bar.php');?>

<h1 style="text-align: center;" ><?php echo $monument['monumentname'];?></h1>

<div id="btnContainer">
  <button class="btn" onclick="listView()"><i class="fa fa-bars"></i> List</button> 
  <button class="btn active" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
</div>
<br>

<div class="row">
  <div class="column" style="background-color:#aaa;">
    <h2>Continent:</h2>
    <p><?php echo $monument['continentname']?></p>
  </div>
  <div class="column" style="background-color:#bbb;">
    <h2>Nation:</h2>
    <p><?php echo $monument['nation'] ?></p>
  </div>
</div>

<div class="row">
  <div class="column" style="background-color:#ccc;">
    <h2>Detail:</h2>
    <p><?php echo $monument['detail'] ?></p>
  </div>
  <div class="column" style="background-color:#ddd;">
    <h2>History:</h2>
    <p><?php echo $monument['history'] ?></p>
  </div>
</div>

<div class="row">
  <div class="column" style="background-color:#ccc;">
    <h2>Foundation:</h2>
    <p><?php echo $monument['foundation'] ?></p>
  </div>
  <div class="column" style="background-color:#ddd;">
    <h2>Recognition:</h2>
    <p><?php echo $monument['recognition'] ?></p>
  </div>
</div>

<script>
// Get the elements with class="column"
var elements = document.getElementsByClassName("column");

// Declare a loop variable
var i;

// List View
function listView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "100%";
  }
}

// Grid View
function gridView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "50%";
  }
}

/* Optional: Add active class to the current button (highlight it) */
var container = document.getElementById("btnContainer");
var btns = container.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>

</body>
</html>
