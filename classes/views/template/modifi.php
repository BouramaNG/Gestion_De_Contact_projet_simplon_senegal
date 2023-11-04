<?php
include_once(__DIR__ . '/../../controller/ContactController.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modification</title>
    <style>

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.contact-form h2, .contact-list h2 {
    color: #333;
}

.contact-form form {
    margin-top: 10px;

}

.contact-form input[type="text"], .contact-form input[type="tel"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
}

.contact-form label {
    margin: 10px 0;
}

.contact-list .contacts {
    list-style: none;
    padding: 0;
}
        </style>
</head>
<body>
<div class="container">
        <section class="contact-form">
            <h2>Ajouter un contact</h2>
<form method="post" action="index.php?action=modif">
    <input type="hidden" name="id" value="<?= $contacts['id']; ?>">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="nom" value="<?= $contacts['nom']; ?>">
    <input type="text" name="prenom" placeholder="Prénom" required>
    <input type="text" name="nom" value="<?= $contacts['prenom']; ?>">
    <input type="tel" name="numero_telephone" placeholder="Numéro de téléphone" required>
    <input type="text" name="nom" value="<?= $contacts['numero_telephone']; ?>">
    <input type="submit" name="ajouter" value="Ajouter">
</form>
</section>
</div>
</body>
</html>