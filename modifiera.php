<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/style.css">
    <title>Modifier_Article</title>
</head>
<body>
    <?php
        require_once 'includes/db.php';;
        include_once 'includes/nav.php';
    ?>
    <div class="container my-4">
        <?php
            $sqlState = $pdo->prepare(query: 'SELECT * FROM articles WHERE id=?');
            $id = $_GET['id'];
            $sqlState->execute([$id]);
            $data = $sqlState->fetch(PDO::FETCH_ASSOC);
            if(isset($_POST['modifier'])){
                $article = htmlspecialchars($_POST['article']);
                $prixht = htmlspecialchars($_POST['prixht']);
                $tva = htmlspecialchars($_POST['tva']);
                $stock = htmlspecialchars($_POST['stock']);
                $famille = htmlspecialchars($_POST['famille']);

                if(!empty($article) && !empty($prixht) && !empty($tva) && !empty($stock) && !empty($famille)){
                    $sqlState = $pdo->prepare('UPDATE articles SET designation=?,prix_ht=?,tva=?,stock=?,famille_id=? WHERE id=?');
                    $sqlState->execute([$article,$prixht,$tva,$stock,$famille,$id]);
                    header('Location: article.php');
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
     <h4>Modifier article</h4>
     <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <div class="mb-5">
            <label class="form-label">Libelle</label>
            <input type="text" class="form-control" name="article" value="<?= $data['designation'] ?>">
        </div>
        <div class="mb-5">
            <label class="form-label">Prix HT</label>
            <input type="number" stap="0.1" class="form-control" value="<?= $data['prix_ht'] ?>" name="prixht" min="0">
        </div>
        <div class="mb-5">
            <label class="form-label">TVA</label>
            <input type="text" stap="0.1" class="form-control" value="<?= $data['tva'] ?>" name="tva" min="0">
        </div>
        <div class="mb-5">
            <label class="form-label">Qte Stock</label>
            <input type="number" stap="0.1" class="form-control" value="<?= $data['stock'] ?>"  name="stock" min="0">
        </div>
        <label class="form-label">Famille</label>
        <?php
            $familles = $pdo->query('SELECT * FROM famille')->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="mb-5">
           <select class="form-select" name="famille">
           <?php
           
           foreach ($familles as $famille) {
            $selected = ($data['famille_id'] == $famille['id']) ? 'selected' : '';
            echo "<option $selected value='" . $famille['id'] . "'>" . $famille['familleN'] . "</option>";
        }
            ?>
           </select> 
        </div>
        <button type="submit" class="btn btn-primary" name="modifier">Modifier</button> <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
     </form>
    </div>
    <script>
        document.getElementById("cancel").addEventListener("click", function() {
            window.location.href = "article.php";
        });
    </script>
    <script src="includes/index.js"></script>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            