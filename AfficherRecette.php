<?php
$recipes = [
    [
        'title' => 'Cassoulet',
        'recipe' => 'des flageolets !',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Escalope milanaise',
        'recipe' => 'prenez une belle',
        'author' => 'mathieu.nebra@exemple.com',
        'is_enabled' => true,
    ]
];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Affichage des recettes</title>
    </head>
    <body>
    <?php
        foreach($recipes as $recipe) {?>
            <h2>  <?php echo $recipe['title'] ?></h2>
            <p> Etape 1 : <?php echo $recipe['recipe'] ?></p>
            <p> <?php echo $recipe['author'] ?></p>
            <?php }?>
        
    </body>
</html>