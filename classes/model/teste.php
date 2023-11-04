<?php

Pour mettre en place une application de gestion de contacts personnels, vous aurez besoin d'une base de données pour stocker les informations des contacts, ainsi que des scripts PHP pour effectuer les opérations CRUD (Create, Read, Update, Delete) sur les contacts. Voici comment vous pourriez procéder :

    Créer la base de données :
    Vous pouvez utiliser MySQL ou un autre système de gestion de bases de données. Voici un exemple de schéma de base de données pour vos contacts :
    
    sql
    Copy code
    CREATE DATABASE gestion_contacts;
    USE gestion_contacts;
    
    CREATE TABLE contacts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(50) NOT NULL,
        prenom VARCHAR(50) NOT NULL,
        numero_telephone VARCHAR(15) NOT NULL,
        favori BOOLEAN NOT NULL
    );
    Écrire le code PHP pour ajouter un nouveau contact :
    php
    Copy code
    <?php
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=nom_du_serveur;dbname=gestion_contacts', 'utilisateur', 'mot_de_passe');
    
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero_telephone = $_POST['numero_telephone'];
    $favori = $_POST['favori'];
    
    // Requête d'insertion
    $sql = "INSERT INTO contacts (nom, prenom, numero_telephone, favori) VALUES (?, ?, ?, ?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$nom, $prenom, $numero_telephone, $favori]);
    
    // Redirection vers la page de gestion des contacts
    header('Location: gestion_contacts.php');
    ?>
    Écrire le code PHP pour supprimer un contact :
    php
    Copy code
    <?php
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=nom_du_serveur;dbname=gestion_contacts', 'utilisateur', 'mot_de_passe');
    
    // Récupération de l'ID du contact à supprimer
    $id = $_GET['id'];
    
    // Requête de suppression
    $sql = "DELETE FROM contacts WHERE id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id]);
    
    // Redirection vers la page de gestion des contacts
    header('Location: gestion_contacts.php');
    ?>
    Écrire le code PHP pour modifier les informations d'un contact :
    php
    Copy code
    <?php
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=nom_du_serveur;dbname=gestion_contacts', 'utilisateur', 'mot_de_passe');
    
    // Récupération des données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero_telephone = $_POST['numero_telephone'];
    
    // Requête de mise à jour
    $sql = "UPDATE contacts SET nom = ?, prenom = ?, numero_telephone = ? WHERE id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$nom, $prenom, $numero_telephone, $id]);
    
    // Redirection vers la page de gestion des contacts
    header('Location: gestion_contacts.php');
    ?>
    Écrire le code PHP pour marquer un contact comme favori :
    php
    Copy code
    <?php
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=nom_du_serveur;dbname=gestion_contacts', 'utilisateur', 'mot_de_passe');
    
    // Récupération de l'ID du contact et de la nouvelle valeur du champ "favori"
    $id = $_GET['id'];
    $favori = $_GET['favori'];
    
    // Requête de mise à jour
    $sql = "UPDATE contacts SET favori = ? WHERE id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$favori, $id]);
    
    // Redirection vers la page de gestion des contacts
    header('Location: gestion_contacts.php');
    ?>
    N'oubliez pas de créer une interface utilisateur (HTML, CSS) pour interagir avec ces scripts PHP. Vous devrez également gérer la validation des données et la sécurité pour éviter les attaques SQL injection.











    Bien sûr, pour mettre en place une application de gestion de contacts en utilisant l'architecture MVC (Modèle-Vue-Contrôleur) et la programmation orientée objet (POO) en PHP, vous pouvez suivre ces étapes :

Créez la structure de votre application :

Modèles : Créez des classes PHP pour représenter les contacts et interagir avec la base de données.
Vues : Créez des fichiers de vue (HTML/PHP) pour afficher les données et les formulaires.
Contrôleurs : Créez des classes PHP pour gérer les interactions entre les modèles et les vues.
Modèles (contact.php) :

