# Реализация каталога n-ой вложенности

<h1>Содержание</h1>
  <ul>
    <li><a href="#target">Задача</a></li>
    <li><a href="#database">Создание базы данных</a></li>
    <li><a href="#connect">Функция connect()</a></li>
    <li><a href="#disconnect">Функция disconnect()</a></li>
    <li><a href="#select">Функция select()</a></li>
    <li><a href="#insert">Функция insert()</a></li>
    <li><a href="#delete">Функция delete</a></li>
    <li><a href="#update">Функция update</a></li>
    <li><a href="#example">Пример работы с классом</a></li>
    <li><a href="#example">Пример работы с классом</a></li>
    <li><a href="#example">Пример работы с классом</a></li>
  </ul>
  
<h2 id="target">Задача</h2>
<p align="jusify">
  Реализовать древовидную структуру данных, произвольной вложенности.  Включающий следующий функционал:
  <ul>
    <li>добавление узла (раздел);</li>
    <li>удаление раздела;</li>
    <li>добавление элемента;</li>
    <li>удаление элемента;</li>
    <li>просмотр каталога;</li>
    <li>перенос элементов и разделов между разделами;</li>
    <li>редактирование элемента и раздела;</li>
    <li>реализация сортировки по наименованию.</li>
  </ul>
</p>
<p>Элемент, и раздел может быть привязан только к одному разделу.</p>
<p>Для хранения данных использовать базу данных (MySQL).</p>
<p>В качестве локального сервера выступает Denwer. Работа с БД осуществляется с помощью phpmyadmin.</p>

<h2 id="database">Создание базы данных</h2>

<h4>Структура БД</h4>
<p>Так как работа введется с разделами и элементами, создадим две таблицы: разделов (section) и элементов (element)</p>
<h4>section</h4>
  <ul>
    <li>ID раздела;</li>
    <li>наименование;</li>
    <li>дата создания;</li>
    <li>дата модфикации;</li>
    <li>описание;</li>
    <li>ID родительского раздела.</li>
  </ul>
<h4>element</h4>
  <ul>
    <li>ID элемента;</li>
    <li>ID раздела;</li>
    <li>наименование;</li>
    <li>дата создания;</li>
    <li>дата модфикации;</li>
    <li>тип элемента(новость, статья, отзыв, комментарий);</li>
    <li>описание.</li>
  </ul>

```sql
--
-- Структура таблицы `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Create_date` date NOT NULL,
  `Modify_date` date NOT NULL,
  `Description` text NOT NULL,
  `PID` int(10) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Структура таблицы `element`
--

CREATE TABLE IF NOT EXISTS `element` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_section` int(10) unsigned NOT NULL,
  `Title_element` varchar(255) NOT NULL,
  `Create_date` date NOT NULL,
  `Modify_date` date NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

```

<p align="jusify">Стоит отметить: в таблице "section" имеется поле "PID". Если это значение равно -1, значит данное поле находится в корневом разделе.</p>

<h2 id="db">Формируем класс для работы с БД</h2>
<p>Источником данного класса является данная статья: <a href="http://dnzl.ru/view_post.php%3Fid%3D250">Пример ООП с PHP и MySQL</a></p>
<p align="jusify">
  Существует множество различных, простых примеров, в которых приводится принцип работы ООП. Сегодня я решил показать вам, как работает ООП (Объектно-ориентированное, или объектное, программирование) в реальной жизни; особенно данный пример пригодится начинающим программистам. Создав класс под MySQL CRUD (CRUD — англ. create read update delete — «Создание чтение обновление удаление»), вы сможете легко создавать, читать, обновлять и удалять записи в любых ваших проектах, независимо от того, как спроектирована база данных.
</p>
<p>Для начала нам надо включить в класс основные функции для работы с MySQL. Потребуются следующие функции.</p>
<ul>
  <li>Select;</li>
  <li>Insert;</li>
  <li>Delete;</li>
  <li>Update;</li>
  <li>Connect;</li>
  <li>Disconnect.</li>
</ul>
<p>Ниже приведено определение нашего класса. Отметьте, что все методы, которые я создал, используют ключевое слово public.</p>

```php
class Database
{
    public function connect()       {   }
    public function disconnect()    {   }
    public function select()        {   }
    public function insert()        {   }
    public function delete()        {   }
    public function update()        {   }
}  
```

<h2 id="connect">Функция connect()</h2>
<p align="jusify">
Эта функция будет довольно простой, но прежде чем писать функцию, нам потребуется определить несколько переменных. Переменные должны быть доступны только в пределах класса, поэтому перед каждой переменной стоит ключевое слово private (закрытый). Все переменные (хост, имя пользователя, пароль, имя база данных) используются для соединения с базой данных MySQL. После этого мы сможем создать простой MySQL запрос к базе данных. Конечно, как программисты, мы должны ожидать от пользователей все что угодно, и исходя из этого, нам необходимо принять определенные меры предосторожности. Мы можем проверить: если пользователь уже подключен к базе данных, то , соответственно, ему не нужно повторно подключаться к БД. В противном случае, мы можем использовать учетные данные пользователя для подключения. 
</p>

```php
private db_host = ‘’; //хост
private db_user = ‘’; //логин
private db_pass = ‘’; //пароль
private db_name = ‘’; //название базы данных

    /*
     * Соединяемся с бд, разрешено только одно соединение
     */

