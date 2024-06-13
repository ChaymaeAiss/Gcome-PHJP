<?php
require 'includes/db.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Get form data
    $bl_id = $_POST['bl_id'];
    $article_designation = $_POST['article_designation'];

    // Ensure the quantity value is an integer
    $quantite = intval($_POST['qte']);
    $prix_ht = $_POST['prix_ht'];

    try {
        // Query to get the article_id based on the selected designation
        $sqlGetArticleId = "SELECT id FROM articles WHERE designation = :designation";
        $stmtGetArticleId = $pdo->prepare($sqlGetArticleId);
        $stmtGetArticleId->bindParam(':designation', $article_designation);
        $stmtGetArticleId->execute();

        // Fetch the article_id
        $result = $stmtGetArticleId->fetch(PDO::FETCH_ASSOC);
        $article_id = $result['id'];

        // Insert data into the detail_bl table (without specifying id)
        $sql = "INSERT INTO detail_bl (bl_id, article_id, qte) VALUES (:bl_id, :article_id, :qte)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':bl_id', $bl_id);
        $stmt->bindParam(':article_id', $article_id);
        $stmt->bindParam(':qte', $quantite);

        $stmt->execute();

        // Redirect to the Delivery Note details page
        header("Location: d_bl.php?id=" . $bl_id);
        exit();
    } catch (PDOException $e) {
        echo "Insertion error: " . $e->getMessage();
    }
}
?>
<!-- ... Remaining HTML code ... -->
