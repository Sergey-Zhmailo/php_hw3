<?php
session_start();
setcookie('name', 'value', time() + 15); // 15 сек время жизни в секундах
?>
<link rel="stylesheet" href="css/styles.css">
<?php
echo '<h1>Занятие 8: Сессии (SESSION). Практика</h1><br><hr>';
echo '<div class="container">';
echo '<a href="HW3.php">hw3</a>';
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
/*
$str = 'Hello world';
$array = explode(' ', $str);
//if count($array) > 0 < 2

$str = implode(' ', $array);
*/

// Cookie

echo $_COOKIE['name'];


function week($num) {
    if ($num == 1) {
        return 'ПН';
    } elseif ($num == 2) {
        return 'ВТ';
    } elseif ($num == 3) {
        return 'СР';
    } elseif ($num == 4) {
        return 'ЧТ';
    } elseif ($num == 5) {
        return 'ПТ';
    } elseif ($num == 6) {
        return 'СБ';
    } elseif ($num == 7) {
        return 'ВС';
    }
}
$s = $_SESSION;


?>
<form action="form.php" method="post">
    <select name="week">
        <option value="0"> - def - </option>
        <?php for ($i = 1; $i <= 7; $i++) { ?>
            <option value="<?php echo $i ?>" <?php echo !empty($s['valid_week']) && $s['valid_week'] == $i ? 'selected' : ''; ?>><?php echo week($i)?></option>
        <?php  } ?>
    </select>
    <br>
    <input type="radio" name="pol" value="1" <?php echo !empty($s['valid_pol']) && $s['valid_pol'] == 1 ? 'checked' : '' ?> > Man
    <input type="radio" name="pol" value="2" <?php echo !empty($s['valid_pol']) && $s['valid_pol'] == 2 ? 'checked' : '' ?> > Woman
    <br>
    <button type="submit">Send</button>
</form>
    <?php echo !empty($s['error_week']) ? '<span style="color: red">' . $s['error_week'] . '</span>' : '' ?>
<?php echo !empty($s['error_pol']) ? '<span style="color: red">' . $s['error_pol'] . '</span>' : '' ?>




</div>
