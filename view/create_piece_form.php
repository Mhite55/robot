<?php 
    include_once "home.php"
?>

<div class="text-center"></div>

    <form id="form" class="mx-auto col-6 my-5" method="POST" action="../controller/create_piece.php">
        
        <label class="mx-3" for="name">Name</label>
        <input class="form-control mx-3 my-2" type="text" name="name" >

        <input class="form-control btn btn-primary mx-3 my-2" type="submit" value="Ajouter">

    </form>

</div>