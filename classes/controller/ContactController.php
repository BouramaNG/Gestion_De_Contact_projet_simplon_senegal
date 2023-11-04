<?php
namespace classes\controller;

use classes\model\Contact;
use PDO; // Vous devez inclure PDO ici si ce n'est pas déjà fait

class ContactController {
    public function ajouterContacte($utilisateur_id, $contact, $conn) {
        // Vous devez passer la connexion PDO $conn en tant que troisième argument

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["ajouter"])) {
                $nom = $contact->getNom();
                $prenom = $contact->getPrenom();
                $numero_telephone = $contact->getNumeroTelephone();
                $favori = $contact->getFavori();

                // La variable $conn est nécessaire pour exécuter la requête SQL
                $sql = "INSERT INTO contacts (utilisateur_id, nom, prenom, numero_telephone, favori) VALUES (:utilisateur_id, :nom, :prenom, :numero_telephone, :favori)";
                $boura = $conn->prepare($sql);
                $boura->bindParam(":utilisateur_id", $utilisateur_id, PDO::PARAM_INT);
                $boura->bindParam(":nom", $nom, PDO::PARAM_STR);
                $boura->bindParam(":prenom", $prenom, PDO::PARAM_STR);
                $boura->bindParam(":numero_telephone", $numero_telephone, PDO::PARAM_STR);
                $boura->bindParam(":favori", $favori, PDO::PARAM_STR);

                if ($boura->execute()) {
                    echo "Le contact a été ajouté avec succès.";
                } else {
                    echo "Erreur SQL : " . implode(', ', $boura->errorInfo());
                }
            }
        }
    }



    public function showContactList($conn,$utilisateur_id) {
    
        $contacts = Contact::getAllContacts($conn,$utilisateur_id);

    // var_dump($contacts);
    // die();
      
        return $contacts;
    }
    


    public function deleteContact($contact_id) {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
     
            $id = $_GET["id"];

            $contact = new Contact();
    
        
            if ($contact->deleteContact($id)) {
               
                echo "<script>window.location.href='contactForm.php?action=list';</script>";
            } else {
                echo "erreur de connexion";
            }
        }
    }



public function markAsFavorite($contact_id) {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $id = $_GET["id"];
     
        $contact = new Contact();
        if ($contact->markAsFavorite($id)) {
          
            header("Location: contactForm.php");
            exit();
        } else {
           echo "erreur de connexion";
        }
    }
}


public function getFavorites($utilisateur_id, $conn) {
    $sql = "SELECT * FROM contacts WHERE utilisateur_id = :utilisateur_id AND favori = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":utilisateur_id", $utilisateur_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function deleteFavoris($utilisateur_id,$conn,$contact)
{

}



public function removeFavoris($contact_id) {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
 
        $id = $_GET["id"];

        $contact = new Contact();

    
        if ($contact->removeFavoris($id)) {
           
            echo "<script>window.location.href='voirFavo.php?action=list';</script>";
        } else {
            echo "erreur de connexion";
        }
    }
}

public function updateContact() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $id = $_POST["id"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $numeroTelephone = $_POST["numeroTelephone"];
        $favori = isset($_POST["favori"]) ? 1 : 0;

        // Créer un objet Contact avec les nouvelles données
        $contact = new Contact($nom, $prenom, $numeroTelephone, $favori);
        $contact->setId($id); // Définir l'ID du contact

        // Mettre à jour les informations du contact dans la base de données
        if ($contact->updateContact()) {
            // Redirection vers la liste des contacts ou autre action souhaitée
            header("Location: index.php?action=list");
            exit();
        } else {
            // Gérer l'erreur
        }
    }
}
    
    
    }
    











?>