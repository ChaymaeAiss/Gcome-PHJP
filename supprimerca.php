<?php
    require_once 'includes/db.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare(query: 'DELETE FROM caissier WHERE id=?');
    $supprimer = $sqlState->execute([$id]); 
    if($supprimer){
        header('Location: caissier.php');
    }else{
        echo "Erreur!";
    }
?>