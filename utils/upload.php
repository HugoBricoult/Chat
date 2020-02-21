<?php

    $target_dir = "images/"; //dossier ou mettre l'image
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); //chemin complet de l'image
    $uploadOk =1; //variable pour après les checks savoir si on peut upload sans risque
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //recupèrer l'extention de l'image
    //Check si image n'est pas une image "fake"
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image. |";
            $uploadOk = 0;
        }
    }
    //check si l'image exist déja


    //check taille image (50MB max)
    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "Sorry, your file is too large. |";
        $uploadOk = 0;
    }
    //Type d'images limit
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. |";
    $uploadOk = 0;
}


// Check $upload ok
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded. |";
// si c'est bon on upload
} else {
    $req = $pdo->prepare('INSERT INTO images(link,user,datecurr,isimg,msg) VALUES(:link, :user, :datecurr, :isimg, :msg)');

    $req->execute(array('link' => $target_file, 'user' => $_SESSION["username"], 'datecurr' => date('Y-m-d H:i:s'), 'isimg' => 1, 'msg' => $_POST["comment"]));
    if (file_exists($target_file)) {

    }else{
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            //envoyer adresse image dans la bdd avec son nom


        } else {
            echo "Sorry, there was an error uploading your file. |";
        }
    }

}