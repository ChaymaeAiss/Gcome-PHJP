<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/style.css">
    <title>Ajouter_Client</title>
</head>

<body>
<?php
        require_once 'includes/db.php';
        include_once 'includes/nav.php';
?>
<div class="container my-4">
<?php
        if(isset($_POST['ajouter'])){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $adresse = $_POST['adresse'];
            $ville = $_POST['ville'];

            if(!empty($nom) && !empty($prenom) && !empty($adresse) && !empty($ville)){
                $sqlState = $pdo->prepare('INSERT INTO clients VALUES(null,?,?,?,?)');
                $sqlState->execute([$nom,$prenom,$adresse,$ville]);
                header('location: client.php');
            }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    Tous les champs sont obligatoire
                </div>
                <?php
            }
        }
?>

<form method="post">
<h2>Ajouter client</h2>
<br><br>
        <div class="mb-5">
            <label for="nom" class="form-label">Nom:</label>
            <input type="text" class="form-control" placeholder="Veuillez saisir le nom du client"  name="nom">
        </div>
        <div class="mb-5">
            <label for="prenom" class="form-label">Prénom:</label>
            <input type="text" class="form-control" placeholder="Veuillez saisir le prénom du client"  name="prenom">
        </div>
        <div class="mb-5">
            <label for="adresse" class="form-label">Adresse:</label>
            <input type="text" class="form-control" placeholder="Veuillez saisir l'adresse du client"  name="adresse">
        </div>
        <div class="mb-5">
            <label for="ville" class="form-label">Ville:</label>
            <input type="text" class="form-control" placeholder="Veuillez saisir la ville du client"  name="ville">
        </div>
        <div class="form-btn">
        <button type="submit" class="btn btn-primary" name="ajouter">Ajouter</button> <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
      </form>
</div>
<script>
        document.getElementById("cancel").addEventListener("click", function() {
            window.location.href = "client.php";
        });
</script>
<script src="includes/index.js"></script>

</body>

</html>

