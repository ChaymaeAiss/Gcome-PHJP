<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <link rel="stylesheet" href="includes/style.css">
    <title>Modifier_Clients</title>
</head>

<body>
<?php
        require_once 'includes/db.php';;
        include_once 'includes/nav.php';
?>
<div class="container my-5">
    <?php
    require_once 'includes/db.php';
    include_once 'includes/nav.php';
    $sqlState = $pdo->prepare('SELECT * FROM clients WHERE id=?');
    $id = $_GET['id'];
    $sqlState->execute([$id]);

    $clients = $sqlState->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['modifier'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];


        if (!empty($nom) && !empty($prenom) && !empty($adresse) && !empty($ville)) {
            $sqlState = $pdo->prepare('UPDATE clients SET nom = ?,
                                                         prenom=?,
                                                         adresse=?,
                                                         ville=?
                                                          WHERE id = ?');
            $sqlState->execute([$nom,$prenom,$adresse,$ville, $id]);
            
            header('location: client.php');
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
            Tous les champs sont obligatoire
            </div>
            <?php
        }

    }

    ?>
<form method="post">
        <h2>Modifier Client</h2>
        <br><br>
        <div class="mb-5">
            <label for="nom "class="form-label">Nom:</label>
            <input type="text" name="nom" class="form-control" value="<?php echo $clients['nom'] ?>">
        </div>
        <div class="mb-5">
            <label for="prenom" class="form-label">Prénom:</label>
            <input type="text" name="prenom" class="form-control" value="<?php echo $clients['prenom'] ?>">
        </div>
        <div class="mb-5">
            <label for="adresse" class="form-label">Adresse:</label>
            <input type="text" name="adresse" class="form-control" value="<?php echo $clients['adresse'] ?>">
        </div>
        <div class="mb-5">
            <label for="ville" class="form-label">Ville:</label>
            <input type="text" name="ville" class="form-control" value="<?php echo $clients['ville'] ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="modifier">Modifier</button> <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
</div>
<script>
        document.getElementById("cancel").addEventListener("click", function() {
            window.location.href = "client.php";
        });
</script>
<script src="includes/index.js"></script>
</body>

</html>

