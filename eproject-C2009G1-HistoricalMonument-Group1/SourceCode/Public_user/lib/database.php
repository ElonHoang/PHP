<?php 
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD","");
define("DB_NAME", "historical_monuments");

function db_connect(){
    $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    return $connect;
}
$db = db_connect();

function db_disconnect($connect){
    if(!isset($connect)){
        mysqli_close($connect);
    }
}
function confirm_query_result($result){
    global $db;
    if(!$result){
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }else {
        return $result;
    }
}

function display_monuments($monumentimg){
    global $db;

    $sql = "SELECT g.*,m.* FROM monuments as m ";
    $sql .= "join gallery as g on m.monumentid = g.monumentid ";
    $sql .= "WHERE g.imgid='" . $monumentimg . "'";
    $result = mysqli_query($db, $sql);
    $monumentimg = mysqli_fetch_assoc($result);

    return $monumentimg;
}

function search($monument) {
    global $db;
    $sql = "select monumentid, monumentname from monuments ";
    $sql .= "where monumentname like'%".$monument."%'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    return $result;
}

function select_monument_by_id($id){
    global $db;

    $sql = "SELECT m.*, c.continentname FROM monuments as m ";
    $sql .= "join continents as c on c.continentid = m.continentid ";
    $sql .= "WHERE  m.monumentid='" . $id . "' ";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $monument = mysqli_fetch_assoc($result);
    return $monument;
}

function find_all_img($id) {
    global $db;
    $sql = "select embedlink from gallery ";
    $sql .= "where monumentid = '".$id."'";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result) ;
}

function display_gallery(){
    global $db;
    $sql = "SELECT * FROM gallery as g ";
    $sql .= "join monuments as m on g.monumentid=m.monumentid  ";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function add_feedback($feedback){
    global $db;
    $sql = "insert into feedback ";
    $sql .= "(sendername,comment,visible,monumentid)";
    $sql .= " values (";
    $sql .= "'".$feedback['sendername']."',";
    $sql .= "'".$feedback['comment']."',";
    $sql .= "'No',";
    $sql .= "'".$feedback['monumentid']."'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function feedback($monument) {
    global $db;
    $sql = "select * from feedback ";
    $sql .= "where monumentid ='".$monument['monumentid']."'";
    $sql .= "and visible = 'Yes'";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}


function display_kiquan(){
    global $db;
    $sql = "SELECT * FROM monuments ";
    $sql .= "WHERE worldwonder='Yes'";
    $result = mysqli_query($db, $sql);
    return $result;

}

function display_continent(){
    global $db;

    $sql = "SELECT * FROM continents ";
    $result = mysqli_query($db, $sql);
    return $result;
}

function h_m_in_continent($id){
    global $db;

    $sql = "SELECT *  FROM monuments ";
    $sql .= "WHERE continentid='" . $id . "' ";
    $result = mysqli_query($db, $sql);
    return  $result;
}

function img_from_monument_id($continent_hm) {
    global $db;
    
    $sql = "select embedlink from gallery ";
    $sql .= "where monumentid ='".$continent_hm."' ";
    $sql .= "limit 1";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $img=mysqli_fetch_assoc($result);
    return $img;
}

function find_all_monument($monument){
    global $db;
    
    $sql = "select monumentname,nation, detail,history,foundation,recognition from monuments";
    $sql .= " where monumentid ='".$monument."'";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result) ;
}

?>


