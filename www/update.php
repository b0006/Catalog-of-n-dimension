<?
include("classes/db.php");

if(isset($_POST['title'])){
   
    $id = $_POST['id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $pid = $_POST['pid'];

    $db = new Database();
    $db->connect();

    $db->update('section', array('Title' => $title, 'Modify_date' => date("Y-m-d"), 'Description' => $desc, 'PID' => $pid), array('ID', $id), '=');
    
    /*if($pid == 0){
        $db->update('section', array('Title' => $title, 'Modify_date' => date("Y-m-d"), 'Description' => $desc), array('ID', $id), '=');
    }
    else{
        $db->update('section', array('Title' => $title, 'Modify_date' => date("Y-m-d"), 'Description' => $desc, 'PID' => $pid), array('ID', $id), '=');
    }*/

    $res = $db->getResult();
    print_r($res);
}
else if (isset($_POST['titleElem'])){
   
    $id = $_POST['id_element'];
    $title = $_POST['titleElem'];
    $desc = $_POST['description'];
    $type = $_POST['type'];
    $pid = $_POST['pid_element'];

    $db = new Database();
    $db->connect();


    if($pid == 0){
        $db->update('element', array('Title_element' => $title, 'Modify_date' => date("Y-m-d"), 'Description' => $desc, 'Type' => $type), array('ID', $id), '=');
    }
    else{
        $db->update('element', array('ID_section' => $pid, 'Title_element' => $title, 'Modify_date' => date("Y-m-d"), 'Description' => $desc), array('ID', $id), '=');
    }

    $res = $db->getResult();
    print_r($res);
}
?>