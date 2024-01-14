<?php
    $pdo = new PDO("mysql:host=localhost;dbname=robot", "root", "");
 if (!empty($_POST["id"]) && !empty($_POST["view"])) {
    $id = $_POST["id"];
    if ($_POST["view"] == "oui") {
        $view = "non" ;
        $viewBase = false; 
    }else if($_POST["view"] == "non"){
        $view = "oui";
        $viewBase = true; 
    }
    $sql = "UPDATE robotic_core SET view=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$viewBase,$id])) {
        $response= [
            "view"=> $view,
            "viewBase" => $viewBase,
            "status" => "success",
            "message" => "ok sa marche bebou"
        ];
    }else {
        $response = [
            "status" => "failed",
            "message" => "erreur interne , veuillez recommencer plus tard"
        ];
    }

    
        echo json_encode($response);
    }else {
        echo json_encode("Marche s'il te plait");
    }