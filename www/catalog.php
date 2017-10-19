<?
//подключаем класс для работы с БД
include("classes/db.php");
?>

<div class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm" id="catalog">
    <a class="navmenu-brand visible-md visible-lg" href="#">Каталог</a>

    <?
    
    if(isset($_POST['submit'])){
        //создаем подключение к БД
        $db = new Database();
        $db->connect();

        //выборка таблицы "section"
        $db->select('section', '*', null, 'Title');
        $res_sec = $db->getResult();

        //выборка таблицы "element"
        $db->select('element');
        $res_elem = $db->getResult();

        // рекурсивная функция, которая сформирует дерево категорий
        function create_tree ($sec, $elem, $parent_id){

            $tree = '<ul>';

            for($i =0; $i < count($sec); $i++) {
                if($sec[$i]["PID"] == $parent_id) {
                    $tree .= "<li>".$sec[$i]['Title'];
                    $tree .=  create_tree ($sec, $elem, $sec[$i]['ID']);

                    for($k = 0; $k < count($elem); $k++){
                        if($elem[$k]["ID_section"] == $sec[$i]["ID"]) {
                            $tree .= "<ul>".$elem[$k]["Title_element"]."</ul>";
                        }
                    }
                    $tree .= '</li>';
                }
                else {
                    echo "  ";
                }
            }
            $tree .= '</ul>';               

            return $tree;        
        }

        // вызываем функцию и строим дерево
        print_r (create_tree ($res_sec, $res_elem, -1));  
    }
    else {
        //создаем подключение к БД
        $db = new Database();
        $db->connect();

        //выборка таблицы "section"
        $db->select('section');
        $res_sec = $db->getResult();

        //выборка таблицы "element"
        $db->select('element');
        $res_elem = $db->getResult();

        // рекурсивная функция, которая сформирует дерево категорий
        function create_tree ($sec, $elem, $parent_id){

            $tree = '<ul>';

            for($i =0; $i < count($sec); $i++) {
                if($sec[$i]["PID"] == $parent_id) {
                    $tree .= "<li>".$sec[$i]['Title'];
                    $tree .=  create_tree ($sec, $elem, $sec[$i]['ID']);

                    for($k = 0; $k < count($elem); $k++){
                        if($elem[$k]["ID_section"] == $sec[$i]["ID"]) {
                            $tree .= "<ul>".$elem[$k]["Title_element"]."</ul>";
                        }
                    }
                    $tree .= '</li>';
                }
                else {
                    echo "  ";
                }
            }
            $tree .= '</ul>';               

            return $tree;        
        }

        // вызываем функцию и строим дерево
        print_r (create_tree ($res_sec, $res_elem, -1));  
    }
    
    
    
    ?>
</div>