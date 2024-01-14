<?php include_once "home.php" ;
$pdo = new PDO("mysql:host=localhost;dbname=robot", "root", "");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM robotic_core WHERE id=$id ";
        $stmt = $pdo->query($sql);
        $robot = $stmt->fetch(PDO::FETCH_ASSOC);
        if($robot['view'] == 0){
            $valid = "non";
            $robot['view'] = $valid;
        }else {
            $valid = "oui";
            $robot['view'] = $valid;
        }
    }
    
        ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="text-center">
                <img src="../img/robot.jpg" class="image-fluid rounded mt-5"  width="50%" alt="Imaginez un enfant malheureux sur cette photo">
            </div>
        </div>
        <div class="col-6">
                
            <ul class="list-group mt-5">
                    
                <li class="list-group-item text-center">Name : <?= htmlentities($robot['name']) ?><a href=""></a></li>
                <li class="list-group-item text-center">Brand : <?= htmlentities($robot['brand']) ?></li>
                <li class="list-group-item text-center">Power :  <?= htmlentities($robot['power']) ?></li>
                <li class="list-group-item text-center">ID factory : <?= htmlentities($robot['factory_id']) ?></li>
                <li class="list-group-item text-center"><span id="view">Valide : <?= htmlentities($robot['view']) ?></span></li>

            </ul>

            <form id="form">
                <input type="hidden" name="id" value="<?= htmlentities($robot['id']) ?>">
                <input type="hidden" name="view" id="newView" value="<?= htmlentities($robot['view']) ?>">
                <?php if ($robot['view'] == 'oui') {?>
                <input class="form-control btn btn-danger my-2" type="submit" id="btn" value="Invalider le robot">  
                <?php }else { ?>
                <input class="form-control btn btn-primary my-2" type="submit" id="btn" value="Valider le robot">                
                <?php } ?>
            </form>

            <ul class="list-group mt-5">
                <?php
                $sql_pr = "SELECT * FROM piece_robot WHERE id_core=$id ";
                $stmt_pr = $pdo->query($sql_pr);
                $piecesAsso = $stmt_pr->fetchAll(PDO::FETCH_ASSOC);
                foreach ($piecesAsso as $pieceAsso ) {
                            echo "<li class='list-group-item text-center'>
                                    <h5>" . $pieceAsso['name']  . "</h5>
                                    <button class='btn btn-warning' id='btn-supp' data-core=" . $pieceAsso['id'] .">Supprimez la piece</button>
                                </li>";
                        }
                    ?>
            </ul>

            
            <form id="form-piece">
                <label class="form-control text-center my-2" for="piece">Choisissez une piece :
                    <select name="id_piece" class="text-center my-2 form-control">
                        <?php 
                            $sql_p = "SELECT * FROM piece_robot WHERE id ";
                            $stmt_p = $pdo->query($sql_p);
                            $pieces = $stmt_p->fetchAll(PDO::FETCH_ASSOC);
                            $table = "";
                            foreach ($pieces as $piece ) {
                                if ($piece['id_core'] == null) {
                                    $table .="<option value=" . htmlentities($piece['id']) . ">" . htmlentities($piece['name']) . htmlentities($piece['id']) . "</option>"; 
                                    } 
                                }
                            echo $table;
                        ?>
                    </select>
                </label>
                    <input type="hidden" name="id" value="<?= htmlentities($robot['id']) ?>">
                    <input class="form-control btn btn-primary my-2" type="submit" id="btn-piece" value="Valider la piece">
            </form>
        </div>
    </div>
</div>


</body>
</html>
<script>
    const btnSupp = document.getElementById('btn-supp')
    const formPiece = document.getElementById('form-piece')
    const btnPiece = document.getElementById('btn-piece')
    const form = document.getElementById('form')
    const btn = document.getElementById('btn')
    const view = document.getElementById('view')
    const newView = document.getElementById('newView')

    form.addEventListener("submit", function(e){
        e.preventDefault();

        const formData = new FormData(e.target);

        const data = {
            method: "POST",
            body: formData,
        } 

        fetch("../controller/ajax.php", data)
            .then(response => response.json())
            .then(data =>{
                console.log(data)
                if (data.viewBase == true) {
                    view.innerHTML = `<span> Valide : ${data.view}</span>`
                    btn.classList.remove("btn-primary");  // Supprimer la classe existante
                    btn.classList.add("btn-danger"); // Ajouter la nouvelle classe souhaitée
                    btn.value = 'inValider le robot' 
                    newView.value = data.view
                }else if (data.viewBase == false) {
                    view.innerHTML = `<span> Valide : ${data.view}</span>`  
                    btn.classList.remove("btn-danger");  // Supprimer la classe existante
                    btn.classList.add("btn-primary"); // Ajouter la nouvelle classe souhaitée
                    btn.value = 'Valider le robot' 
                    newView.value = data.view
                }
            })
        })

    formPiece.addEventListener("submit", function(e){
        e.preventDefault();

        const formData = new FormData(e.target);

        const data = {
            method: "POST",
            body: formData,
        } 

        fetch("../controller/ajax_piece.php", data)
            .then(response => response.json())
            .then(data =>{
                console.log(data)
        
            })
        })
    
    btnSupp.addEventListener("click", function(){
       
        id = this.dataset.core
        const form = new FormData();
        form.append("id", id)

        const data = {
            method: "POST",
            body: form,
        } 

        fetch("../controller/ajax_delete_piece.php", data)
            .then(response => response.json())
            .then(data =>{
                console.log(data)
        
            })
        })
</script>                                                                                                                                           

