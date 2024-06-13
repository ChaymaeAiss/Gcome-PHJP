<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <link rel="stylesheet" href="includes/style.css">
    <title>Gestion_Caissier</title>
</head>
<body>
    <?php
        require_once 'includes/db.php';
        include_once 'includes/nav.php';
        $sqlState = $pdo->query('SELECT * FROM caissier');
        $data = $sqlState->fetchAll(PDO::FETCH_OBJ);
    ?>
    <div class="container">
        <br><br>
        <h1>Listes des Caissier</h1>
        <a href="ajouterca.php" class='btn btn-success btn-sm link float-end'>Ajouter</a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Poste</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 foreach($data as $value){
                ?>
                    <tr>
                        <td><?= $value->id ?></td>
                        <td><?= $value->nom ?></td>
                        <td><?= $value->prenom ?></td>
                        <td><?= $value->poste ?></td>
                        <td><?= $value->admin == 1 ? 'Oui' : 'Non' ?></td>
                        <td>
                            <form method="post">
                            <a href="modifierca.php?id=<?php echo $value->id  ?>" class='btn btn-primary btn-sm'>Modifier</a>
                                <a href="supprimerca.php?id=<?php echo $value->id  ?>" onclick="return confirm('Voulez-vous supprimer ce enregistrement?')" class='btn btn-danger btn-sm'>Supprimer</a>
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