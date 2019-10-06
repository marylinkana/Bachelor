<html>
<header> <title></title> </header>
<body>
<form action="" method="post">
    <input type="number" name="enter">
    <input type="submit" name="submit" value="chance">
</form>
</body>
</html>
<?php
session_start();
if(!isset($_SESSION['enter']) && !isset($_SESSION['compteur'])) {
    $_SESSION['enter'] = rand(1, 5);
    $_SESSION['compteur'] = 1;
}
    echo $_SESSION['enter'];
    echo '<br/>'.$_SESSION['compteur'].'<br/>';


    if (!empty($_POST['submit'])) {
        if ($_POST['enter'] < $_SESSION['enter']) {
            echo "Try again. the response is superior ";
            $_SESSION['compteur']++;
        }
        if ($_POST['enter'] > $_SESSION['enter']) {
            echo 'Try again. the response is inferior';
            $_SESSION['compteur']++;
        }
        if ($_POST['enter'] == $_SESSION['enter']) {
            echo 'Congratulation, in'.$_SESSION['compteur'].' trials. You are fine : ' . $_SESSION['enter'];
            $_SESSION['enter'] = rand(1, 5);
            $_SESSION['compteur'] = 1;
        }
    }
    else {
        return 'try a number !';
    }




