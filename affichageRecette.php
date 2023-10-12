<?php

include_once('mysql.php'); 

$affichageQuery = 'SELECT recipe_id, title, recipe, author FROM recipes WHERE author = :author';
$affichage = $db->prepare($affichageQuery);
$affichage->execute(['author' => $_SESSION['LOGGED_USER']]);

while ($recipe = $affichage->fetch(PDO::FETCH_ASSOC)) {
    echo '<article>';
    echo '<h3>' . $recipe['title'] . '</h3>';
    echo '<div>' . $recipe['recipe'] . '</div>';
    echo '<i>' . $recipe['author'] . '</i>';
    echo '<div>' . "<a href=update.php?recipe_id=" . $recipe['recipe_id'] . ">Modifier une recette</a>". '</div>';
    //  . ' ' . '<a style="color: red; text-decoration: none;">Supprimer une recette</a>' . '</div>';
    // style=color: gold;
    // text-decoration: none;
    echo '</article>';
}
?>
