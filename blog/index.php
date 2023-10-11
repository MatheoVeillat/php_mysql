<?php
try {
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Add this line for error handling
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Retrieve the 5 latest posts
$statement = $database->query(
   "SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
);
$posts = [];
while ($row = $statement->fetch()) {
    $post = [
        'title' => $row['titre'], // Fixed typo in variable name
        'content' => $row['contenu'],
        'frenchCreationDate' => $row['date_creation_fr'],
    ];
    $posts[] = $post; // Add this line to append the post to the $posts array
}

require('templates/homepage.php');
?>



