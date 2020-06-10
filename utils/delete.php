<?php
    include 'includes/back/connect.php';
    if($_SESSION['type'] = "professeur"){
        $id = $_GET['id'];

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