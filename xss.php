<?php

setcookie('pwd', 'admin123');

$pdo = new PDO("mysql:host=localhost;dbname=base1", 'root', '');
if(isset($_POST['ajouterMot'])){
    $mot = $_POST['mot'];
    $pdo->query("INSERT INTO livredor VALUES ('', '$mot')");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $selectall = $pdo->query("SELECT * FROM livredor");
    $result = $selectall->fetchALL();
    foreach ($result as $ligne) {
        echo $ligne['mot'] . '<br>';
    }
?>

<h3> Livre d'or </h3>
<form method="post" action="#">
    Mon mot : <textarea name="mot"></textarea><br>
    <input type="submit" value="Ajouter mon mot" name="ajouterMot">
</form>
</body>
</html>
