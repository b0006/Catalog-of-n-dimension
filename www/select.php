<?
require_once('classes/db.php');

$db = new Database();
$db->connect();

$db->select('section');
$list = $db->getResult();

$tree = '<select name="section_select" class="form-control">';
$tree .= '<option selected value="-1">-----</option>';

for($i = 0; $i < count($list); $i++) {
    $tree .= '<option value="'.$list[$i]["ID"].'">'.$list[$i]["Title"].'</option>';
}

$tree .= '</select>';
    
echo $tree;
?>