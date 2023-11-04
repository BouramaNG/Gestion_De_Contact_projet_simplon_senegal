<?php
// include_once(__DIR__ . 'classes/controller/ContactController.php');
include_once'classes/controller/ContactController.php';
include_once'classes/model/Contact.php';

if (isset($_GET['id'])) {
    $contact_id = $_GET['id'];
    var_dump($contact_id);
    try {
        $conn = new PDO("mysql:host=localhost;dbname=taxi", "root", "root");
        echo "connexion reussi";

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT nom, prenom, numero_telephone FROM contacts WHERE id = :id");
        $stmt->bindParam(':id', $contact_id, PDO::PARAM_INT);
        $stmt->execute();
        $contactDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    $conn = null;

    if (empty($contactDetails)) {
        header("Location: index.php");
        exit();
    }




    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
   
            $contact_id = $_GET['id'];
            $nouveau_nom = $_POST['nom'];
            $nouveau_prenom = $_POST['prenom'];
            $nouveau_numero_telephone = $_POST['numero_telephone'];
            var_dump($contact_id);
            
    
            try {
                $conn = new PDO("mysql:host=localhost;dbname=taxi", "root", "root");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                $sql = "UPDATE contacts SET nom = :nom, prenom = :prenom, numero_telephone = :numero_telephone WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $contact_id, PDO::PARAM_INT);
                $stmt->bindParam(':nom', $nouveau_nom,PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $nouveau_prenom,PDO::PARAM_STR);
                $stmt->bindParam(':numero_telephone', $nouveau_numero_telephone,PDO::PARAM_STR);
    
                if ($stmt->execute()) {
            
                   header("location:contactForm.php");
                } else {
                   
                    echo 'La mise à jour a échoué. Veuillez réessayer.';
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
       
    }






} else {

    header("Location: index.php");
    exit();
}



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
.custom-button {
            background-color: #007BFF;
            color: #fff; 
            padding: 10px 20px; 
            border: none;
            border-radius: 5px;
            cursor: pointer; 
        }

        .custom-button:hover {
            background-color: #0056b3;
        }
        </style>
</head>
<body>
<div class="container">
        <section class="contact-form">
            <h2>Ajouter un contact</h2>
            <form method="post" action="">
    <input type="hidden" name="id" value='<?= $contactDetails['id'] ;?>'>
    <label for="nom">Nom :</label>
    <input type="text" name="nom" value="<?= $contactDetails['nom']; ?>" placeholder="Nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" value="<?= $contactDetails['prenom']; ?>" placeholder="Prénom" required>

    <label for="numero_telephone">Numéro de téléphone :</label>
    <input type="text" name="numero_telephone" value="<?= $contactDetails['numero_telephone']; ?>" placeholder="Numéro de téléphone" required>

    <input type="submit" name="modifier" value="Modifier le contact" class="custom-button">
</form>

</section>
</div>
</body>
</html>