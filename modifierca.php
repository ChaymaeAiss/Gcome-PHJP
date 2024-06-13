<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/style.css">
    <title>Ajouter_Caissier</title>
</head>
<body>
    <?php
        require_once 'includes/db.php';
        include_once 'includes/nav.php';
    ?>
    <div class="container my-4">
    <?php
            $sqlState = $pdo->prepare(query: 'SELECT * FROM caissier WHERE id=?');
            $id = $_GET['id'];
            $sqlState->execute([$id]);
            $data = $sqlState->fetch(PDO::FETCH_ASSOC);
            if(isset($_POST['modifier'])){
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $poste = htmlspecialchars($_POST['poste']);
                $admin = htmlspecialchars($_POST['admin'])&& $_POST['admin'] ? 1 : 0;

                if(!empty($nom) && !empty($prenom) && !empty($poste)){
                    $sqlState = $pdo->prepare('UPDATE caissier SET nom=?,prenom=?,poste=?,admin=? WHERE id=?');
                    $sqlState->execute([$nom,$prenom,$poste,$admin,$id]);
                    header('Location: caissier.php');
                }else{
                  ?>
                   <div class="alert alert-danger" role="alert">
                     Champs obligatoires!
                   </div>
                  <?php  
                }
            }

        ?>
     <form method="POST">
     <h4>Modifier caissier</h4>
     <br><br>
     <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <div class="mb-5">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" placeholder="Veuillez saisir le nom de caissier"  name="nom" value="<?= $data['nom'] ?>">
        </div>
        <div class="mb-5">
            <label class="form-label">Prénom</label>
            <input type="text" class="form-control" placeholder="Veuillez saisir le prénom de caissier"  name="prenom" value="<?= $data['prenom'] ?>">
        </div>
        <div class="mb-5">
            <label class="form-label">Poste</label>
            <input type="text" class="form-control" placeholder="Veuillez saisir le poste de caissier"  name="poste" value="<?= $data['poste'] ?>">
        </div>
        <div class="mb-5">
      <div class="form-check">
        <label class="form-check-label">
          Admin
        </label> 
        <input class="form-check-input" type="checkbox" name="admin" <?php echo $data['admin'] == 1 ? 'checked' : ''; ?>>
      </div>
    </div>
        <button type="submit" class="btn btn-primary" name="modifier">Modifier</button> <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
     </form>
    </div>
    <script>
        document.getElementById("cancel").addEventListener("click", function() {
            window.location.href = "caissier.php";
        });
    </script>
    <script src="includes/index.js"></script>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            