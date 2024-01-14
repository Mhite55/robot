<?php 
    include_once "home.php"

?>

<div class="text-center"></div>

    <form id="form" class="mx-auto col-6 my-5" method="POST" action="../controller/create_core.php">
        
        <label class="mx-3" for="name">Name</label>
        <input class="form-control mx-3 my-2" type="text" name="name" >

        <label class="mx-3" for="brand">Marque</label>
        <select name="brand" class="form-control mx-3 my-2">
            <option value="">--Please choose an option--</option>
            <option value="Tulaissesla">Tulaissesla</option>
            <option value="Blouson Dynamite">Blouson Dynamite</option>
            <option value="Deux Laure et Anne">Deux Laure et Anne</option>
        </select>
        <label class="mx-3" for="power">Power</label>
        <input class="form-control mx-3 my-2" type="text" name="power" >

        <input class="form-control btn btn-primary mx-3 my-2" type="submit" value="Ajouter">

    </form>

</div>