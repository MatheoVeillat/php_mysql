<!-- templates/post.php:18 -->
<!-- ... -->
<h2>Commentaires</h2>
<form action="index.php?action=addComment&id=<? = $post['identifier'] ?> "
    method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
<!-- ... -->