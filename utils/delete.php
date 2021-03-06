<?php
    include '../includes/back/connect.php';
    if($_SESSION['type'] = "professeur"){
        $id = $_GET['id'];

        $req5 = $db->prepare("SELECT destination FROM fichier AS f INNER JOIN Rendu AS r ON f.id_rendu=r.id_rendu INNER JOIN Projet AS p ON p.id_projet = r.id_projet WHERE p.id_projet = ?");
        $exec = $req5->execute(array($id));
        $result5 = $req5->fetchAll();

        foreach($result5 as $value){
            if(file_exists('../' . $value['destination'])) {
                unlink('../' . $value['destination']);
            }
        }

        $req6 = $db->prepare("SELECT nom_projet, url_img FROM Projet WHERE id_projet = ?");
        $exec = $req6->execute(array($id));
        $result6 = $req6->fetchAll();

        foreach($result6 as $value){
            if(!empty($value['url_img'])) {
                unlink('../' . $value['url_img']);
            }

            $dossier_projet = 'files/' . $value['nom_projet'];
            $dossier_rendu = $dossier_projet . '/rendu';
            $file_description = $dossier_projet . '/description.pdf';
            
            if(file_exists('../' . $file_description)) {
                unlink('../' . $file_description);
            }

            if (is_dir('../' . $dossier_rendu)) {
                if(rmdir('../' . $dossier_rendu)){
                    rmdir('../' . $dossier_projet);
                }
            }

        }

        $req1 = $db->prepare("DELETE FROM description WHERE id_projet = ?;");
        $exec = $req1->execute(array($id));

        $req7 = $db->prepare("SELECT id_groupe FROM Groupe WHERE id_projet = ?");
        $exec = $req7->execute(array($id));
        $result7 = $req7->fetchAll();

        foreach($result7 as $value){
            $req2 = $db->prepare("DELETE FROM participant WHERE id_groupe = ?;");
            $exec = $req2->execute(array($value['id_groupe']));
        }

        $req8 = $db->prepare("DELETE FROM Groupe WHERE id_projet = ?");
        $exec = $req8->execute(array($id));

        $req3 = $db->prepare("DELETE FROM projet WHERE id_projet = ?;");
        $exec = $req3->execute(array($id));

        $req4 = $db->prepare("DELETE FROM rendu WHERE id_projet = ?;");
        $exec = $req4->execute(array($id));

        $req4 = $db->prepare("DELETE FROM soutenance WHERE id_projet = ?;");
        $exec = $req4->execute(array($id));
    }
header('Location: ../professeur/validation.php')
?>