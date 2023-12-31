<?php session_start();  
include_once('mysql.php'); 
print_r($_GET);
$affichageQuery = 'SELECT recipe_id, title, recipe, author FROM recipes WHERE recipe_id = :recipe_id';
$affichage = $db->prepare($affichageQuery);
$affichage->execute(['recipe_id' => $_GET['recipe_id']]);
($recipe = $affichage->fetch(PDO::FETCH_ASSOC)) 

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Formulaire de Contact</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

    <?php include_once('header.php'); ?>
        <h1>Mettre à jour <?php echo($recipe['title']); ?></h1>
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de la recette</label>
                <input type="hidden" class="form-control" id="id" name="id" ></input>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Titre de la recette</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
                <div id="title-help" class="form-text">Choissisez un titre percutant.</div>
            </div>
            <div class="mb-3">
                <label for="recipe" class="form-label">Description de la recette</label>
                <textarea class="form-control" name="recipe" placeholder="Seulement du contenu vous appartenant"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <br />
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>