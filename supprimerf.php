<?php
    require_once 'includes/db.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare(query: 'DELETE FROM famille WHERE id=?');
    $supprimer = $sqlState->execute([$id]); 
    if($supprimer){
        header('Location: famille.php');
    }else{
        echo "Erreur!";
    }
?>