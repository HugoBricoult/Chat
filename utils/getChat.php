<?php
require_once('config.php');
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

    <?php }}
?>