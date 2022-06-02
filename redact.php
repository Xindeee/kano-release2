<? 
$host = 'localhost';
$db = 'kano';
$username = 'postgres';
$password = 'ubnkby02';

$conn = "host=$host port=5432 dbname=$db user=$username password=$password";
$dbconn = pg_connect($conn);


// $id = $_GET['id'];

// var_dump($id);

// $sql_name = pg_query("SELECT title FROM poll WHERE id = $id");
// $sql_cat = pg_query("SELECT title FROM category WHERE poll_id = $id");
// $sql_func = pg_query("SELECT title FROM function WHERE poll_id = $id");

// $name = pg_fetch_assoc($sql_name);
// var_dump($name);


?>

<?php
session_start();

// require_once("settings.php");
// require_once("dbqueries.php");

// $pageurl = explode('/', $_SERVER['REQUEST_URI']);
// $pageurl = $pageurl[count($pageurl) - 1];
// $_SESSION['username'] = '';

// if ($pageurl != 'login.php')
// {
//   include_once('auth_ssh.class.php');
//   $au = new auth_ssh();
//   if (!$au->loggedIn()) {
//     header('Location:login.php');
//     exit;
//   }
//   else {
//     $query = get_current_user($au->getUserId());
//     $result = pg_query($query);
//     if ($row = pg_fetch_assoc($result))
//     $_SESSION['username'] = $row['fio'];
//   }
// }

// function show_breadcrumbs(&$breadcrumbs)
// {
//   if (count($breadcrumbs) < 1)
//     return;

//   echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
//   echo '<div class="container-fluid">';
//   echo '<nav aria-label="breadcrumb">';
//   echo '<ol class="breadcrumb">';
//   foreach ($breadcrumbs as $name => $link) {
//     echo '<li class="breadcrumb-item">';
//     echo '<a href="' . $link . '">' . $name . '</a>';
//     echo '</li>';
//   }
//   echo '</ol>';
//   echo '</nav>';
//   echo '</div>';
//   echo '</ul>';
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>536 Акселератор - Редактор опроса</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <!-- extra -->
  <link rel="stylesheet" href="css/accelerator.css" />
  <link href="css/index.css" rel="stylesheet">
  <link href="css/place.css" rel="stylesheet">
  <link rel="stylesheet" href="css/input.css">
  <link rel="stylesheet" href="css/close.css">

  <script>
    var countOfFields = 1; // Текущее число полей
    var curFieldNameId = 1; // Уникальное значение для атрибута name
    var maxFieldLimit = 100; // Максимальное число возможных полей

    function deleteField(a) {
      // Получаем доступ к ДИВу, содержащему поле
      var contDiv = a.parentNode;
      // Удаляем этот ДИВ из DOM-дерева
      contDiv.parentNode.removeChild(contDiv);
      // Уменьшаем значение текущего числа полей
      countOfFields--;
      // Возвращаем false, чтобы не было перехода по сслыке
      return false;
    }

    function addFieldCat() {
      // Проверяем, не достигло ли число полей максимума
      if (countOfFields >= maxFieldLimit) {
        alert("Число полей достигло своего максимума = " + maxFieldLimit);
        return false;
      }
      // Увеличиваем текущее значение числа полей
      countOfFields++;
      // Увеличиваем ID
      curFieldNameId++;
      // Создаем элемент ДИВ
      var div = document.createElement("div");
      // Добавляем HTML-контент с пом. свойства innerHTML
      div.innerHTML = '<div class="row g-3"><div class="col"> <input name="category[]" type="text" class="form-control"> </div></div> <a href="#" class="ms-2 d-flex justify-content-center align-items-center px-3 py-1 bg-dark text-white rounded">X</a>'
      // div.innerHTML = '<input name="name_" + curFieldNameId + "" type="text" /> <a onclick="return deleteField(this)" href="#">[X]</a>';
      // Добавляем новый узел в конец списка полей
      document.getElementById("parentId").appendChild(div);
      // Возвращаем false, чтобы не было перехода по сслыке
      return false;
    }

    function addFieldFun() {
      // Проверяем, не достигло ли число полей максимума
      if (countOfFields >= maxFieldLimit) {
        alert("Число полей достигло своего максимума = " + maxFieldLimit);
        return false;
      }
      // Увеличиваем текущее значение числа полей
      countOfFields++;
      // Увеличиваем ID
      curFieldNameId++;
      // Создаем элемент ДИВ
      var div = document.createElement("div");
      // Добавляем HTML-контент с пом. свойства innerHTML
      div.innerHTML = '<p><div class="w-100 d-flex"> <input type="text" class="form-control w-100" name="functions[]"> <a href="#" class="ms-2 d-flex justify-content-center align-items-center px-3 py-1 bg-dark text-white rounded" onclick="return deleteField(this)">X</a></div></p>'
      document.getElementById("parentId").appendChild(div);
      // Возвращаем false, чтобы не было перехода по сслыке
      return false;
    }
  </script>


