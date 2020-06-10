<?php
    require '../includes/back/connect.php';
    if(!empty($_GET['id'])){
        $req = $db->prepare("SELECT fichier_description FROM description WHERE id_projet = ?");
        $exec = $req->execute(array($_GET['id']));
        $result = $req->fetchAll();
        $url_fichier = $result[0]['fichier_description'];

        $url_fichier = '../' . $url_fichier;
        
        header('Content-Type: application/octet-stream');
        header('Content-Transfert-Encoding: Binary');
        header('Content-disposition: attachment; filename="' . basename($url_fichier) . '"');
        echo readfile($url_fichier);
        unset($_SESSION['id_projet']);
    }
    
?>