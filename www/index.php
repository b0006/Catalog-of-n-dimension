<?include("header.php");?>

<html>
    <head>
        <title>Редактирование каталога</title>              
    </head>

    <body>
       
        <!-- ФОРМА ДОБАВЛЕНИЯ РАЗДЕЛА -->
        <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Добавить раздел</h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="insert.php" id="addForm">
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Название раздела</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="title" required="required">
                                      </div>
                                    </div>
                                    
                                    <div class="form-group row hide">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Дата создания</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="create">
                                      </div>
                                    </div>
                                    <div class="form-group row hide">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Дата модификации</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="modify">
                                      </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Описание</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="description" required="required">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Родительский раздел</label>
                                      <div class="col-md-10" name="name">
                                        <?
                                          //include('select.php');
        
                                          
                                        $db = new Database();
                                        $db->connect();

                                        $db->select('section');
                                        $list = $db->getResult();

                                        echo '<select name="section_select" class="form-control">';
                                        echo '<option selected value="-1">Корневой раздел</option>';

                                        for($i = 0; $i < count($list); $i++) {
                                            echo '<option value="'.$list[$i]["ID"].'">'.$list[$i]["Title"].'</option>';
                                        }

                                        echo '</select>';

                                        ?>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Создать" class="btn btn-success"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
        
        <!-- ФОРМА РЕДАКТИРОВАНИЯ РАЗДЕЛА -->
        <div class="modal fade update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Редактирование раздел</h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="update.php" id="updateForm">
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Выберите раздел</label>
                                      <div class="col-md-10" name="edit">
                                          <?
                                            //include('section_edit.php');
                                            
                                            $db = new Database();
                                            $db->connect();

                                            $db->select('section');
                                            $list = $db->getResult();

                                            echo '<select name="id" class="form-control">';

                                            for($i = 0; $i < count($list); $i++) {
                                                echo '<option value="'.$list[$i]["ID"].'">'.$list[$i]["Title"].'</option>';
                                            }

                                            echo '</select>';

                                            ?>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Новое название</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="title" required="required">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Новое описание</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="description" required="required">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Переместить раздел</label>
                                      <div class="col-md-10" name="name">
                                          <?
                                            //include('select.php');
                                            
                                            $db = new Database();
                                            $db->connect();

                                            $db->select('section');
                                            $list = $db->getResult();

                                            echo '<select name="pid" class="form-control">';
                                            echo '<option selected value="-1">Не перемещать раздел</option>';

                                            for($i = 0; $i < count($list); $i++) {
                                                echo '<option value="'.$list[$i]["ID"].'">'.$list[$i]["Title"].'</option>';
                                            }

                                            echo '</select>';

                                            ?>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Изменить" class="btn btn-primary"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
        
        <!-- ФОРМА УДАЛЕНИЯ РАЗДЕЛА -->
        <div class="modal fade delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Удалить раздел</h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="delete.php" id="deleteForm">
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Разделы</label>
                                      <div class="col-md-10" name="name">
                                          <?
                                            //include('select.php');
                                          
                                            $db = new Database();
                                            $db->connect();

                                            $db->select('section');
                                            $list = $db->getResult();

                                            echo '<select name="section_select" class="form-control">';
                                            echo '<option selected value="-1"></option>';

                                            for($i = 0; $i < count($list); $i++) {
                                                echo '<option value="'.$list[$i]["ID"].'">'.$list[$i]["Title"].'</option>';
                                            }

                                            echo '</select>';

                                            ?>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Удалить" class="btn btn-danger"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
        
        <!-- ------------------------------------------------------------------------------------ -->
        
        <!-- ФОРМА ДОБАВЛЕНИЯ ЭЛЕМЕНТА -->
        <div class="modal fade addElem" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Добавить элемент</h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="insert.php" id="addFormElem">
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Название элемента</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="titleElem" required="required">
                                      </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Разделы</label>
                                      <div class="col-md-10">
                                          <?
                                            //include('select.php');
                                            $db = new Database();
                                            $db->connect();

                                            $db->select('section');
                                            $list = $db->getResult();

                                            echo '<select name="section_select" class="form-control">';

                                            for($i = 0; $i < count($list); $i++) {
                                                echo '<option value="'.$list[$i]["ID"].'">'.$list[$i]["Title"].'</option>';
                                            }

                                            echo '</select>';

                                            ?>
                                      </div>
                                    </div>
                                    
                                    
                                    <div class="form-group row hide">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Дата создания</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="create">
                                      </div>
                                    </div>
                                    <div class="form-group row hide">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Дата модификации</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="modify">
                                      </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Описание</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="description" required="required">
                                      </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Тип</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="type" required="required">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Создать" class="btn btn-success"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
        
        <!-- ФОРМА РЕДАКТИРОВАНИЯ ЭЛЕМЕНТА -->
        <div class="modal fade updateElem" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Редактирование элемента</h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="update.php" id="updateFormElem">
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Выберите элемент</label>
                                      <div class="col-md-10">
                                          <?
                                            $db = new Database();
                                            $db->connect();
                                            
                                            $db->select('element');
                                            $result = $db->getResult();
                                            //print_r($result);

                                            echo '<select name="id_element" class="form-control">';

                                            for($i = 0; $i < count($result); $i++) {
                                                echo '<option value="'.$result[$i]["ID"].'">'.$result[$i]["Title_element"].'</option>';
                                            }

                                            echo '</select>';

                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Новое название</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="titleElem" required="required">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Новое описание</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="description" required="required">
                                      </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Новое тип</label>
                                      <div class="col-md-10">
                                        <input class="form-control" type="text" name="type" required="required">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Переместить элемент</label>
                                      <div class="col-md-10">
                                          <?
                                            /*$db = new Database();
                                            $db->connect();*/

                                            $db->select('section');
                                            $list = $db->getResult();

                                            echo '<select name="pid_element" class="form-control">';
                                            echo '<option selected value="0">Не перемещать элемент</option>';

                                            for($i = 0; $i < count($list); $i++) {
                                                echo '<option value="'.$list[$i]["ID"].'">'.$list[$i]["Title"].'</option>';
                                            }

                                            echo '</select>';

                                            ?>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Изменить" class="btn btn-primary"/>
                                    </div>
                                </form>
                           </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
        
        <!-- ФОРМА УДАЛЕНИЯ ЭЛЕМЕНТА -->
        <div class="modal fade deleteElem" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Удалить элемент</h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="delete.php" id="deleteFormElem">
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-md-2 col-form-label">Выберите элемент</label>
                                      <div class="col-md-10">
                                          <?
                                            $db = new Database();
                                            $db->connect();
                                            
                                            $db->select('element');
                                            $result = $db->getResult();
                                            //print_r($result);

                                            echo '<select name="ID_sectionElem" class="form-control">';

                                            for($i = 0; $i < count($result); $i++) {
                                                echo '<option value="'.$result[$i]["ID"].'">'.$result[$i]["Title_element"].'</option>';
                                            }

                                            echo '</select>';

                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Удалить" class="btn btn-danger"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Разделы</h2>
                    <div class="btn-group btn-group-vertical">
                        <a class="btn btn-success" data-toggle="modal" data-target=".add">Добавить</a>
                        <a class="btn btn-primary" data-toggle="modal" data-target=".update">Редактировать</a>
                        <a class="btn btn-danger" data-toggle="modal" data-target=".delete">Удалить</a>
                    </div>
                    <form id="sort" action="catalog.php" method="post">
                        <input name="submit" class="btn btn-default" type="submit" value="Сортировать по наименованию">
                    </form>      
                </div>
                <div class="col-md-4">
                    <h2>Элементы</h2>
                    <div class="btn-group btn-group-vertical">
                        <a class="btn btn-success" data-toggle="modal" data-target=".addElem">Добавить</a>
                        <a class="btn btn-primary" data-toggle="modal" data-target=".updateElem">Редактировать</a>
                        <a class="btn btn-danger" data-toggle="modal" data-target=".deleteElem">Удалить</a>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </body>
</html>

<?include("footer.php");?>
