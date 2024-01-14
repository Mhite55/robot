<?php

$pdo = new PDO("mysql:host=localhost;dbname=robot", "root", "");

if(!empty($_POST["name"])){
    try {
        $name = $_POST["name"] ;
        $sql = "INSERT INTO piece_robot (name) VALUE (?) " ; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST["name"]]);
        sendMessage("Vous avez bien créer un Robot","success","../view/create_piece_form.php");
    } catch (Exception $e) {
        sendMessage($e->getMessage(),"failed","../view/create_piece_form.php");
    }
}else{
    sendMessage("Veuillez remplir correctement le formulaire", "failed","../view/create_piece_form.php");
}
function sendMessage(string $message,string $status, string $location, int|null $page=null, bool $hasAIdBefore = false) :void{ //void = la fonction ne retourne rien
    // S'il y a un id avant nous remplaceront le "?" de l'url par un &
    $replace = !$hasAIdBefore ? "?" : "&";
    if ($page == null) {
        header("Location:$location" . $replace ."message=$message&status=$status");
        exit;
    }else{
        header("Location:$location" . $replace ."page=$page&message=$message&status=$status");
        exit;
    }
    
}

?>