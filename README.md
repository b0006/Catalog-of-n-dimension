# Реализация каталога n-ой вложенности

<h1>Содержание</h1>
  <ul>
    <li><a href="#target">Задача</a></li>
    <li><a href="#database">Создание базы данных</a></li>
    <li><a href="#target">Задача</a></li>
    <li><a href="#target">Задача</a></li>
    <li><a href="#target">Задача</a></li>
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
</p>
<p align="jusify">
</p>
<p align="jusify">
</p>
<p align="jusify">
</p>
