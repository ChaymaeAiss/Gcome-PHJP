<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/style.css">
    <title>Ajouter_Article</title>
</head>
<body>
    <?php
        require_once 'includes/db.php';
        include_once 'includes/nav.php';
    ?>
    <div class="container my-4">
        <?php
            if(isset($_POST['ajouter'])){
                $article = htmlspecialchars($_POST['article']);
                $ht = htmlspecialchars($_POST['prixht']);
                $tva = htmlspecialchars($_POST['tva']);
                $stock = htmlspecialchars($_POST['stock']);
                $famille = htmlspecialchars($_POST['famille']);

                if( !empty($article) && !empty($ht) && !empty($tva) && !empty($stock) && !empty($famille)){
                    $sqlState = $pdo->prepare('INSERT INTO articles VALUES(null,?,?,?,?,?)');
                    $sqlState->execute([$article,$ht,$tva,$stock,$famille]);
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
     <h4>Ajouter article</h4>
        <div class="mb-5">
            <label class="form-label">Libelle</label>
            <input type="text" class="form-control" placeholder="Veuillez saisir une article"  name="article">
        </div>
        <div class="mb-5">
            <label class="form-label">Prix HT</label>
            <input type="number" stap="0.1" class="form-control" placeholder="Veuillez saisir le prix HT"  name="prixht" min="0">
        </div>
        <div class="mb-5">
            <label class="form-label">TVA</label>
            <input type="text" stap="0.1" class="form-control" placeholder="Veuillez saisir TVA"  name="tva" min="0">
        </div>
        <div class="mb-5">
            <label class="form-label">Qte Stock</label>
            <input type="number" stap="0.1" class="form-control" placeholder="Veuillez saisir le stock"  name="stock" min="0">
        </div>
        <?php
            $famille = $pdo->query('SELECT * FROM famille')->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="mb-5">
           <label class="form-label">Famille</label>
           <select class="form-select" name="famille">
            <option value="">Choisissez une famille</option>
           <?php
                foreach($famille as $data){
            ?>
            <option value="<?= $data['id'];?>"><?= $data['familleN']; ?></option>
            <?php        
                }
            ?>
           </select> 
        </div>
        <button type="submit" class="btn btn-primary" name="ajouter">Ajouter</button> <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
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