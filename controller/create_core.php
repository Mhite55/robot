<?php

$pdo = new PDO("mysql:host=localhost;dbname=robot", "root", "");

if(!empty($_POST["name"]) && !empty($_POST["brand"]) && !empty($_POST["power"])){
    try {
        $name = $_POST["name"] ;
        $power = $_POST["power"] ;
        $idCore = md5($name . $power);
        $sql = "INSERT INTO robotic_core (name, brand, power, factory_id, view) VALUE (?,?,?,?,?) " ; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST["name"], $_POST["brand"], $_POST["power"], $idCore, 0]);
        sendMessage("Vous avez bien créer un Robot","success","../view/create_core_form.php");
    } catch (Exception $e) {
        sendMessage($e->getMessage(),"failed","../view/create_core_form.php");
    }
}else{
    sendMessage("Veuillez remplir correctement le formulaire", "failed","../view/create_core_form.php");
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