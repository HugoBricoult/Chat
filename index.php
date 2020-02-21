<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login/login.php");
    exit;
}
require_once('utils/config.php');
global $pdo;
$pdo = getPdo();

if(isset($_POST["text"])){
    if(!empty($_POST["text"])){
        $req = $pdo->prepare('INSERT INTO images(link,user,datecurr,isimg,msg) VALUES(:link, :user, :datecurr, :isimg, :msg)');
        $req->execute(array('link' => "", 'user' => $_SESSION["username"], 'datecurr' => date('Y-m-d H:i:s'), 'isimg' => 0, 'msg' => $_POST["text"]));

    }
}

if(isset($_FILES["fileToUpload"])){
    if(!empty($_FILES["fileToUpload"])){
        require_once("utils/upload.php");
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="container">
    <div class="navbar py-4 text-center">
        <h2>Bonjour <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> ! Bienvenue sur Keller Chat !</h2>
        <div class="float-right">
            <a href="login/reset-password.php" class="btn-chat">Changer de mot de passe</a>
            <a href="login/logout.php" class="btn-chat">Se déconnecter</a>
        </div>
    </div>



    <div class="container border p-4 chat-zone" id="chat">
    <?php
    showChat();
    function showChat(){
    global $pdo;
    $pdo = getPdo();
    $response = $pdo->query('SELECT * FROM images');
    while ($donnees = $response->fetch()){ ?>

        <div class="row">
            <div class="col-3">
                <p><strong><?= $donnees["user"] ?></strong> | <?= $donnees["datecurr"]?></p>
            </div>
            <div class="col-9">

        <?php if($donnees["isimg"] == 1){ ?>

                <p><?= $donnees["msg"] ?></p>
                <p><img src="<?= $donnees["link"] ?>" alt="" width="200px" height="auto"></p>
            </div>
        </div>

        <?php }else{ ?>

                <p><?= $donnees["msg"] ?></p>
            </div>
        </div>

        <?php }}} ?>

    </div>
        <div class="container py-2">
            <div class="row">
                <div class="col-6 border p-2">
                    <form action="index.php" method="post">
                        <input type="text" name="text" placeholder="Message">
                        <input type="submit" name="submit" value="Envoyer">
                    </form>
                </div>
                <div class="col-6 border p-2">
                <form action="index.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload" id="fileToUpload"></br></br>
                        <input type="text" name="comment" id="comment" placeholder="Commentaire image">
                        <input type="submit" name="submit" value="Envoyer l'image">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js "></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js " integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k " crossorigin="anonymous "></script>
    <script src="js/script.js"></script>
</body>
</html>