public function connect()
{
    if(!$this->con)
    {
        $myconn = @mysql_connect($this->db_host,$this->db_user,$this->db_pass);
        if($myconn)
        {
            $seldb = @mysql_select_db($this->db_name,$myconn);
            if($seldb)
            {
                $this->con = true;
                return true;
            } else
            {
                return false;
            }
        } else
        {
            return false;
        }
    } else
    {
        return true;
    }
}
```

<p align="jusify">
  Как видите выше, мы используем базовые функции MySQL и делаем небольшую проверку на ошибки, чтобы все шло по плану. Если пользователь подключился к БД, мы возвращаем true , в ином случае возвращаем false. В качестве дополнительного бонуса устанавливаем переменную ( con ) в true, если соединение установлено.
</p>

<h2 id="disconnect">Функция disconnect()</h2>
<p align="jusify">
  Функция проверяет переменную соединения на существование. Если соединение установлено ( con есть), то закрываем соединение с БД MySQL и возвращаем true . Иначе делать ничего не нужно.
</p>

```php
public function disconnect()
{
    if($this->con)
    {
        if(@mysql_close())
        {
                       $this->con = false;
            return true;
        }
        else
        {
            return false;
        }
    }
}
```

<h2 id="select">Функция select()</h2>

<p align="jusify">
  Переходим к той части, где все немного усложняется. Мы начинаем работать с аргументами пользователя и возвращаем результаты запроса. У нас нет необходимости использовать результаты прямо сейчас, но нам необходимо создать переменную, в которой мы будем хранить пользовательские результаты по запросам из БД. Кроме того мы также создадим новую функцию, которая будет проверять существует ли данная таблица в БД. Эта функция будет создана отдельно, так как все наши CRUD операции потребуют такой проверки. Таким образом, это немного очистит наш код и в дальнейшем будет способствовать оптимизации кода. Ниже приведена функция для проверки таблиц ( tableExists ) и общедоступная переменная с результатами запросов.
</p>

```php
private $result = array();

/*
* Проверяем наличие таблицы при выполнении запроса
*
*/

