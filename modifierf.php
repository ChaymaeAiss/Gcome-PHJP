<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/style.css">
    <title>Modifier_Famille</title>
</head>
<body>
    <?php
        require_once 'includes/db.php';;
        include_once 'includes/nav.php';
    ?>
    <div class="container my-4">
        <?php
            $sqlState = $pdo->prepare(query: 'SELECT * FROM famille WHERE id=?');
            $id = $_GET['id'];
            $sqlState->execute([$id]);

            $data = $sqlState->fetch(PDO::FETCH_ASSOC);
            if(isset($_POST['modifier'])){
                $famille = htmlspecialchars($_POST['famille']);

                if(!empty($famille)){
                    $sqlState = $pdo->prepare('UPDATE famille SET familleN = ? WHERE id=?');
                    $sqlState->execute([$famille,$id]);
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
     <h4>Modifier famille</h4>
        <div class="mb-5">
            <input type="hidden" class="form-control" name="id" value="<?php echo $data['id'] ?>">
        </div>
        <div class="mb-5">
            <label class="form-label">Libelle</label>
            <input type="text" class="form-control" name="famille" value="<?php echo $data['familleN'] ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="modifier">Modifier</button> <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
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