<?php

function isValidRecipe(array $recipe) {
    if (array_key_exists('is_enabled', $recipe)) {
        return $recipe['is_enabled'];
    }
    return false;
}

function getRecipes(array $recipes) {
    $validRecipes = [];
    foreach ($recipes as $recipe) {
        if (isValidRecipe($recipe)) {
            $validRecipes[] = $recipe;
        }
    }
    return $validRecipes;
}

function displayAuthor(string $authorEmail, array $users) {
    foreach ($users as $user) {
        if ($authorEmail === $user['email']) {
            return $user['full_name'] . ' (' . $user['age'] . ' ans)';
        }
    }
    return '';
}

?>