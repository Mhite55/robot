<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<a href="index_validation.php">Index de Validation</a>
<a href="index.php">Index</a>


<?php

$pdo = new PDO("mysql:host=localhost;dbname=robot", "root", "");

    if ( isset($_GET['id'])) {

        $id = $_GET['id'];
        $sql = "SELECT * FROM robotic_core WHERE id=$id";
        $stmt = $pdo->query($sql);
        $core = $stmt->fetch(PDO::FETCH_ASSOC);

        $show_button_text = $core['isValid'] ? "Invalider" : "Valider";
        $show_li_state = $core['isValid'] ? "Actuellement validé" : "Actuellement invalidé";

    }
?>

<h1><?= htmlentities($core['name'])?></h1>

<ul>
    <li><?= $core['id'] ?></li>
    <li><?= $core['brand']?></li>
    <li><?= htmlentities($core['power'])?></li>
    <li><?= $core['factoryId']?></li>
    <li id="liState"><?= $show_li_state?></li>
</ul>


<button id="btn" data-core="<?= $core['id'] ?>"><?= $show_button_text ?></button>


<script>


    const btn = document.getElementById('btn');
    const li = document.getElementById('liState')

    btn.addEventListener('click', function (){

        id = this.dataset.core;
        const form = new FormData();
        form.append("id", id)

        data = {
            method: "POST",
            body: form
        }

        fetch('show_core_validation.php', data)
            .then(response => response.json())
            .then(dataCore => {
                if( dataCore.status === 200){

                    // La valeur d'affichage du bouton de validation est égale à :
                    // Si dataCore.state est true alors le bouton affichera "Invalider" sinon il affichera "Valider"

                    btn.innerHTML = dataCore.state ? "Invalider" : "Valider"

                    // La valeur d'affichage du li  est égale à :
                    // Si dataCore.state est true alors le bouton affichera "Actuellement validé" sinon il affichera "Actuellement invalidé"

                    li.innerHTML = dataCore.state ? 'Actuellement validé' : 'Actuellement invalidé'

                    // DANS UN TERNAIRE:

                    // valeur à assigner = une variable à verifier : si elle est true on prend la valeure apres le ?, si elle est fausse
                    // on prend la valeure apres le :
                }
            })


    })






</script>




</body>
</html>