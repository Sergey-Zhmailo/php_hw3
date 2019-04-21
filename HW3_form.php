<?php
session_start();
// Unset form_submitted
if (!empty($_GET['unset'])) {
    unset($_SESSION['form_submited']);
    unset($_SESSION['user_name']);
    unset($_SESSION['error_user_name']);
    unset($_SESSION['valid_user_name']);
    unset($_SESSION['user_email']);
    unset($_SESSION['error_user_email']);
    unset($_SESSION['valid_user_email']);
    unset($_SESSION['valid_day']);
    unset($_SESSION['error_day']);
    unset($_SESSION['valid_month']);
    unset($_SESSION['error_month']);
    unset($_SESSION['valid_year']);
    unset($_SESSION['error_year']);
    unset($_SESSION['valid_gender']);
    unset($_SESSION['error_gender']);
    unset($_SESSION['valid_message']);
    unset($_SESSION['error_message']);
    unset($_SESSION['translit']);
    header('Location: HW3.php', true, 301);
    exit;
}

// name validation
$_SESSION['user_name'] = trim($_POST['user_name']);
$arr_user_name = explode(' ', $_SESSION['user_name']);
if (empty($_POST['user_name'])) {
    $_SESSION['error_user_name'] = 'Поле Имя не заполнено!';
    unset($_SESSION['valid_user_name']);
} elseif (count($arr_user_name) > 1) {
    $_SESSION['error_user_name'] = 'Имя должно содержать одно слово!';
    unset($_SESSION['valid_user_name']);
    $arr_user_name = [];
} elseif (mb_strlen(trim($_POST['user_name']), 'utf-8') < 4) {
    $_SESSION['error_user_name'] = 'Имя должно содержать минимум 4 символа!';
    unset($_SESSION['valid_user_name']);
} elseif (mb_strlen(trim($_POST['user_name']), 'utf-8') > 15) {
    $_SESSION['error_user_name'] = 'Имя должно содержать не больше 15 символов!';
    unset($_SESSION['valid_user_name']);
} else {
    $_SESSION['valid_user_name'] = trim($_POST['user_name']);
    unset($_SESSION['error_user_name']);
}
// email validation
$_SESSION['user_email'] = trim($_POST['user_email']);
$arr_user_email = explode('@', $_SESSION['user_email']);
if (empty($_POST['user_email'])) {
    $_SESSION['error_user_email'] = 'Поле Email не заполнено!';
    unset($_SESSION['valid_user_email']);
} elseif (count(explode(' ', $_SESSION['user_email'])) > 1) {
    $_SESSION['error_user_email'] = 'Email не должен содержать пробелов!';
    unset($_SESSION['valid_user_email']);
    $arr_user_email = [];
} elseif (count($arr_user_email) == 1) {
    $_SESSION['error_user_email'] = 'Email должен содержать @!';
    unset($_SESSION['valid_user_email']);
    $arr_user_email = [];
} elseif (count($arr_user_email) > 2) {
    $_SESSION['error_user_email'] = 'Email должен содержать один @!';
    unset($_SESSION['valid_user_email']);
    $arr_user_email = [];
} else {
    $_SESSION['valid_user_email'] = trim($_POST['user_email']);
    unset($_SESSION['error_user_email']);
}
// date of birth validation
// day
if (empty($_POST['day']) || $_POST['day'] > 31 || $_POST['day'] < 1 || !is_numeric($_POST['day'])) {
    $_SESSION['error_day'] = 'День не выбран!';
    unset($_SESSION['valid_day']);
} else {
    $_SESSION['valid_day'] = $_POST['day'];
    unset($_SESSION['error_day']);
}
// month
if (empty($_POST['month']) || !is_numeric($_POST['month']) || $_POST['month'] < 1 || $_POST['month'] > 12) {
    $_SESSION['error_month'] = 'Месяц не выбран!';
    unset($_SESSION['valid_month']);
} else {
    $_SESSION['valid_month'] = $_POST['month'];
    unset($_SESSION['error_month']);
}
// year
if (empty($_POST['year']) || !is_numeric($_POST['year']) || $_POST['year'] < 1970 || $_POST['year'] > 2010) {
    $_SESSION['error_year'] = 'Год не выбран!';
    unset($_SESSION['valid_year']);
} else {
    $_SESSION['valid_year'] = $_POST['year'];
    unset($_SESSION['error_year']);
}
// date validation
$leap_year = '';
if ($_POST['year'] % 4 == 0) {
    $leap_year = $_POST['year'];
}
if ($_POST['day'] >= 30 && $_POST['month'] == 2) {
    $_SESSION['error_day'] = 'Несуществующая дата!';
    unset($_SESSION['valid_day']);
}
if ($_POST['day'] == 29 && $_POST['month'] == 2 && $leap_year != $_POST['year']) {
    $_SESSION['error_day'] = 'Несуществующая дата!';
    unset($_SESSION['valid_day']);
}
if ($_POST['day'] == 31 && $_POST['month'] % 2 == 0) {
    $_SESSION['error_day'] = 'Несуществующая дата!';
    unset($_SESSION['valid_day']);
}
$_SESSION['your_age'] = date('Y') - $_SESSION['valid_year'];
// gender validation
if (!empty($_POST['gender']) && ($_POST['gender'] == 1 || $_POST['gender'] == 2)) {
    $_SESSION['valid_gender'] = $_POST['gender'];
    unset($_SESSION['error_gender']);
} else {
    $_SESSION['error_gender'] = 'Не выбран пол!';
    unset($_SESSION['valid_gender']);
}
// message validation
$_SESSION['message'] = trim($_POST['message']);
if (empty($_SESSION['message'])) {
    $_SESSION['error_message'] = 'Введите сообщение!';
    unset($_SESSION['valid_message']);
} elseif (mb_strlen($_SESSION['message'], 'utf-8') < 25) {
    $_SESSION['error_message'] = 'Сообщение должно быть не короче 25 символов!';
    unset($_SESSION['valid_message']);
} else {
    $_SESSION['valid_message'] = trim($_POST['message']);
    unset($_SESSION['error_message']);
}
function clearMessage($badWords, $goodWords, $subject) {
    $cleanMessage = str_replace($badWords, $goodWords, $subject);
    return $cleanMessage;
}
$badwordsList = ['черт', 'блин', 'редиска'];
$goodWordsList = ['чертик','блинчик', 'редисочка'];
$_SESSION['valid_message'] = clearMessage($badwordsList, $goodWordsList, mb_strtolower($_SESSION['valid_message'], 'utf-8'));
// translit
$translit = $_SESSION['valid_message'];
$translit = strtr($translit, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
$translit = preg_replace('/[^0-9a-z-_ ]/i', '', $translit);
$translit = preg_replace('/\s+/', ' ', $translit);
$translit = preg_replace('/\//', '-', $translit);
$translit = str_replace(' ', '-', $translit);
$_SESSION['translit'] = $translit;

// display message
if (empty($_SESSION['error_user_name']) &&
    empty($_SESSION['error_user_email']) &&
    empty($_SESSION['error_day']) &&
    empty($_SESSION['error_month']) &&
    empty($_SESSION['error_year']) &&
    empty($_SESSION['error_gender']) &&
    empty($_SESSION['error_message']) &&
    !empty($_SESSION['valid_user_name']) &&
    !empty($_SESSION['valid_user_email']) &&
    !empty($_SESSION['valid_day']) &&
    !empty($_SESSION['valid_month']) &&
    !empty($_SESSION['valid_year']) &&
    !empty($_SESSION['valid_gender']) &&
    !empty($_SESSION['valid_message'])
    ) {
    $_SESSION['form_submited'] = 1; // Form submitted
}
header('Location: HW3.php', true, 301);
exit;

?>


<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP/Lesson8/HW3</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="/css/material-icons.css">
</head>
<body class="grey lighten-2">

<!--    HEADER-->
<nav class="light-blue darken-4">
    <div class="nav-wrapper">
        <div class="container">
            <a class="brand-logo">PHP / Lesson8 / HW3_form</a>
            <ul id="nav-mobile" class="right">
                <li><a href="index.php">Index.php</a></li>
                <li><a href="HW3.php">HW3</a></li>
            </ul>
        </div>
    </div>
</nav>
<!--    /HEADER-->
<div class="main">
    <div class="container">
        <?php
        echo 'post';
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
        echo 'session';
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';



        ?>
    </div>
</div>

