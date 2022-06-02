<?php
    $host='localhost';
    $db = 'kano';
    $username = 'postgres';
    $password = 'ubnkby02';

    $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
    //  try{
    //  $conn = new PDO($dsn);
    //  if($conn){
    //  echo "Connected to the <strong>$db</strong> database successfully!";
    $conn = "host=$host port=5432 dbname=$db user=$username password=$password";
    $dbconn = pg_connect($conn);
    if($dbconn){
       echo "Connected to the <strong>$db</strong> database successfully!";}

$name = $_POST['name'];
$owner = 'from_login';

// вставка названия опросника и создателя в бд(отдельная отаблица poll)
pg_query("INSERT INTO poll (title, open, owner) values ('$name',False,'$owner')");

// получаение id опросника
$sql = pg_query("SELECT MAX(id) FROM poll WHERE title = '$name'");
$id = pg_fetch_assoc($sql);
$id = $id['max'];

// вставка категорий в бд (отдельная таблица category)
for ($i = 0; $i < count($_POST['category']); $i++){
    $category = $_POST['category'][$i];
    pg_query("INSERT INTO category (poll_id, title) values ('$id', '$category')");
}


// вставка функций/характеристик в бд(отдельная таблица function)
for ($i = 0; $i < count($_POST['functions']); $i++){
    $function = $_POST['functions'][$i];
    pg_query("INSERT INTO function (poll_id, title, comment) values ($id, '$function', NULL)");
}

 
//  $result = pg_query($conn, $result);
//  if (!$result) {
//    echo "Произошла ошибка.\n";
//    exit;
//  }

$new_url = 'https://localhost/index.php';
header('Location: '.$new_url);

?>