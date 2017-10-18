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
  
</p>


<p align="jusify">
</p>
<p align="jusify">
</p>
<p align="jusify">
</p>
<p align="jusify">
</p>
