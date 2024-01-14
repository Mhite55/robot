<?php include_once "home.php" ?>

<h1 class="text-center">Liste des Routes</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Brand</th>
            <th>Power</th>
            <th>ID Factory</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $pdo = new PDO("mysql:host=localhost;dbname=robot", "root", "");
        $sql = "SELECT * FROM robotic_core WHERE id ";
        $stmt = $pdo->query($sql);
        $robots = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $table = "";
            foreach ($robots as $robot ) {
                $table .="<tr>";
                $table .="<td>" . htmlentities($robot['name']) . "</td>"; 
                $table .="<td>" . htmlentities($robot['brand']) . "</td>"; 
                $table .="<td>" . htmlentities($robot['power']) . "</td>";
                $table .="<td>" . htmlentities($robot['factory_id']) . "</td>";
                $table .="<td>
                                <a class='text-decoration-none' title='Info Technique sur le produit' href='show_core.php?id=$robot[id]'>👁️</a>
                        </td>";
                $table .="<tr>";
            }
            echo $table;
        ?>
    </tbody>
</table>

</body>
</html>