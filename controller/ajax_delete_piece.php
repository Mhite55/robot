<?php
    $pdo = new PDO("mysql:host=localhost;dbname=robot", "root", "");
 if (!empty($_POST["id"])) {
    $id = $_POST["id"];
    $sql = "UPDATE piece_robot SET id_core=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([null,$id])) {
        $response= [
            "idpiece"=> $id,
            "status" => "success",
            "message" => "ok sa marche bebou piece supprimez du core"
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