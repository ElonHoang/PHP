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

function insert_continents($continent){
    global $db;
    $sql = "INSERT INTO continents ";
    $sql .= "(continentname)";
    $sql .= "VALUES (";
        $sql .= "'" . $continent['continentname'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result){
        return true;
    }else {
        echo mysqli_error($db);
        exit;
    }
}
function find_all_continents(){
    global $db;
    
    $sql = "SELECT * FROM continents ";
    $sql .= "ORDER BY continentname";
    $result = mysqli_query($db, $sql);
    return $result;

}
function find_continents_by_id($id){
    global $db;

    $sql = "SELECT * FROM continents ";
    $sql .= "WHERE continentid='" . $id . "' ";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $continent = mysqli_fetch_assoc($result);
    return $continent;
}

function update_continents($continent){
    global $db;

    $sql = "UPDATE continents SET ";
    $sql .= "continentname='" . $continent['continentname'] . "' ";
    $sql .= "WHERE continentid='" . $continent['continentid'] . "'";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function delete_continents($id){
    global $db;

    $sql = "DELETE FROM continents ";
    $sql .= "WHERE continentid='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function insert_monuments($monument){
    global $db;

    $sql = "INSERT INTO monuments ";
    $sql .= "(monumentname, nation, worldwonder, detail, history, foundation, recognition, continentid)";
    $sql .= "VALUES (";
        $sql .= "'" . $monument['monumentname'] . "', ";
        $sql .= "'" . $monument['nation'] . "', ";
        $sql .= "'" . $monument['worldwonder'] . "', ";
        $sql .= "'" . $monument['detail'] . "', ";
        $sql .= "'" . $monument['history'] . "', ";
        $sql .= "'" . $monument['foundation'] . "', ";
        $sql .= "'" . $monument['recognition'] . "', ";
        $sql .= "'" . $monument['continentname'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result){
        return true;
    }else {
        echo mysqli_error($db);
        exit;
    }
}

function find_all_monuments(){
    global $db;

    $sql = "SELECT m.* , c.continentname FROM monuments as m ";
    $sql .= "join continents as c on m.continentid = c.continentid";
    $result = mysqli_query($db, $sql);
    return $result;
}
function find_monuments_by_id($id){
    global $db;

    $sql = "SELECT m.*, c.continentname FROM monuments as m ";
    $sql .= "join continents as c on c.continentid = m.continentid ";
    $sql .= "WHERE m.monumentid='" . $id . "' ";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $monument = mysqli_fetch_assoc($result);
    return $monument;
}
function update_monuments($monument){
    global $db;

    $sql = "UPDATE monuments SET ";
        $sql .= "monumentname='" . $monument['monumentname'] . "', ";
        $sql .= "nation='" . $monument['nation'] . "', ";
        $sql .= "worldwonder='" . $monument['worldwonder'] . "', ";
        $sql .= "detail='" . $monument['detail'] . "', ";
        $sql .= "history='" . $monument['history'] . "', ";
        $sql .= "foundation='" . $monument['foundation'] . "', ";
        $sql .= "recognition='" . $monument['recognition'] . "', ";
        $sql .= "continentid='" . $monument['continentname'] . "' ";
        $sql .= "where monumentid = '". $monument['monumentid'] ."'";
        $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);

}
function delete_monuments($id){
    global $db;

    $sql = "DELETE FROM monuments ";
    $sql .= "WHERE monumentid='" . $id . "' ";
    $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}


function find_all_feedbacks(){
    global $db;
    
    $sql = "SELECT f.* , m.monumentname FROM feedback as f ";
    $sql .= "join monuments as m on m.monumentid = f.monumentid";
    $result = mysqli_query($db, $sql);
    return $result;

}
function find_feedbacks_by_id($id){
    global $db;

    $sql = "SELECT f.* , m.monumentname FROM feedback as f ";
    $sql .= "join monuments as m on m.monumentid = f.monumentid ";
    $sql .= "WHERE f.feedbackid ='" . $id . "' ";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $feedback = mysqli_fetch_assoc($result);
    return $feedback;
}

function update_feedbacks($feedback){
    global $db;

    $sql = "UPDATE feedback SET ";
    $sql .= "visible='" . $feedback['visible'] . "' ";
    $sql .= "WHERE feedbackid='" . $feedback['feedbackid'] . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function delete_feedbacks($id){
    global $db;

    $sql = "DELETE FROM feedback ";
    $sql .= "WHERE feedbackid='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function check_login($username,$password){
    global $db;

    $sql = "SELECT username, `password`  FROM `admin` ";
    $sql .= "WHERE username ='" . $username . "'";
    
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result)){
        $log = mysqli_fetch_assoc($result);
        if($log['username'] == $username && $log['password'] == $password){
            return true;
        }else
            return false;
    }else
        return false;
        
}
function insert_gallery($image){
    global $db;

    $sql = "INSERT INTO gallery ";
    $sql .= "(embedlink, monumentid )";
    $sql .= "VALUES(";
    $sql .= "'" . $image['embedlink'] . "', ";
    $sql .= "'" . $image['monumentid'] . "'";
$sql .= ")";
$result = mysqli_query($db, $sql);

}

function select_gallery(){
    global $db;

    $sql = "SELECT g.*, m.monumentname  FROM gallery as g ";
    $sql .= "join monuments as m on g.monumentid = m.monumentid ";
    $sql .= "ORDER BY imgid ";
    $result = mysqli_query($db, $sql);
    return $result;
}
function find_gallery_by_id($id){
    global $db;

    $sql = "SELECT g.*, m.monumentname  FROM gallery as g ";
    $sql .= "join monuments as m on g.monumentid = m.monumentid ";
    $sql .= "WHERE imgid='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $img_link = mysqli_fetch_assoc($result);
    return $img_link;
}
function delete_gallery($id){
    global $db;

    $sql = "DELETE FROM gallery ";
    $sql .= "WHERE imgid='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function update_gallery($image){
    global $db;

    $sql = "UPDATE gallery SET ";
    $sql .= "embedlink='" . $image['embedlink'] . "', ";
    $sql .= "monumentid= '" . $image['monumentid']. "' ";
    $sql .= "WHERE imgid='" . $image['imgid'] . "'";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

?>