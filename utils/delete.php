<?php
    include 'includes/back/connect.php';
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
            if(file_exists('../' . $value['url_img'])) {
                unlink('../' . $value['url_img']);
            }

            $dossier_projet = 'files/' . $value['nom_projet'];

            $file_description = $dossier_projet . '/description.pdf';
            
            if(file_exists('../' . $file_description)) {
                unlink('../' . $file_description);
            }

            if (!is_dir('../' . $dossier_projet)) {
                mkdir('../' . $dossier_projet);
            }

        }

        $req1 = $db->prepare("DELETE FROM description WHERE id_projet = ?;");
        $exec = $req1->execute(array($id));

        $req2 = $db->prepare("DELETE FROM groupe INNER JOIN participant ON groupe.id_groupe = participant.id_groupe WHERE id_projet = ?;");
        $exec = $req2->execute(array($id));

        $req3 = $db->prepare("DELETE FROM projet WHERE id_projet = ?;");
        $exec = $req3->execute(array($id));

        $req4 = $db->prepare("DELETE FROM rendu WHERE id_projet = ?;");
        $exec = $req4->execute(array($id));

        $req4 = $db->prepare("DELETE FROM soutenance WHERE id_projet = ?;");
        $exec = $req4->execute(array($id));
    }
?>