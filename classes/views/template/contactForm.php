<?php

include_once(__DIR__ . '/../../controller/ContactController.php');


?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestion des contacts</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

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

.contact-list .contacts li {
    background-color: #f9f9f9;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.contact-list .contacts .name, .contact-list .contacts .phone, .contact-list .contacts .favorite {
    flex: 1;
    padding: 5px;
}

.edit-button, .delete-button {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
}

.edit-button {
    margin-right: 5px;
}

.favorite {
    color: #27ae60;
}

.contact-form h2, .contact-list h2 {
    color: #333;
}
/* CSS pour la section contact-list */
.contact-list {
    margin-top: 20px;
  
}

.contact-list h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 10px;
}

.contact-list table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
}

.contact-list table th,
.contact-list table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

.contact-list table th {
    background-color: #f9f9f9;
}

.contact-list table tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* CSS pour les boutons */
.edit-button,
.delete-button,
.favorite-button {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
    margin-right: 5px;
}

.favorite-button {
    background-color: #27ae60;
}

.edit-button:hover,
.delete-button:hover,
.favorite-button:hover {
    background-color: #555;
}

.edit-button, .favorite-button, [type="submit"] {
    background-color: #3498db;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
}

.edit-button {
    background-color: #27ae60;
}

.favorite-button {
    background-color: #e67e22;
}


    </style>
</head>
<body>
    <header>
        <h1>Gestion des Contacts</h1>
    </header>
    <div class="container">
        <section class="contact-form">
            <h2>Ajouter un contact</h2>
            <form method="post" action="">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <input type="tel" name="numero_telephone" placeholder="Numéro de téléphone" required>
    <label for="favori">Favori:</label>
    <input type="checkbox" name="favori" id="favori">
    <input type="submit" name="ajouter" value="Ajouter">
</form>

        </section>
        <section class="contact-list">
    <h2>Liste des Contacts</h2>
    <?php if ($contacts): ?>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Numéro de téléphone</th>
            <th>Favori</th>
            <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
        </tr>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?php echo $contact['nom']; ?></td>
                <td><?php echo $contact['prenom']; ?></td>
                <td><?php echo $contact['numero_telephone']; ?></td>
                <td><?php echo ($contact['favori'] == 1) ? 'Oui' : 'Non'; ?></td>
                <td>
                  
                  
                    <a class="delete-button " href="index.php?action=delete&id=<?= $contact['id']; ?>">Supprimer</a>

                    <a class="edit-button" href="modifi.php?id=<?= $contact['id']; ?>">Modifier</a>

                    

                        <?php

            if ($contact['favori'] != 1) {
                echo '<a class="favorite-button" href="contactForm.php?action=markAsFavorite&id=' . $contact['id'] . '">favori</a>';
            }
            ?>

              
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <p>Aucun contact n'a été trouvé.</p>
    <?php endif; ?>
</section>

</body>
</html>