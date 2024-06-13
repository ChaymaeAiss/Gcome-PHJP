<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/style.css">
    <title>Ajouter_Famille</title>
</head>
<body>
    <?php
        require_once 'includes/db.php';
        include_once 'includes/nav.php';
    ?>
    <div class="container my-4">
        <?php
            if(isset($_POST['ajouter'])){
                $famille = htmlspecialchars($_POST['famille']);

                if(!empty($famille)){
                    $sqlState = $pdo->prepare('INSERT INTO famille VALUES(null,?)');
                    $sqlState->execute([$famille]);
                    header('Location: famille.php');
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
        <div class="mb-5">
            <h4>Ajouter famille</h4>
            <label class="form-label">Libelle</label>
            <input type="text" class="form-control" placeholder="Veuillez saisir une famille"  name="famille">
        </div>
        <button type="submit" class="btn btn-primary" name="ajouter">Ajouter</button> <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
     </form>
    </div>
    <script>
        document.getElementById("cancel").addEventListener("click", function() {
            window.location.href = "famille.php";
        });
    </script>
    <script src="includes/index.js"></script>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            