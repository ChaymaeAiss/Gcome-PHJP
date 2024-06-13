<?php
require 'includes/db.php';
include_once 'includes/nav.php';

$bon_id = $_GET['id'];

// Initialize the variable for searching by designation
$Designation = '';

// Check if the search form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['designation'])) {
    $Designation = $_POST['designation'];
}

// Retrieve the detail_bl details related to this delivery note with a filter by designation
$sqlDetail_bl = 'SELECT d.id, d.article_id, a.designation, d.qte, a.prix_ht, (d.qte * a.prix_ht) as total
                FROM detail_bl d, articles a where d.article_id = a.id
                and d.bl_id = :bl_id';

// Add the condition to filter by designation if a search designation is specified
if (!empty($Designation)) {
    $sqlDetail_bl .= ' AND a.designation LIKE :search_designation';
}

$statementDetail_bl = $pdo->prepare($sqlDetail_bl);
$statementDetail_bl->bindParam(':bl_id', $bon_id);

// Add the parameter for the search designation if specified
if (!empty($Designation)) {
    $searchParam = '%' . $Designation . '%';
    $statementDetail_bl->bindParam(':search_designation', $searchParam);
}

$statementDetail_bl->execute();
$detailsDetail_bl = $statementDetail_bl->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <link rel="stylesheet" href="includes/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <title>Bon_livraison</title>
</head>
<body>
    <div class="container">
        <!-- Add the search form -->
        <form method="post" action="d_bl.php?id=<?= $bon_id; ?>" class="form-inline justify-content-end">
        <br><br><br>
            <h3>Recherche par Designation :</h3>
            <div class="input-group mb-2">
                <input type="search" name="designation" class="form-control" placeholder="Rechercher vos articles..." value="<?= $Designation; ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-dark"><i class='bx bx-search'></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h2>Détails du Bonlivraison</h2>
            </div>
            <div class="card-body">
                <!-- Add the form for insertion -->
                <form method="post" action="insert_detail.php">
                    <input type="hidden" name="bl_id" value="<?= $bon_id; ?>">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Désignation</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Total</th>
                        </tr>
                        <?php foreach ($detailsDetail_bl as $detail): ?>
                            <tr>
                                <td><?= $detail->id; ?></td>
                                <td><?= $detail->designation; ?></td>
                                <td><?= $detail->qte; ?></td>
                                <td><?= $detail->prix_ht; ?></td>
                                <td><?= $detail->total; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" align="right"><strong>Total Amount:</strong></td>
                            <td>
                                <?php
                                // Calculate and display the total amount
                                $totalAmount = array_sum(array_column($detailsDetail_bl, 'total'));
                                echo number_format($totalAmount, 2); // Format as a currency, adjust as needed
                                ?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <select name="article_designation" class="form-control article-select">
                                    <?php
                                    // Retrieve and display the list of articles by their designation
                                    $sqlArticlesDesignation = 'SELECT id, designation, prix_ht FROM articles';
                                    $statementArticlesDesignation = $pdo->prepare($sqlArticlesDesignation);
                                    $statementArticlesDesignation->execute();
                                    $articlesDesignation = $statementArticlesDesignation->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($articlesDesignation as $articleDesignation) {
                                        echo "<option value=\"" . $articleDesignation['designation'] . "\" data-prix-ht=\"" . $articleDesignation['prix_ht'] . "\">" . $articleDesignation['designation'] . "</option>";
                                    }
                                    ?>
                                </select>
                                
                            </td>
                            <td><input type="number" name="qte" min="1" class="form-control"></td>
                            <td><input type="text" name="prix_ht" class="form-control prix-ht" readonly></td>
                            <td><button type="submit" class="btn btn-secondary">Valider</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <script>
         // Initialise Select2 pour l'élément avec la classe .article-select
        $(document).ready(function() {
            $('.article-select').select2();
        });
        // Select relevant elements
        var articleDesignationSelect = document.querySelector('[name="article_designation"]');
        var prixHtInput = document.querySelector('.prix-ht');

        // Add an event listener to detect changes in the designation fields
        articleDesignationSelect.addEventListener('change', updatePrixHt);

        function updatePrixHt() {
            // Get the selected value from the designation field
            var selectedOption = articleDesignationSelect.options[articleDesignationSelect.selectedIndex];
            var prixHt = selectedOption.dataset.prixHt;

            // Update the value of 'Prix HT' field
            prixHtInput.value = prixHt;
        }
    </script>

</body>
</html>
