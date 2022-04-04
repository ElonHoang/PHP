<?php 
require_once('lib/database.php');
 require_once('lib/function.php');
if(isset($_POST['submit']) && isset($_FILES['img_link'])){
    $img_name = $_FILES['img_link']['name'];
    $img_size = $_FILES['img_link']['size'];
    $tmp_name = $_FILES['img_link']['tmp_name'];
    $error = $_FILES['img_link']['error'];
    if($error === 0){
        if($img_size > 10000000){
            $display = "Sorry, your file is too large !";
            redirect_to('add_image.php');
        }else {
           $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
           $img_extension_lower = strtolower($img_extension);
           $allowed_img = array("jpg", "jpeg", "png","jfif");

           if(in_array($img_extension_lower, $allowed_img)){
            $new_img_name = uniqid("IMG-", true).'.'.$img_extension_lower;
            $img_upload_in_IMG = 'uploads/'.$new_img_name;
            move_uploaded_file($tmp_name, $img_upload_in_IMG);
            $image = [];
            $image['embedlink']= $new_img_name;
            $image['monumentid'] = $_POST['monument'];
            insert_gallery($image);
            redirect_to('index_image.php');

           }else {
            $display = "You cant upload files of this type !";
            redirect_to('add_image.php');
           }
        }
    }else {
        $display = "UNknown error ocus !";
        redirect_to('add_image.php');
    }

}else {
    redirect_to('add_image.php');

}
?>
<br><br>
<a href='index_image.php'>>>Go to view</a>
<?php
db_disconnect($db);
?>