<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <link rel="stylesheet" href="includes/style.css">
    <title>Bon_livraison</title>
</head>
<body>
    <?php
        require_once 'includes/db.php';
        include_once 'includes/nav.php';
        $sqlState = $pdo->query('SELECT bonlivraison.id,date_r,reglé,CONCAT(clients.nom, " ", clients.prenom) as ncl,CONCAT(caissier.nom, " ", caissier.prenom) as nca FROM bonlivraison,clients,caissier WHERE bonlivraison.client_id=clients.id AND bonlivraison.caissier_id=caissier.id ORDER BY bonlivraison.id ASC');

        $data = $sqlState->fetchAll(PDO::FETCH_OBJ);
    ?>
    <div class="container">
        <br><br>
        <h1>Listes des Bons de livraison</h1>
        <a href="ajouterbl.php" class='btn btn-success btn-sm link float-end'>Ajouter</a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Date</th>
                    <th scope="col">Reglé</th>
                    <th scope="col">Client</th>
                    <th scope="col">Cassier</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 foreach($data as $value){
                ?>
                    <tr>
                        <td><?= $value->id ?></td>
                        <td><?= $value->date_r ?></td>
                        <td><?= $value->reglé == 1 ? 'Oui' : 'Non' ?></td>
                        <td><?= $value->ncl ?></td>
                        <td><?= $value->nca?></td>
                        <td>
                            <form method="post">
                                <a href="supprimerbl.php?id=<?php echo $value->id  ?>" onclick="return confirm('Voulez-vous supprimer ce enregistrement?')" class='btn btn-danger btn-sm'>Supprimer</a>
                                <a href="d_bl.php?id=<?php echo $value->id  ?>" class='btn btn-warning btn-sm'>Details</a>
                            </form>
                        </td>
                    </tr>
                <?php
                 }
                ?>
            </tbody>
        </table>
    </div>
    <script src="includes/index.js"></script>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            