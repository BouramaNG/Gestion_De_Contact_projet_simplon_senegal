<?php
use classes\model\Autoloader;
use classes\model\MyDB;
use classes\model\Authentification;
use classes\controller\ContactController;
use classes\model\Contact;

require_once'classes/model/MyDB.php';
require_once'classes/model/Autoloader.php';
require_once'classes/views/template/default.php';
require_once'classes/model/Contact.php';
require_once'classes/model/Authentification.php';
// require_once'classes/controller/ContactController.php';
// require_once'classes/views/template/contactForm.php';
// require("model/MyDB.php");
// echo  "Teste";


$host ="localhost";
$username ="root";
$dbname ="taxi";
$password ="root";
Autoloader::register();
$connection1 = new MyDB($host, $username, $dbname, $password);
$connection1->connection();
$conn = $connection1->getConn();
 $auth = new Authentification($conn);

   if ($_SERVER["REQUEST_METHOD"]==='POST') {
    if (isset($_POST["connexion"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $auth->KayMaAuthentifierLA($email, $password);  
    } else if (isset($_POST["inscription"])) {
        $auth->ValidationFormulaire();
   }


   }



//    session_start();

//    if (isset($_SESSION['utilisateur_connecte']) && $_SESSION['utilisateur_connecte'] === true) {
//        // L'utilisateur est connecté, redirigez-le vers le formulaire de gestion des contacts
//        header("Location: classes/views/template/contactForm.php");
//        exit();
//    } else {
//        // L'utilisateur n'est pas connecté, affichez le formulaire de connexion et d'inscription
//        include "default.php";
//    }
   

// // Vérifiez si l'utilisateur est connecté en fonction de la variable de session
// if (isset($_SESSION['utilisateur_connecte']) && $_SESSION['utilisateur_connecte'] === true) {
//     // L'utilisateur est connecté, affichez le formulaire de gestion des contacts
//     include "classes/views/template/contactForm.php";
// } else {
//     // L'utilisateur n'est pas connecté, affichez les formulaires de connexion et d'inscription
//     include "classes/views/template/default.php"; // Remplacez "formulaire_connexion.php" par le nom de votre fichier de connexion
    
// }
 
   

   










// $url = trim($_SERVER["REQUEST_URI"],"/");
// $url = explode("/",$url);
// print_r($url);

// /**
//  * ici je cree mon controlleur pour verifie les requetes 
//  * 
//  */
// $route = array("Acceuil","Contacte","Produit");
// $action = $url[1];
// if (!in_array($action,$route)) {
//    echo "Oupps un erreur s'est produit";
// }else {
//     // echo "Bienvenu dans la page ".$action;
//     $function = "display".ucwords($action);
//     echo $function();
//     $title = 'Page'.$action;
//     $content = 'Page'.$function;
//     require VIEWS.SP."template".SP."default.php";    
// }






?>