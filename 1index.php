<?php

require_once 'init.php';


##DataStorage::registerUser('admin','letmein','','','','editor'
Routing::route($_REQUEST);
#wecho (date("Y-m-d H:m:s"));

#DataStorage::registerUser('admin','letmein','editor');


/*

#var_dump(DataStorage::getStudent(1, 2));
#session_start();
 



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

function show_breadcrumbs(&$breadcrumbs)
{
  // if (count($breadcrumbs) < 1)
  //   return;

  echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
  echo '<div class="container-fluid">';
  echo '<nav aria-label="breadcrumb">';
  echo '<ol class="breadcrumb">';
  // foreach ($breadcrumbs as $name => $link) {
  //   echo '<li cla ss="breadcrumb-item">';
  //   echo '<a href="' . $link . '">' . $name . '</a>';
  //   echo '</li>';
  // }
  echo '</ol>';
  echo '</nav>';
  echo '</div>';
  echo '</ul>';
}
$page_title = "Главная страница";
// function show_header($page_title = '', $breadcrumbs = array())
// {
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>536 Акселератор - <?= $page_title ?></title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <link href="css/index.css" rel="stylesheet">
  <link href="css/place.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <!-- extra -->
  <link rel="stylesheet" href="css/accelerator.css" />
</head>

<body>
<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-warning navbar-light px-4 "> 
      <!-- Container wrapper -->
        <div class="container-fluid" >
            <ul class="navbar-nav d-flex flex-row me-1">
                <li> <a href="//localhost/index.php" class="font-weight-bold" style="color:black">Анализ кано</a></li>
                <li> <span class="ml-2" style="margin-left: 10px;">Главная страница</span></li>
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

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
  <div class="grid">
    <div type="button" class="cn" style="height:100px;width:150px;background:#c5c5c5;" onclick='location.href="//localhost/kano-release2/create.php";'>
      <div class="plus radius"></div>
    </div>
  </div>

  <?php $host = 'localhost';
  $db = 'kano';
  $username = 'postgres';
  $password = 'letmein';

  $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
  //  try{
  //  $conn = new PDO($dsn);
  //  if($conn){
  //  echo "Connected to the <strong>$db</strong> database successfully!";
  $conn = "host=$host port=5432 dbname=$db user=$username password=$password";
  $dbconn = pg_connect($conn);
  // if($dbconn){
  //  echo "Connected to the <strong>$db</strong> database successfully!";}



  # Сделаем запрос на получение списка созданных таблиц

  //  $res = $conn->query("select table_name, column_name from information_schema.columns where table_schema='public'");

  //  # Выведем список таблиц и столбцов в каждой таблице

  //  while ($row = $res->fetch(PDO::FETCH_ASSOC)){
  //  echo($row["table_name"].'-'.$row["column_name"]);
  //  }

  //  # Добавим в созданную таблицу две строчки
  //  $conn->query("INSERT INTO testtable (id,number,name,kol) VALUES(1,'1', 'Name1','4')");
  //  $conn->query("INSERT INTO testtable (id,number,name,kol) VALUES(2,'2', 'Name2','4')");

  //  # Сделаем запрос на получение строк с id=2
  //  $res = $conn->query("select name, kol from testtable where id=2");

  //  # Выведем полученные строки
  //  while ($row = $res->fetch(PDO::FETCH_ASSOC)){
  //  echo($row["name"].'-'.$row["kol"]);
  //  }


  //  }catch (PDOException $e){
  //  echo $e->getMessage();
  //  }

  $result = "SELECT MAX(id) FROM poll";
  $a = pg_query($result);
  $id = pg_fetch_assoc($a);
  $id = $id['max'];

  ?>
      <div type="button" class="cn" style="height:100px;width:150px;background:#c5c5c5;" onclick='location.href="//localhost/redact.php?id=<? $id ?>";'>
      </div>
  
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
*/