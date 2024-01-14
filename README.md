# robot

<!-- Faire une base de donnée "robot"
Faire une table robotic_core

Un noyau robotique se compose de :

id
Un nom ( Mignon de préférence )
Une marque ( Actuellement deux sur le marché -> "Tulaissesla" et "Blouson Dynamite" et "Deux Laure et Anne"
Une puissance en GigoWatt
Un "factory_id" qui est le hashage en MD5 de la concaténation de la puissance + le nom ( mignon ) du noyau
Un champ validation pour pouvoir l'afficher ou non ( booléen )


Fichiers :

index.php qui affiche tous les noyaux validé
index_validation.php affiche toux les noyaux et permet d'allez dans les READ de chaque noyau
show_core.php affiche les informations d'un noyau et valide ou non un noyau.
create_core-form.php et create_core.php


Par defaut le noyau n'est pas afficher dans l'index, il faut le valider ( en AJAX ) sur une page show_core avec un bouton valider, si le noyau est valide le bouton change de nom et devient invalider pour pouvoir le recacher.


Pas de delete ni d'update, pas de session  -->
