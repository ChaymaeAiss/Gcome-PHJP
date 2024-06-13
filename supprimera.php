<?php
    require_once 'includes/db.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare(query: 'DELETE FROM articles WHERE id=?');
    $supprimer = $sqlState->execute([$id]); 
    if($supprimer){
        header('Location: article.php');
    }else{
        echo "Erreur!";
    }
?>