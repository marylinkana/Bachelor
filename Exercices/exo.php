<?php
$var1 = 1;
$var2 = 2;

if($var1 < $var2){
    echo $var1."<".$var2;
}
else{
    echo $var1.">".$var2;
}


$tabfruit = array('ananas', 'banane', 'poire');

foreach ($tabfruit as $item){
    if(stristr($item, 'a')){
        echo $item.'<br/>';
    }
}

function nombre_element($var) {
    if( is_array($var) ) {
        return count($var);
    }
    else{
        echo $var."n\'est pas un tableau";
    }
}

$tab = array('ananas', 'banane', 'poire');
echo nombre_element($tab);

function verif_entier($v1, $v2, $v3){
    if(is_int($v1) && is_int($v2) && is_int($v3)){
        if($v1 > $v2){
            if($v1 > $v3){
                return $v1;
            }
            else { return $v3;}
        }
        elseif($v2 > $v3){
            return $v2;
        }
        else{ return $v3;}
    }
}
//echo verif_entier(1, 2, 3);

?>

<html>
    <head>
        <title></title>
    </head>
    <body>
    <form action="" method="POST">
        A: <input type="text" name="a"/>
        B: <input type="text" name="b"/>
        C: <input type="text" name="c"/>
        <input type="submit" name="submit" value="envoyer">
    </form>
    </body>
</html>

<?php
    if(isset($_POST['submit'])){
        echo verif_entier($_POST['a'], $_POST['b'], $_POST['c']);
    }
?>