php
Copy code
class Contact {
    private $id;
    private $nom;
    private $prenom;
    private $numero_telephone;
    private $favori;

    // Méthodes pour accéder et mettre à jour les propriétés

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNumeroTelephone() {
        return $this->numero_telephone;
    }

    public function isFavori() {
        return $this->favori;
    }

    // Méthodes pour sauvegarder, mettre à jour et supprimer un contact dans la base de données
}
Contrôleurs (ContactController.php) :
php
Copy code
class ContactController {
    public function ajouterContact($nom, $prenom, $numero_telephone, $favori) {
        // Créez un nouvel objet Contact, attribuez les valeurs, puis sauvegardez-le dans la base de données.
    }

    public function supprimerContact($id) {
        // Supprimez le contact ayant l'ID spécifié de la base de données.
    }

    public function modifierContact($id, $nom, $prenom, $numero_telephone) {
        // Mettez à jour les informations du contact dans la base de données.
    }

    public function marquerFavori($id, $favori) {
        // Marquez le contact comme favori ou non dans la base de données.
    }

    // Autres méthodes pour récupérer la liste de contacts, etc.
}
Vues (contact_view.php) :
php
Copy code
<!DOCTYPE html>
<html>
<head>
    <title>Gestion des contacts</title>
</head>
<body>
    <!-- Afficher la liste des contacts ici -->

    <!-- Formulaire pour ajouter un contact -->
    <form method="post" action="index.php">
        <input type="text" name="nom" placeholder="Nom">
        <input type="text" name="prenom" placeholder="Prénom">
        <input type="text" name="numero_telephone" placeholder="Numéro de téléphone">
        <input type="checkbox" name="favori" id="favori" value="1">
        <label for="favori">Favori</label>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
Index.php (point d'entrée) :
php
Copy code
<?php
// Inclure les classes et les fichiers nécessaires

// Traitement des requêtes et appels aux contrôleurs

// Affichage de la vue
?>
Ceci est une structure de base pour votre application MVC. Vous devrez créer les contrôleurs et les vues pour gérer les différentes actions (ajout, suppression, modification, marquage favori) et afficher la liste des contacts. Assurez-vous également de configurer votre base de données et de gérer les routes correctement dans le point d'entrée (index.php).




Is this conversation helpful so far?








Pour rendre votre application de gestion de contacts attrayante, vous pouvez utiliser du HTML et du CSS pour créer une interface utilisateur conviviale. Voici un exemple simple de structure HTML et de CSS pour votre application :

HTML (contact_view.php):

html
Copy code
<!DOCTYPE html>
<html>
<head>
    <title>Gestion des contacts</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Gestion des Contacts</h1>
    </header>
    <div class="container">
        <section class="contact-form">
            <h2>Ajouter un contact</h2>
            <form method="post" action="index.php">
                <input type="text" name="nom" placeholder="Nom" required>
                <input type="text" name="prenom" placeholder="Prénom" required>
                <input type="tel" name="numero_telephone" placeholder="Numéro de téléphone" required>
                <label for="favori">Favori:</label>
                <input type="checkbox" name="favori" id="favori">
                <input type="submit" value="Ajouter">
            </form>
        </section>
        <section class="contact-list">
            <h2>Liste des Contacts</h2>
            <!-- Afficher la liste des contacts ici -->
            <ul class="contacts">
                <li>
                    <span class="name">John Doe</span>
                    <span class="phone">123-456-7890</span>
                    <span class="favorite">Favori</span>
                    <button class="edit-button">Modifier</button>
                    <button class="delete-button">Supprimer</button>
                </li>
                <!-- Répétez ces éléments pour chaque contact -->
            </ul>
        </section>
    </div>
</body>
</html>
CSS (style.css):

css
Copy code
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
Vous pouvez personnaliser davantage le CSS et la structure HTML en fonction de vos préférences de design. Assurez-vous de lier le fichier CSS à votre page HTML comme indiqué dans l'en-tête.




