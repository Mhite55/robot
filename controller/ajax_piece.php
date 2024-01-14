<?php
    $pdo = new PDO("mysql:host=localhost;dbname=robot", "root", "");
 if (!empty($_POST["id"]) && !empty($_POST["id_piece"])) {
    $id = $_POST["id"];
    $id_piece = $_POST["id_piece"];
    $sql = "UPDATE piece_robot SET id_core=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$id,$id_piece])) {
        $option = makeOption();
        $response = [
            "id"=> $id,
            "option" => $option,
            "status" => "success",
            "message" => "ok sa marche bebou lien fait"
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

function makeOption () {
    
    ob_start();
    $pdo = new PDO("mysql:host=localhost;dbname=robot", "root", "");
    $id = $_POST["id"];
    $sql_pr = "SELECT * FROM piece_robot WHERE id_core=$id ";
    $stmt_pr = $pdo->query($sql_pr);
    $piecesAsso = $stmt_pr->fetchAll(PDO::FETCH_ASSOC);
    foreach ($piecesAsso as $pieceAsso ) {
                            echo "<li class='list-group-item text-center'>
                                    <h5>" . $pieceAsso['name']  . "</h5>
                                    <button class='btn btn-warning' id='btn-supp' data-core=" . $pieceAsso['id'] .">Supprimez la piece</button>
                                </li>";
                        }
}