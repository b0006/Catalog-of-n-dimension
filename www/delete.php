<?
include("classes/db.php");

if (isset($_POST['section_select'])){
    
    $db = new Database();
    $db->connect();
    
    $id = $_POST['section_select'];
    
    //защита от удаления (на случай, если пользователь не выбрал раздел, но нажал УДАЛИТЬ)
    if($id != -1) {
    
        $db->delete('section', 'ID='.$id);
        $del_id = $db->getResult();

        $db->delete('section', 'PID='.$id);
        $del_pid = $db->getResult();

        //удаление элементов, пренадлижащих к несуществующему разделу (который удалили)
        $db->delete('element', 'ID_section='.$id);
        $del_el = $db->getResult(); 
    }
}
else if (isset($_POST['ID_sectionElem'])){
    $db = new Database();
    $db->connect();
    
    $id = $_POST['ID_sectionElem'];
    
    $db->delete('element', 'ID='.$id);
    $del_el = $db->getResult();
    
}
?>