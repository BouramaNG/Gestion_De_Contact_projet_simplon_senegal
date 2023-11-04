<?php
// session_start();
$contacts = [];
if (isset($_POST["deconnexion"])) {
    session_destroy();
    header("location:index.php");
}
if (isset($_POST["recherche"])) {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=taxi", "root", "root");
        // echo "connexion reussi";
    // global $conn;
    $search = $_POST["recherche"];
   $sql ="SELECT * FROM contacts WHERE prenom LIKE :search OR numero_telephone LIKE :search";
   $boura = $conn->prepare($sql);
   $boura->bindParam(":search", $search);
   $boura->execute();
   $contacts = $boura->fetchAll(PDO::FETCH_ASSOC);


} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
 }else {
    echo "Le numero que vous chercher nexiste pas";
 }




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SamaYContact</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        
      </ul>
      <form class="d-flex" role="search" method="post" action="">
        <input class="form-control me-2" name="recherche" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Rechercher</button>
      </form>
      <form action="index.php" method="post">
        <button class="btn btn-danger" type="submit" name="deconnexion">Déconnexion</button>
      </form>
    </div>
  </div>
</nav>
<ul>
    <?php foreach ($contacts as $contact) : ?>
        <li>
            Prénom: <?php echo $contact['prenom']; ?><br>
            Numéro de téléphone: <?php echo $contact['numero_telephone']; ?>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>