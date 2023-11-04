<?php
namespace classes\model;
use PDO;

class Contact {
    protected $id;
    protected $nom;
    protected $prenom;
    protected $numero_telephone;
    protected $favori;

    public function __construct($nom = '', $prenom = '', $numero_telephone = '', $favori = '') {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numero_telephone = $numero_telephone;
        $this->favori = $favori;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getNumeroTelephone() {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone($numero_telephone) {
        $this->numero_telephone = $numero_telephone;
    }

    public function getFavori() {
        return $this->favori;
    }

    public function setFavori($favori) {
        $this->favori = $favori;
    }

    public function ajouterContacte($utilisateur_id, $contact, $conn) {
        $sql = "INSERT INTO contacts (utilisateur_id, nom, prenom, numero_telephone, favori) VALUES (:utilisateur_id, :nom, :prenom, :numero_telephone, :favori)";
        $boura = $conn->prepare($sql);
        $boura->bindParam(":utilisateur_id", $utilisateur_id, PDO::PARAM_INT);
        $boura->bindParam(":nom", $this->nom, PDO::PARAM_STR);
        $boura->bindParam(":prenom", $this->prenom, PDO::PARAM_STR);
        $boura->bindParam(":numero_telephone", $this->numero_telephone, PDO::PARAM_STR);
        $boura->bindParam(":favori", $this->favori, PDO::PARAM_STR);

        if ($boura->execute()) {
            return true;
        } else {
            // Gérer l'erreur SQL ici
            return false;
        }
    }


    public static function getAllContacts($conn, $utilisateur_id) {
        $sql = "SELECT * FROM contacts WHERE utilisateur_id = :utilisateur_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":utilisateur_id", $utilisateur_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

public function deleteContact($id) {
    global $conn;

    $sql = "DELETE FROM contacts WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        return true;
    } else {
        // Gérer l'erreur SQL ici, par exemple :
        echo "Erreur SQL : " . implode(', ', $stmt->errorInfo());
        return false;
    }
}

// Dans la classe Contact

public function markAsFavorite($id) {
    global $conn;

    $sql = "UPDATE contacts SET favori = 1 WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


public function removeFavoris($id) {
    global $conn;
    $sql = "UPDATE contacts SET favori = 0 WHERE id = :id";
    $boura = $conn->prepare($sql);
    $boura->bindParam(":id", $id);
    $boura->execute();
}




public function getContactById($id) {
    global $conn;

    $sql = "SELECT * FROM contacts WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function updateContact($conn, $id, $nom, $prenom, $numero_telephone) {
    $sql = "UPDATE contacts SET nom = :nom, prenom = :prenom, numero_telephone = :numero_telephone WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":nom", $nom,PDO::PARAM_STR);
    $stmt->bindParam(":prenom", $prenom,PDO::PARAM_STR);
    $stmt->bindParam(":numero_telephone", $numero_telephone,PDO::PARAM_STR);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}



}







?>