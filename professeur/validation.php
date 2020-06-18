<!-- include du header -->
<?php include_once("../includes/front/header.php");

$req1 = $db->prepare("SELECT id_projet, nom_projet FROM Projet WHERE validation = 0");
$exec = $req1->execute();
$result1 = $req1->fetchAll();

$req3 = $db->prepare("SELECT id_participant, nom_participant, prenom_participant, id_groupe, id_groupe_1 FROM Participant WHERE id_groupe_1 IS NOT NULL");
$exec = $req3->execute();
$result3 = $req3->fetchAll();

?>

<!-- Coder ici -->
<?php if($_SESSION['type'] = 'professeur'){ ?>
<div class="main-container">
    <h1>Validation</h1>
    <div class="tab_validation">
        <?php if(!empty($result1) && !empty($result3)){?>
            <?php foreach($result1 as $value){?>
                <div class="demande">
                    <div>
                        <span><?php echo $value['nom_projet']?></span>
                    </div>
                    <div>
                        <a href="../utils/download.php?id_description=<?php echo $value['id_projet']?>"><span><i class="fas fa-download"></i></span></a>
                        <form action="validation.php" method="post">
                            <input type="hidden" value="<?php echo $value['id_projet']?>" name="id_projet">
                            <button type="submit" name="valider"><i class="fas fa-check"></i></span></button>
                            <a href="../utils/delete.php?id=<?php echo $value['id_projet']?>"><span><i class="fas fa-times"></i></span></a>
                        </form>
                    </div>
                </div>
            <?php } ?>
            <?php foreach($result3 as $value){?>
                <div class="demande">
                    <div>
                        <span><?php echo $value['nom_participant'] . " " . $value['prenom_participant']  ?> :</span>

                        <?php
                            $req7 = $db->prepare('SELECT nom_projet FROM Projet INNER JOIN Groupe ON groupe.id_projet = Projet.id_projet WHERE Groupe.id_groupe = ?');
                            $exec = $req7->execute(array($value['id_groupe']));
                            $result7 = $req7->fetchAll();

                            $req8 = $db->prepare('SELECT nom_projet FROM Projet INNER JOIN Groupe ON groupe.id_projet = Projet.id_projet WHERE Groupe.id_groupe = ?');
                            $exec = $req8->execute(array($value['id_groupe_1']));
                            $result8 = $req8->fetchAll();
                        ?>
                        <div>
                            <span><?php echo $result7[0]['nom_projet'] ?></span>
                            <span><i class="fas fa-exchange-alt"></i></span>
                            <span><?php echo $result8[0]['nom_projet'] ?></span>
                        </div>
                    </div>
                    <div>
                        <form action="validation.php" method="post">
                            <input type="hidden" value="<?php echo $value['id_participant']?>" name="id_participant">
                            <button type="submit" name="accepter"><i class="fas fa-check"></i></span></button>
                            <button type="submit" name="refuser"><span><i class="fas fa-times"></i></span></button>
                        </form>
                    </div>
                </div>
            <?php }?>
        <?php } 
        else {?>
            <div class="demande">
                <div>
                    <span>Aucun projet ni demande de changement à validé</span>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php }

if($_SERVER['REQUEST_METHOD'] = 'POST'){
    if(isset($_POST['valider'])){
        $req2 = $db->prepare("UPDATE Projet SET validation = 1 WHERE id_projet = ?");
        $exec = $req2->execute(array($_POST['id_projet']));
        header("Refresh:0");
    }
    elseif(isset($_POST['accepter'])){
        $id_participant = $_POST['id_participant'];
        $req5 = $db->prepare("UPDATE Participant SET id_groupe = id_groupe_1 WHERE id_participant = '$id_participant' ");
        $exec = $req5->execute();
        $req6 = $db->prepare("UPDATE Participant SET id_groupe_1 = NULL WHERE id_participant = '$id_participant' ");
        $exec = $req6->execute();
        header("Refresh:0");
    }
    elseif(isset($_POST['refuser'])){
        $id_participant = $_POST['id_participant'];
        $req4 = $db->prepare("UPDATE Participant SET id_groupe_1 = NULL WHERE id_participant = '$id_participant' ");
        $exec = $req4->execute();
        header("Refresh:0");
    }
    
    

}
?>

<!-- include du footer -->
<?php include_once("../includes/front/footer.php") ?>