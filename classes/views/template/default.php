<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
}

.container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

.forms-container {
    display: flex;
    justify-content: space-between;
}

.form {
    background-color: #fff;
    padding: 30px;
    border: 1px solid #e0e0e0;
    width: 40%;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.btn {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
}

.btn:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="form signin-form">
                <h2>Connexion</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Entrez votre email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <input type="submit" name="connexion" class="btn" value="Connexion">
                </form>
            </div>
            <div class="form signup-form">
                <h2>Inscription</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Entrez votre email" required>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone</label>
                        <input type="text" id="telephone" name="telephone" placeholder="Entrez votre numéro de téléphone" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="Choisissez un mot de passe" required>
                    </div>
                    <input type="submit" name="inscription" class="btn" value="Incription">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
