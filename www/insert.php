<?
include("classes/db.php");

if(isset($_POST["title"])){
    $db = new Database();
    $db->connect();

    $id = $_POST['section_select'];
    $create = date("Y-m-d");
    $modify = date("Y-m-d");

    $db->insert('section', array($_POST['title'], $create, $modify, $_POST['description'], $id), 'Title, Create_date, Modify_date, Description, PID');
    $res = $db->getResult();
    print_r($res);    
}
else if (isset($_POST["titleElem"])){
    $db = new Database();
    $db->connect();

    $id = $_POST['section_select'];
    $create = date("Y-m-d");
    $modify = date("Y-m-d");

    $db->insert('element', array($_POST['titleElem'], $id, $create, $modify, $_POST['description'], $_POST['type']), 'Title_element, ID_section, Create_date, Modify_date, Description, Type');
    $res = $db->getResult();
    print_r($res);
}

?>