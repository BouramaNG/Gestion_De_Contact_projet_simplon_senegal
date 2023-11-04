<?php
// session_start();
require_once'../template/header.php';
require_once'../../../contactForm.php';
require_once'../../controller/ContactController.php';
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["action"])) {
        if ($_GET["action"] === "viewFavorites") {
            
            if (isset($_SESSION['utilisateur_id'])) {
                $utilisateur_id = $_SESSION['utilisateur_id'];

                $favoris = $contactController->getFavorites($utilisateur_id, $conn);

                if (!empty($favoris)) {
                    echo "<h2>Vos Favoris</h2>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Nom</th>";
                    echo "<th>Prénom</th>";
                    echo "<th>Numéro de téléphone</th>";
                    echo "<th>Action</th>";
                    echo "</tr>";

                    foreach ($favoris as $favori) {
                        echo "<tr>";
                        echo "<td>{$favori['nom']}</td>";
                        echo "<td>{$favori['prenom']}</td>";
                        echo "<td>{$favori['numero_telephone']}</td>";
                    
                        echo '<td><form method="POST" action="supprimerFavori.php">';
                        echo '<input type="hidden" name="favori_id" value="' . $favori['id'] . '">';
                        echo "<a class='delete-button' href='voirFav.php?action=removeFavoris&id=" . $favori['id'] . "'>Enlever Favoris</a>";

                        echo '</form></td>';
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "Aucun favori trouvé.";
                }
            } else {
               
                echo "Vous n'êtes pas connecté. Veuillez vous connecter pour accéder à vos favoris.";
                
            }
        }
    }
}