private function tableExists($table)
{
    $tablesInDb = @mysql_query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
    if($tablesInDb)
    {
        if(mysql_num_rows($tablesInDb)==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
```

<p align="jusify">
  Эта функция просто проверяет наличие нужной таблицы в БД. Если таблица существует, вернет true , иначе вернет false .
</p>

```php
/*
* Выборка информации из бд
* Требуется: table (наименование таблицы)
* Опционально: rows (требуемые колонки, разделитель запятая)
*           where (колонка = значение, передаем строкой)
*           order (сортировка, передаем строкой)
*/

public function select($table, $rows = '*', $where = null, $order = null)
{
    $q = 'SELECT '.$rows.' FROM '.$table;
    if($where != null)
        $q .= ' WHERE '.$where;
    if($order != null)
        $q .= ' ORDER BY '.$order;
    if($this->tableExists($table))
    {
        $query = @mysql_query($q);
        if($query)
        {
            $this->numResults = mysql_num_rows($query);
            for($i = 0; $i < $this->numResults; $i++)
            {
                $r = mysql_fetch_array($query);
                $key = array_keys($r);
                for($x = 0; $x < count($key); $x++)
                {
                    // Sanitizes keys so only alphavalues are allowed
                    if(!is_int($key[$x]))
                    {
                        if(mysql_num_rows($query) > 1)
                            $this->result[$i][$key[$x]] = $r[$key[$x]];
                        else if(mysql_num_rows($query) < 1)
                            $this->result = null;
                        else
                            $this->result[$key[$x]] = $r[$key[$x]];
                    }
                }
            }
            return true;
        }
        else
        {
            return false;
        }
    }
    else
      return false;
}
```

<p align="jusify">
  На первый взгляд выглядит устрашающе, но при этом здесь мы делаем целую кучу важных вещей. Функция принимает четыре аргумента, один из которых обязательный. Функция вернет результат при наличии единственного аргумента - имени таблицы. Однако вы можете расширить количество аргументов и добавить новые аргументы, которые вы сможете использовать при работе с БД; ведь корректное исполнение функции зависит от одного аргумента – имени таблицы. Код в пределах функции служит для компиляции всех аргументов в select запрос. Как только запрос будет составлен, понадобится проверка на наличие в БД нужной таблицы – для этого используется функция tableExists . Если таблица найдена, то функция будет продолжена и запрос будет отправлен. Иначе все застопорится.
</p>
<p align="jusify">
  В следующей секции приведен действительно магический код. Суть в следующем: собрать данные запрошенные из таблицы. Затем присваиваем наш результат переменной. Чтобы упростить результат для конечного пользователя вместо числовых ключей будем использовать имена столбцов. В случае если количество строк таблицы больше единицы, на выходе вы получите двумерный массив, в котором первый ключ - это число (инкремент), второй ключ - это название колонки. Если в таблице всего одна строка, будет возвращен одномерный массив, название ключей которого соответствует именам столбцов таблицы. Если строк в таблице не найдено, переменной result будет присвоено значение null . Как я сказал ранее, все выглядит немного запутанным, но стоит вам разбить код на отдельные секции все станет гораздо проще и понятнее.
</p>

<h2 id="insert">Функция insert()</h2>

<p align="jusify">
  Эта функция немного проще, чем предыдущие. Она просто позволяет вставить информацию в БД. Таким образом, помимо имени таблицы нам потребуются дополнительные аргументы. Нам потребуется переменная, которая будет содержать соответствующие для вставки в таблицу значения. Затем мы просто отделим каждое значение запятой. Также мы проверяем при помощи функции tableExists наличие нужной таблицы и составляем insert запрос, манипулируя аргументами, переданными в функцию insert() . Затем отправляем наш запрос по нужному адресу.
</p>

```PHP
/*
* Вставляем значения в таблицу
* Требуемые: table (наименование таблицы)
*            values (вставляемые значения, передается массив  значений, например,
* array(3,"Name 4","this@wasinsert.ed"); )
* Опционально:
*             rows (название столбцов, куда вставляем значения, передается строкой,
*            например, 'title,meta,date'
*
*/

public function insert($table,$values,$rows = null)
{
    if($this->tableExists($table))
    {
        $insert = 'INSERT INTO '.$table;
        if($rows != null)
        {
            $insert .= ' ('.$rows.')';
        }
        for($i = 0; $i < count($values); $i++)
        {
            if(is_string($values[$i]))
                $values[$i] = '"'.$values[$i].'"';
        }
        $values = implode(',',$values);
        $insert .= ' VALUES ('.$values.')';
        $ins = @mysql_query($insert);
        if($ins)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
```

<h2 id="delete">Функция delete()</h2>

<p align="jusify">
  Эта функция просто удаляет таблицу или строки из нашей БД. Таким образом, нам надо передать в функцию имя таблицы и опциональный аргумент определяющий условие where . В условии следующим за ключевым словом WHERE следует уточнение: удалить строку, строки или всю таблицу. Если условие where опущено, то будут удалены все строки. Затем составляется запрос delete и следует выполнение запроса.
</p>

```php
/*
* Удаяем таблицу или записи удовлетворяющие условию
* Требуемые: таблица (наименование таблицы)
* Опционально: где (условие [column =  value]), передаем строкой, например, 'id=4'
*/

public function delete($table,$where = null)
{
    if($this->tableExists($table))
    {
        if($where == null)
        {
            $delete = 'DELETE '.$table;
        }
        else
        {
            $delete = 'DELETE FROM '.$table.' WHERE '.$where;
        }
        $del = @mysql_query($delete);
        if($del)
        {
            return true;
        }
        else
        {
           return false;
        }
    }
    else
    {
        return false;
    }
}
```

<h2 id="update">Функция update()</h2>
<p align="jusify">
  Наконец перейдем к нашей последней основной функции. Эта функция служит для обновления строки в БД новой информацией. Данная функция на первый взгляд сложна для понимания, однако, это не совсем так. Мы будем использовать все те же принципы, что и раньше. Например, аргументы будут использоваться для составления запроса update . Также мы проверим наличие таблицы при помощи метода tableExists . Если таблица существует, обновим надлежащую строку. Самая сложная часть, конечно, та, где мы занимаемся составлением запроса update . Поскольку оператор update имеет правило за раз обновлять все строки, нам необходимо учесть это и правильно отрегулировать этот момент. Итак, я решил условие where передавать как простой массив. Первый аргумент в этом массиве - имя столбца, следующий аргумент значений столбца. Таким образом, каждый четный номер (включай 0) соответствует имени колонки, а каждый нечетный номер содержит нечетное значение. Соответствующий код приведен ниже:
</p>

```php
for($i = 0; $i < count($where); $i++)
{
    if($i%2 != 0)
    {
        if(is_string($where[$i]))
        {
            if(($i+1) != null)
                $where[$i] = '"'.$where[$i].'" AND ';
            else
                $where[$i] = '"'.$where[$i].'"';
        }
    }
}
$where = implode($condition,$where);
```

<p align="jusify">
  В следующей секции мы создадим часть update оператора, настраивая переменные. Поскольку вы можете изменить любое числовое значение, я предпочел массив с ключами по названию столбца и новыми значениями. Таким образом, нам останется сделать проверку на тип значения и где нужно поставить запятую. Теперь, когда мы составили две основных части оператора update , завершить составление оператора update не составит труда, код представлен ниже:
</p>

```php
public function update($table,$rows,$where,$condition)
{
    if($this->tableExists($table))
    {
        // Parse the where values
        // even values (including 0) contain the where rows
        // odd values contain the clauses for the row
        for($i = 0; $i < count($where); $i++)
        {
            if($i%2 != 0)
            {
                if(is_string($where[$i]))
                {
                    if(($i+1) != null)
                        $where[$i] = '"'.$where[$i].'" AND ';
                    else
                        $where[$i] = '"'.$where[$i].'"';
                }
            }
        }
        $where = implode($condition,$where);
        $update = 'UPDATE '.$table.' SET ';
        $keys = array_keys($rows);
        for($i = 0; $i < count($rows); $i++)
       {
            if(is_string($rows[$keys[$i]]))
            {
                $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
            }
            else
            {
                $update .= $keys[$i].'='.$rows[$keys[$i]];
            }
            // Parse to add commas
            if($i != count($rows)-1)
            {
                $update .= ',';
            }
        }
        $update .= ' WHERE '.$where;
        $query = @mysql_query($update);
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}
```

<h2 id="example">Пример работы с классом</h2>

<p align="jusify">
  Для того, чтобы осуществить проверку, БД нужно заполнить несколькими полями.
</p>

```php
include('database.php'); //подключаем класс

$db = new Database();
$db->connect();

$db->select('section');
$res = $db->getResult();
print_r($res);
```

<p>
  На выходы, вы должны получить, примерно, следующее:
</p>

<pre>
Array {
    [0] => Array
    {
      [ID] => 1
      [Title] => Section_1
      [Create_data] => 2017-14-09
      [Modify_data] => 2017-14-09
      [Description] => Description of section_1
      [PID] => -1
    }
    [1] => Array
    {
      [ID] => 2
      [Title] => Section_2
      [Create_data] => 2017-14-09
      [Modify_data] => 2017-14-09
      [Description] => Description of section_2
      [PID] => 1
    }
}
</pre>

<h2 id="">Функиция формирования каталога</h2>

<p align="jusify">
  Так как каталог произвольной вложенности, значит нам понадобится воспользоваться рекурсией.
</p>

```php
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
```

<p align="jusify">
  Остальные функции удаления, добавления и обновления данных в БД аналогичны, поэтому примеры их вызовов показывать не буду. В исходном коде можете посмотреть.
</p>

<h2 id="exp">Приобретенный мною опыт</h2>
<ul>
  <li>Опыт работы с HTML, CSS и немного JavaScript (использовался AJAX для динамического обновление каталога);</li>
  <li>Закрепио основы ООП на языке PHP;</li>
  <li>Опыт работы с БД, в частности MySQL;</li>
  <li>Понял, что такое phpmyadmin и с чем его едят.</li>
</ul>

