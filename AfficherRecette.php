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

$romanSalad = [
    'title' => 'Salade Romaine',
    'recipe' => 'Etape 1 : Lavez la salade ; Etape 2 : euh ...',
    'author' => 'laurene.castor@exemple.com',
    'is_enabled' => true,
];

$sushis = [
    'title' => 'Sushis',
    'recipe' => 'Etape 1 : du saumon ; Etape 2 : du riz',
    'author' => 'laurene.castor@exemple.com',
    'is_enabled' => false,
];
    
// Répond true !
$isRomandSaladValid = isValidRecipe($romanSalad);
    
// Répond false !
$isSushisValid = isValidRecipe($sushis);
    
function isValidRecipe(array $recipe) {
    if (array_key_exists('is_enabled', $recipe)) {
        $isEnabled = $recipe['is_enabled'];
    } else {
        $isEnabled = false;
    }
    return $isEnabled;
}

function getRecipes(array $recipes) {
    $validRecipes = [];
    foreach($recipes as $recipe) {
        if (isValidRecipe($recipe)) {
            $validRecipes[] = $recipe;
        }
    }
    return $validRecipes;
}

function displayAuthor(string $authorEmail, array $users) 
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . '(' . $author['age'] . ' ans)';
        }
    }
}

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


        