</head>

<body>
<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-warning navbar-light px-4 "> 
      <!-- Container wrapper -->
        <div class="container-fluid" >
            <ul class="navbar-nav d-flex flex-row me-1">
                <li> <a href="//localhost/index.php" class="font-weight-bold" style="color:black">Анализ кано</a></li>
                <li> <span class="ml-2" style="margin-left: 10px;">Редактор опроса</span></li>
            </ul>
        </div>
        <!-- Navbar brand -->
        <a class="navbar-brand" href="index.php"><b></b></a>
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <?php
          // show_breadcrumbs($breadcrumbs);

          //if (array_key_exists('username', $_SESSION) && $_SESSION['username'] != '') {
          ?>
            <!-- Icons -->
            <ul class="navbar-nav d-flex flex-row me-1">
              <!-- Notifications -->
              <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink1" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell fa-lg"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink1">
                <li><a class="dropdown-item" href="#">test1<br>
                    <button class="" type="button" style="float:right;line-height:12px;"><i class="fas fa-times"></i></button>
                  </a></li>
                <li><a class="dropdown-item" href="#">test2<br>
                    <button class="" type="button" style="float:right;line-height:12px;"><i class="fas fa-times"></i></button>
                  </a></li>
                <li><a class="dropdown-item" href="#">test3<br>
                    
                    <button class="" type="button" style="float:right;line-height:12px;"><i class="fas fa-times"></i></button>
                  </a></li>
                <li><a class="dropdown-item" href="#">test4<br>
                     
                    <button class="" type="button" style="float:right;line-height:12px;"><i class="fas fa-times"></i></button>
                  </a></li>
              </ul>
            </ul>
            <ul class="navbar-nav d-flex flex-row me-1">
              <!-- Avatar -->
              <a class="dropdown-toggle d-flex align-items-center hidden-arrow text-reset" href="#" id="navbarDropdownMenuLink2" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                <!-- <img src="img/user-24.png" class="rounded-circle" height="25" alt="" loading="lazy"/>-->
                <button type="button" class="btn btn-floating"><i class="fas fa-user-alt fa-lg"></i>
                   
                </button>
                 <span class="text-reset ms-2">Антон Кузнецов</span>
                <!--<span class="text-reset ms-2"><?= $_SESSION['username'] ?></span>-->
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink2">
                <li><a class="dropdown-item" href="profile.php">Профиль</a></li>
                <li><a class="dropdown-item" href="login.php?action=logout">Выйти</a></li>
              </ul>
            </ul>
          <?php
         // }
          ?>
        </div>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>

  <div class="container mt-5">
    <div class="row font-weight-bold">ЛЕНТА СНИМКОВ ДОСКИ</div>

    <div class="row">

      <form action="post.php" method="post" class="p-0">
      <label class="d-flex mt-3">Название проекта
          <input type="text" class="ms-auto form-control w-75" name = 'name'>
        </label>

        <label class="d-flex mt-3 w-50">
          Категории пользователей
          <div class="d-flex w-50 ms-auto flex-column">
            <div class="d-flex" id="parentId">
              <input type="text" class="form-control w-100" name='category[]'>
              
            </div>
            <a href="#"  onclick="return addFieldCat()" class="btn btn-dark w-50 mt-2">Добавить</a>
          </div>
        </label>

        <label class="d-flex mt-3 w-100">
          Функции / характеристики
          <div class="d-flex w-75 ms-auto flex-column">
            <div class="w-100 d-flex" id="parent">
              <input type="text" class="form-control w-100" name='functions[]'>
              </div>
            <a href="#" onclick="return addFieldFun()" class="btn btn-dark w-50 mt-2">Добавить</a>
          </div>
        </label>

      </form>

      
    </div>

    <div class="my-4 bg-dark hr"></div>

    <div class="row">
      <div class="d-flex">
        Ответы
        <div class="d-flex w-75 ms-auto text-start align-items-center">
          Получено: <span>22</span>
          <a href="#" class="py-1 px-2 rounded bg-dark text-white ms-4">Просмотр</a>
        </div>
      </div>

      <div class="d-flex mt-3">
        Отправить ссылку
        <div class="d-flex w-75 ms-auto text-start flex-column">
          <form action="">
            <label class="d-flex w-100 align-items-center">Категория пользователей
              <select class="form-select w-25 ms-3" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </label>
            <label class="d-flex w-100 align-items-center my-3">
              Аутентификация
              <div class="d-flex justify-content-between">
                <select class="form-select w-25 ms-3" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>

                <label class="d-flex align-items-center" disabled>
                  Логин
                  <input type="text" class="form-control ms-2">
                </label>
              </div>
            </label>
            <label class="d-flex">
              <a href="#" class="py-1 px-3 bg-dark text-white rounded">Сделать индивидуальную ссылку</a>
              <a href="#" class="py-1 px-3 bg-dark text-white ms-3 rounded">Сделать общую ссылку</a>
            </label>
          </form>
        </div>
      </div>

      <div class="d-flex mt-3">
        Приём ответов
        <div class="d-flex w-75 ms-auto text-start">
          <a href="" class="py-1 px-3 rounded text-white bg-dark" disabled>Открыть</a>
          <a href="" class="py-1 px-3 rounded text-white bg-danger ms-2">Закрыть</a>
        </div>
      </div>
    </div>
    <p></p>
    <p><a href="#" type="submit" value="Сохранить" name="done" class="btn btn-dark">Сохранить</a></p>
  </div>

  

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>

