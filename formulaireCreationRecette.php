<?php 
var_dump($_POST);
session_start();

include_once('mysql.php');
include_once('variables.php');

if (
    !(strlen($_POST['title']) > 1) ||
    !(strlen($_POST['recipe']) > 1) )
{
    echo 'Il faut un titre et une recette pour soumettre le formulaire. ';
    return;
}
else
{
    echo 'Votre recette à bien été rajouté';
}

$title = $_POST['title'];
$recipe = $_POST['recipe'];

$sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)';
$insertRecipe = $db->prepare($sqlQuery);

$insertRecipe->execute([
    'title' => $title,
    'recipe' => $recipe,
    'author' => "maz",
    'is_enabled' => 1,
]);
?>