<?php
    require '../includes/back/connect.php';
    if(!empty($_GET['id_description'])){
        $req = $db->prepare("SELECT fichier_description FROM description WHERE id_projet = ?");
        $exec = $req->execute(array($_GET['id_description']));
        $result = $req->fetchAll();
        $url_fichier = $result[0]['fichier_description'];

        $url_fichier = '../' . $url_fichier;
        
        header('Content-Type: application/octet-stream');
        header('Content-Transfert-Encoding: Binary');
        header('Content-disposition: attachment; filename="' . basename($url_fichier) . '"');
        echo readfile($url_fichier);
        
    }
    if(!empty($_GET['id_rendu'])){
        $req = $db->prepare("SELECT destination FROM fichier WHERE id_rendu = ?");
        $exec = $req->execute(array($_GET['id_rendu']));
        $result = $req->fetchAll();

        foreach($result as $value){
            $url_fichier = $value['destination'];

            $url_fichier = '../' . $url_fichier;
            
            header('Content-Type: application/octet-stream');
            header('Content-Transfert-Encoding: Binary');
            header('Content-disposition: attachment; filename="' . basename($url_fichier) . '"');
            echo readfile($url_fichier);
        }
        
    }
    
?>