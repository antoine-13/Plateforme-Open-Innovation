<?php
    $req = $db->prepare("SELECT fichier_description FROM description WHERE id_projet = ?");
    $exec = $req->execute(array($_GET['id']));
    $result = $req->fetchAll();
    $url_fichier = $result[0]['fichier_description'];
?>