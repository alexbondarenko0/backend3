<?php

header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('Результаты сохранены.');
  }
  include('form.php');
  exit();
}

$errors = FALSE;
$sila_list = ["immort", "invis", "fly", "telep", "fireb"];
$t_name = $_POST['fio'];
$t_mail = $_POST['mail'];
$t_birth = $_POST['birth'];
$t_gender = $_POST['gender'];
$t_hands = $_POST['hands'];
$t_biogr = $_POST['biogr'];
$sila_received = [];
if(key_exists('superpowers', $_POST)) {
    $sila_received = $_POST['superpowers'];
} else {;}
$t_sila_list = array(5);


for($i = 0; $i < 5; $i++) {
    if(!empty($sila_received) && in_array($sila_list[$i], $sila_received))
        {$t_sila_list[$i] = 1;}
    else
        {$t_sila_list[$i] = 0;}
}

if (empty($t_name) || !preg_match("/^[а-яА-Яa-zA-Z\\s]+$/u", $t_name)) {
  print('Неверно указано имя<br/>');
  $errors = TRUE;
} else if(empty($t_mail) || !preg_match("/^\\w+@[\\w\\.]+\\w\\.\\w+$/u", $t_mail)) {
    print('Неверно указана почта<br/>');
    $errors = TRUE;
} else if(empty($t_birth) || !is_numeric($t_birth)) {
    print('Неверно указан год рождения<br/>');
    $errors = TRUE;
} else if($t_birth < 1900 || $t_birth > 2000) {
    print('Год рождения должен быть от 1900 до 2020<br/>');
    $errors = TRUE;
} else if(empty($t_gender) || !in_array($t_gender, ["m", "f"])) {
    print('Укажите пол<br/>');
    $errors = TRUE;
} else if(empty($t_hands) || (!is_numeric($t_hands))) {
    print('Неверно указано количество конечностей<br/>');
    $errors = TRUE;
} else if($t_hands < 0 || $t_hands > 5) {
    print('Количество конечностей должно быть от 0 до 4<br/>');
    $errors = TRUE;
}

if ($errors) {
   exit();
}

$user = 'u20567';
$pass = '6987402';
$db = new PDO('mysql:host=localhost;dbname=u20567', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

try {
  $stmt = $db->prepare("INSERT INTO Application (name, mail, birth, gender, hands, biogr, sila_immort, sila_invis, sila_fly, sila_telep, sila_fireb) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt -> execute(array($t_name, 
  $t_mail, $t_birth, 
  $t_gender, 
  $t_hands, 
  $t_biogr, 
  $t_sila_list[0], 
  $t_sila_list[1], 
  $t_sila_list[2], 
  $t_sila_list[3], 
  $t_sila_list[4]));
}
catch(PDOException $e){
  print('Ошибка : ' . $e->getMessage());
  exit();
}
header('Location: ?save=1');
?>
