<?php
session_start();

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
            <a class="brand-logo">PHP / Lesson8 / HW3</a>
            <ul id="nav-mobile" class="right">
                <li><a href="index.php">Index.php</a></li>
                <li><a href="HW3_form.php">HW3 form</a></li>
            </ul>
            </div>
        </div>
    </nav>
<!--    /HEADER-->
    <div class="main">
        <div class="container">
            <?php
            if (!empty($_SESSION['form_submited'])) {
            ?>
<!-- выводим письмо-->
                <div class="card grey lighten-2 m-auto">
                    <div class="row">
                        <div class="col s12">
                            <h3>Получены данные</h3>
                        </div>
                        <div class="col s12">
                            <p>Ваше имя:<?php echo ' ' . $_SESSION['valid_user_name']; ?></p>
                        </div>
                        <div class="col s12">
                            <p>Ваш Email:<?php echo ' ' . $_SESSION['valid_user_email']; ?></p>
                        </div>
                        <div class="col s12">
                            <p>Вам количество лет:<?php echo ' ' . $_SESSION['your_age']; ?></p>
                        </div>
                        <div class="col s12">
                            <p>Ваш пол: <?php echo $_SESSION['valid_gender'] == 1 ? ' ' . 'Мужчина' : ' ' . 'Женщина'; ?></p>
                        </div>
                        <div class="col s12">
                            <p>Сообщение:<?php echo ' ' . $_SESSION['valid_message']; ?></p>
                        </div>
                        <div class="col s12">
                            <p>Транслит:<?php echo ' ' . $_SESSION['translit']; ?></p>
                        </div>
                    </div>
                </div>
                <a href="HW3_form.php?unset=1" class="btn">Очистить данные формы</a>
<!-- Форма -->
           <?php } else { ?>
                <form action="HW3_form.php" method="post" class="card grey lighten-2 m-auto" novalidate>
                    <div class="row">
                        <!-- name-->
                        <div class="col s6">
                            <label for="user_name">Имя</label>
                            <input id="user_name"
                                   type="text"
                                   name="user_name"
                                <?php echo !empty($_SESSION['error_user_name']) ? 'class="error"' : '' ?>
                                   value="<?php echo !empty($_SESSION['valid_user_name']) ? $_SESSION['valid_user_name'] : $_SESSION['user_name']; ?>"
                            >
                            <?php echo !empty($_SESSION['error_user_name']) ? '<span class="error">' . $_SESSION['error_user_name'] . '</span>' : '' ?>
                        </div>
                        <!-- /name-->
                        <!-- email-->
                        <div class="col s6">
                            <label for="user_email">Email</label>
                            <input id="user_email"
                                   type="email"
                                   name="user_email"
                            <?php echo !empty($_SESSION['error_user_email']) ? 'class="error"' : '' ?>
                                   value="<?php echo !empty($_SESSION['valid_user_email']) ? $_SESSION['valid_user_email'] : $_SESSION['user_email']; ?>"
                            >
                            <?php echo !empty($_SESSION['error_user_email']) ? '<span class="error">' . $_SESSION['error_user_email'] . '</span>' : '' ?>
                        </div>
                        <!-- /email-->
                    </div>
                    <!-- date of birth-->
                    <div class="row">
                        <div class="col s12">Дата рождения</div>
                        <!-- day-->
                        <div class="col s4">
                            <select name="day" <?php echo !empty($_SESSION['error_day']) ? 'class="error"' : '' ?>>
                                <option value="0">День</option>
                                <?php for ($i = 1; $i <= 31; $i++) { ?>
                                    <option value="<?php echo $i ?>" <?php echo !empty($_SESSION['valid_day']) && $_SESSION['valid_day'] == $i ? 'selected' : ''; ?>><?php echo $i ?></option>
                                <?php  } ?>
                            </select>
                            <?php echo !empty($_SESSION['error_day']) ? '<span class="error">' . $_SESSION['error_day'] . '</span>' : '' ?>
                        </div>
                        <!-- /day-->
                        <!-- month-->
                        <div class="col s4">
                            <select name="month" <?php echo !empty($_SESSION['error_month']) ? 'class="error"' : '' ?>>
                                <option value="0">Месяц</option>
                                <?php
                                function getMonth($num) {
                                    if ($num == 1) {
                                        return 'Январь';
                                    } elseif ($num == 2) {
                                        return 'Февраль';
                                    } elseif ($num == 3) {
                                        return 'Март';
                                    } elseif ($num == 4) {
                                        return 'Апрель';
                                    } elseif ($num == 5) {
                                        return 'Май';
                                    } elseif ($num == 6) {
                                        return 'Июнь';
                                    } elseif ($num == 7) {
                                        return 'Июль';
                                    } elseif ($num == 8) {
                                        return 'Август';
                                    } elseif ($num == 9) {
                                        return 'Сентябрь';
                                    } elseif ($num == 10) {
                                        return 'Октябрь';
                                    } elseif ($num == 11) {
                                        return 'Ноябрь';
                                    } elseif ($num == 12) {
                                        return 'Декабрь';
                                    }
                                }
                                for ($i = 1; $i <= 12; $i++) { ?>
                                    <option value="<?php echo $i ?>" <?php echo !empty($_SESSION['valid_month']) && $_SESSION['valid_month'] == $i ? 'selected' : ''; ?>><?php echo getMonth($i) ?></option>
                                <?php  } ?>
                            </select>
                            <?php echo !empty($_SESSION['error_month']) ? '<span class="error">' . $_SESSION['error_month'] . '</span>' : '' ?>
                        </div>
                        <!-- /month-->
                        <!-- year-->
                        <div class="col s4">
                            <select name="year" <?php echo !empty($_SESSION['error_year']) ? 'class="error"' : '' ?>>
                                <option value="0">Год</option>
                             <?php for ($i = 1970; $i <= 2010; $i++) { ?>
                                <option value="<?php echo $i ?>" <?php echo !empty($_SESSION['valid_year']) && $_SESSION['valid_year'] == $i ? 'selected' : ''; ?>><?php echo $i ?></option>
                                <?php  } ?>
                            </select>
                            <?php echo !empty($_SESSION['error_year']) ? '<span class="error">' . $_SESSION['error_year'] . '</span>' : '' ?>
                        </div>
                        <!-- /year-->
                    </div>
                    <!-- /date of birth-->
                    <!-- gender-->
                    <div class="row">
                        <div class="col s4">Ваш пол:</div>
                        <div class="col s4 radio-wrapper">
                            <input type="radio"
                                   name="gender"
                                   value="1"
                                <?php echo !empty($_SESSION['valid_gender']) && $_SESSION['valid_gender'] == 1 ? 'checked' : '' ?>
                            >
                            <span>Мужчина</span>
                        </div>
                        <div class="col s4 radio-wrapper">
                            <input type="radio"
                                   name="gender"
                                   value="2"
                                <?php echo !empty($_SESSION['valid_gender']) && $_SESSION['valid_gender'] == 2 ? 'checked' : '' ?>
                            >
                            <span>Женщина</span>
                        </div>
                        <?php echo !empty($_SESSION['error_gender']) ? '<span class="error col s12">' . $_SESSION['error_gender'] . '</span>' : '' ?>
                    </div>
                    <!-- /gender-->
                    <!-- message-->
                    <div class="row">
                        <div class="col s4">Ваше сообщение:</div>
                        <div class="col s12">
                            <textarea name="message"
                            <?php echo !empty($_SESSION['error_message']) ? 'class="error"' : '' ?>
                            ><?php echo !empty($_SESSION['valid_message']) ? $_SESSION['valid_message'] : '' ?></textarea>
                            <?php echo !empty($_SESSION['error_message']) ? '<span class="error">' . $_SESSION['error_message'] . '</span>' : '' ?>
                        </div>
                    </div>
                    <!-- /message-->
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="btn waves-effect waves-light light-blue darken-4">Отправить</button>
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.main -->

</body>
</html>
