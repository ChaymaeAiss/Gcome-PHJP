<?php
    require_once 'includes/db.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare(query: 'DELETE FROM clients WHERE id=?');
    $supprimer = $sqlState->execute([$id]); 
    if($supprimer){
        header('Location: client.php');
    }else{
        echo "Erreur!";
    }
?>