<?php
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=gecome2','root','');
    }
    catch (PDOException $e){
        echo"<p>Erreur: ".$e->getMessage();
        die();
    }
?>