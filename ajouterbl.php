<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <link rel="stylesheet" href="includes/style.css">
    <title>Ajouter_Bon_livraison</title>
</head>
<body>
    <?php
        require_once 'includes/db.php';
        include_once 'includes/nav.php';
    ?>
<div class="container">
<?php
            if(isset($_POST['ajouter'])){
                $date = htmlspecialchars($_POST['date']);
                $regle = isset($_POST['regle']) && $_POST['regle'] ? 1 : 0;
                $nomcl = htmlspecialchars($_POST['client']);
                $nomca= htmlspecialchars($_POST['caissier']);

                if( !empty($nomcl) && !empty($nomca) && !empty($date)){
                    $sqlState = $pdo->prepare('INSERT INTO bonlivraison VALUES(null,?,?,?,?)');
                    $sqlState->execute([$date, $regle, $nomcl, $nomca]);
                    header('Location: bl.php');
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
    <br><br>
    <h3>Ajouter bon de livraison</h3> <br>
    <?php
        $client= $pdo->query('SELECT id,CONCAT(nom, " ", prenom) AS nca FROM clients')->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="mb-4">
      <label class="form-label">Client</label>
      <select class="form-select" name="client">
        <?php
            foreach($client as $data){
        ?>
        <option value="<?= $data['id']; ?>" <?= ($data['id'] == 7) ? 'selected' : ''; ?>>
            <?= $data['nca']; ?>
        </option>
        <?php        
            }
        ?>
      </select>
    </div>
    <?php
        $caissier = $pdo->query('SELECT id,CONCAT(nom, " ", prenom) AS ncl FROM caissier')->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="mb-4">
      <label class="form-label">Caissier</label>
      <select class="form-select" name="caissier">
        <option >Choisissez un caissier</option>
        <?php
            foreach($caissier as $data){
        ?>
        <option value="<?= $data['id'];?>"><?= $data['ncl']; ?></option>
        <?php        
            }
        ?>
      </select>
    </div>
    <div class="mb-4">
      <label class="form-label">Date de reglement</label>
      <input class="form-control" type="date" name="date" value="<?= date('Y-m-d') ?>">
    </div>
    <div class="mb-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="regle">
        <label class="form-check-label">
          Reglé
        </label>
      </div>
    </div>
    <button type="submit" class="btn btn-primary" name="ajouter">Ajouter</button> <input type="button"  class="btn btn-danger" value="Cancel" onclick="window.location.href='bl.php'">
 </form>
</div>

    <script src="includes/index.js"></script>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            