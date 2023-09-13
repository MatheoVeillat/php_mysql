<?php
// Validation du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    foreach ($users as $user) {
        if ($_POST['email'] == $user['email'] && $_POST['password'] == $user['password']) {
            $loggedUser = ['email' => $user['email']];
        } else {
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)', $_POST['email'], $_POST['password']);
        }
    }
}
?>

<?php if (!isset($loggedUser)) : ?>
    <form action = index.php method = post>
    <!-- si message d'erreur on l'affiche -->
    <?php if ( isset($errorMessage) ) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errorMessage ?>
    </div>
    <?php endif; ?>
   

    <!-- Formulaire de connexion -->
    <div class="mb-3">
        <form action="index.php" method="post">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@example.com">
            <div id="email-help" class="form-text">
                L'email utilisé lors de la création de compte.
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
<?php else : ?>
    <!-- Message de bienvenue pour l'utilisateur connecté -->
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo $loggedUser['email']; ?> et bienvenue sur le site !
    </div>
<?php endif; ?>
