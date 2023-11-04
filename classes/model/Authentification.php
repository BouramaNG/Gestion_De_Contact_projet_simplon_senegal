<?php

namespace classes\model;
use PDO;
require_once(__DIR__ . '/../views/template/default.php');



class Authentification
{
  
    private $conn;

    public function __construct($conn)
    {
      
        $this->conn = $conn;
        
    }
   public function ValidationFormulaire()
   {
    if (isset($_POST["inscription"])) {
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $email = $_POST["email"];
      $telephone = $_POST["telephone"];
      $pass = $_POST["password"];
       if (!preg_match('/^[A-Za-z]+$/', $nom) || !preg_match('/^[A-Za-z]+$/', $prenom)) {
        echo "<div style='background-color: green; color: white; text-align: center;'>Le nom et le prénom doivent contenir uniquement des lettres.</div>";
      
        return;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "<div style='background-color: red; color: white; text-align: center;'>L'adresse email n'est pas valide.</div>";
        return;
    }

    if (!preg_match('/^77\d{7}$/', $telephone)) {
      "<div style='background-color: blue; color: white; text-align: center;'>Le numéro de téléphone n'est pas valide.</div>";
        return;
    }
    if (strlen($pass) < 6 || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $pass)) {
      echo "<div style='background-color: orange; color: white; text-align: center;'>Le mot de passe doit contenir au moins 6 caractères avec des caractères spéciaux.</div>";
        return;
    }
     
      $this->InsereUtilisateur($nom, $prenom, $email, $telephone, $pass);
    }
   
   }

   private function InsereUtilisateur($nom,$prenom,$email,$telephone,$pass)
   {
       $sql ="INSERT INTO client (nom,prenom,email,telephone,password) VALUES(:nom,:prenom,:email,:telephone,:password)";
       $boura = $this->conn->prepare($sql);
       $boura->bindParam(":nom", $nom, PDO::PARAM_STR);
       $boura->bindParam(":prenom", $prenom, PDO::PARAM_STR);
       $boura->bindParam(":email", $email, PDO::PARAM_STR);
       $boura->bindParam(":telephone", $telephone, PDO::PARAM_STR);
       $boura->bindParam(":password", $pass, PDO::PARAM_STR);
       if ($boura->execute()) {
        // var_dump($boura);
        // die(); 
        echo "<div style='background-color: green; color: white; text-align: center;'>Felicitation vous vous etes inscript avec succe.</div>";
       }else {
        echo "<div style='background-color: red; color: white; text-align: center;'>Oupps xolatal ligua dougual amna lou mbeguowoule.</div>";
       }
   }


   public function KayMaAuthentifierLA($email,$password)
   {
    
    if (isset($_POST["connexion"])) {
      $email = $_POST["email"];
      $password = $_POST["password"];
      $sql = "SELECT * FROM client WHERE email=:email";
      $boura = $this->conn->prepare($sql);  
      $boura->bindParam(":email", $email, PDO::PARAM_STR);    
      $boura->execute();
      $user = $boura->fetch(PDO::FETCH_ASSOC);
      if ($user && $password === $user["password"]) {
        session_start();

$_SESSION['utilisateur_connecte'] = true;
$_SESSION['utilisateur_id'] = $user['id'];
$_SESSION['utilisateur_nom'] = $user['nom'];

header("Location: contactForm.php");
exit();

      }else {
        echo "<div style='background-color: red; color: white; text-align: center;'>oupsss xolatal bou bakh si araf yigua dougal mbeguo wougnou.</div>";
      }
    }
   }

   public function getAllUsers()
{
    $sql = "SELECT * FROM client";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}



?>