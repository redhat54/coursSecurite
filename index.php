<?php
if (isset($_POST['signin'])) {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=localhost;dbname=base1", 'root', '');

    // Récupération des données du formulaire
    $login = $_POST['username'];
    $pwd = $_POST['password'];

    // Utilisation de requêtes préparées pour éviter les injections SQL
    $selectall = $pdo->prepare("SELECT * FROM user WHERE login=:login AND password=:password");
    $selectall->bindParam(':login', $login, PDO::PARAM_STR);
    $selectall->bindParam(':password', $pwd, PDO::PARAM_STR);
    $selectall->execute();

    // Utilisation de rowCount() pour vérifier le nombre de résultats
    $countRows = $selectall->rowCount();

    // Vérification du nombre de résultats pour déterminer si l'utilisateur existe
    if ($countRows != 0) {
        echo 'Connexion réussie';
    } else {
        echo 'Utilisateur non reconnu';
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset=""UTF-8>
    <meta name="viewport" content="width=device-width, initial-scal=1.0">
</head>
<body>
    <h1>Page de Connexion</h1>

    <form method="post" action="#"> <!--action="#" est fait pour recharger la page-->
    <!--écrire method="post" pour passer en caché et ensuite renvoyer l'info à PHP pour valider le login et le mot de passe. On peut aussi utiliser "ctrl+/"-->
    <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur">
        
        <br>
        <br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe">

        <br>
        <br>

        <button type="submit" name="signin">Se connecter</button>
    </form>
</body>
</html>