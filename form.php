<?php
session_start();

if (!empty($_POST['week']) && $_POST['week'] <= 7 && is_numeric($_POST['week']) && $_POST['week'] >= 1) {
    $_SESSION['valid_week'] = $_POST['week'];
    unset($_SESSION['error_week']);
} else {
    $_SESSION['error_week'] = 'Error';
    unset($_SESSION['valid_week']);
}
if (!empty($_POST['pol']) && ($_POST['pol'] == 1 || $_POST['pol'] == 2)) {
    $_SESSION['valid_pol'] = $_POST['pol'];
    unset($_SESSION['error_pol']);
} else {
    $_SESSION['error_pol'] = 'Error pol';
    unset($_SESSION['valid_pol']);
}
header('Location: /index.php', true, 301);
exit;