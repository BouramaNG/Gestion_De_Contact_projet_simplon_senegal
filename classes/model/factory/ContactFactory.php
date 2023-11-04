<?php

namespace classes\factory;

namespace classes\model; 
use classes\model\Contact;
interface ContactFactoryInterface {
    public function createContact($nom, $prenom, $numero_telephone, $favori);
}

   
use PDO;
class Contact
{
    protected $id;
protected $nom;
protected $prenom;
protected $numero_telephone;   
protected $favori;



public function __construct($nom='',$prenom='',$numero_telephone='',$favori='') 
{
    $this->nom=$nom;
    $this->prenom=$prenom;  
    $this->numero_telephone=$numero_telephone;    
    $this->favori=$favori;  

}
 
public function ajouterContacte()
{
    global $conn;
    $sql ="INSERT INTO contacts (nom,prenom,numero_telephone,favori) VALUES (:nom,:prenom,:numero_telephone,:favori)";
    $boura = $conn->prepare($sql);  
    $boura->bindParam(":nom", $this->nom->getNom(), PDO::PARAM_STR);
    $boura->bindParam(":prenom", $this->prenom, PDO::PARAM_STR);
    $boura->bindParam(":numero_telephone", $this->numero_telephone, PDO::PARAM_STR);
    $boura->bindParam(":favori", $this->favori, PDO::PARAM_STR);
    
   if (!$boura->execute()) {
    echo "Erreur SQL : " . implode(', ', $boura->errorInfo());
} else {
    echo "Le contact a été ajouté avec succès.";
}

}

public static function getAllContacts($conn) {
    $sql = "SELECT * FROM contacts";
    $stmt = $conn->query($sql);
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









class ContactFactory implements ContactFactoryInterface {
    public function createContact($nom, $prenom, $numero_telephone, $favori) {
        return new Contact($nom, $prenom, $numero_telephone, $favori);
    }
}







?>