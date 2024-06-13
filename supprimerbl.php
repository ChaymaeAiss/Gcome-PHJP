<?php
    require_once 'includes/db.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare(query: 'DELETE FROM bonlivraison WHERE id=?');
    $supprimer = $sqlState->execute([$id]); 
    if($supprimer){
        header('Location: bl.php');
    }else{
        echo "Erreur!";
    }
?>