<?php
// }

//     // function show_message($message)
//     // {
//         if ($message == null || $message['mtype'] == null) return;
//         $message_style = ($message['mtype'] == 1) ? 'message-prep' : 'message-stud';
//         $message_text = $message['mtext'];
//         if ($message['mfile'] != null) // have file attachment
//         {
//             // to be usefull image preview need: 1) scale to max message size 2) make big preview or link to big image and
//             //if (preg_match('/\.(gif|png|jpg|jpeg|bmp|tif|tiff|ico|svg)$/i', $message['mfile'])) // file is image, inline it
//             //    $message_text = "<img src='" . $message['murl'] . "' alt='" . $message['mfile']. "'/><br/>";
//             //else
//             if ($message['murl'] != null) // file is attachment, add link to open in new window
//                 $message_text = "<a target='_blank' download href='" . $message['murl'] . "'><i class='fa fa-paperclip' aria-hidden='true'></i> " . $message['mfile']. "</a><br/>" . $message_text;
//             else // file is text content, add link to open in new window
//                 $message_text = "<a target='_blank' download href='message_file.php?id=" . $message['fid'] . "'><i class='fa fa-paperclip' aria-hidden='true'></i> " . $message['mfile'] . "</a><br/>" . $message_text;
//         }
//         if ($message['mreply'] != null) // is reply message, add citing
//             $message_text = "<p class='note note-light'>" . $message['mreply'] . "</p>" . $message_text;
//         if ($message['amark'] == null && $message['mtype'] == 0 && $message['mstatus'] == 0) // is student message not viewed/answered, no mark, add buttons answer/mark
//             $message_text = $message_text . "<br/><a href='javascript:answerPress(2," . $message['mid'] . "," . $message['max_mark'] . ")' type='message' class='btn btn-outline-primary'>Зачесть</a> <a href='javascript:answerPress(0," . $message['mid'] . ")' type='message' class='btn btn-outline-primary'>Ответить</a>";
//
?>
<!--        <div class="popover message <?= $message_style ?>" role="listitem"><div class="popover-arrow"></div><h3 class="popover-header" title="Переписка с: <?= $message['fio'] ?>, <?= $message['grp'] . "\nЗадание: " . $message['task'] ?>">@<?= $message['mlogin'] ?> <?= $message['mtime'] ?></h3><div class="popover-body"><?= $message_text ?></div></div>
<?
