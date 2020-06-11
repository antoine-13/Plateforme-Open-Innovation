<!-- include du header -->
<?php include_once("../includes/front/header.php") ?>

<!-- Coder ici -->

<?php
    $id = $_GET['id'];
    $_SESSION['id_projet'] = $id;
    $req1 = $db->prepare("SELECT id_projet, nom_projet, id_createur, url_img FROM projet WHERE id_projet = ?");
    $exec = $req1->execute(array($id));
    $result1 = $req1->fetchAll();

    $req2 = $db->prepare("SELECT nom_participant, prenom_participant, promo, email FROM participant WHERE id_participant = ?");
    $exec = $req2->execute(array($result1[0]['id_createur']));
    $result2 = $req2->fetchAll();

    $req3 = $db->prepare("SELECT nom_participant, prenom_participant, promo, email FROM participant as  p INNER JOIN Groupe as g ON p.id_groupe = g.id_groupe INNER JOIN projet as pr ON g.id_projet = pr.id_projet WHERE pr.id_projet = ? AND p.id_participant != pr.id_createur");
    $exec = $req3->execute(array($id));
    $result3 = $req3->fetchAll();

    $req4 = $db->prepare("SELECT texte_description, besoins, technos, etapes, competances  FROM description as  d INNER JOIN projet as p ON d.id_projet = p.id_projet WHERE d.id_projet = ?");
    $exec = $req4->execute(array($id));
    $result4 = $req4->fetchAll();

    $req5 = $db->prepare("SELECT titre_rendu, date_rendu FROM rendu WHERE id_rendu NOT IN (SELECT id_rendu FROM fichier GROUP BY id_rendu)");
    $exec = $req5->execute();
    $result5 = $req5->fetchAll();

    $req6 = $db->prepare("SELECT id_rendu, titre_rendu FROM rendu WHERE id_rendu IN (SELECT id_rendu FROM fichier GROUP BY id_rendu)");
    $exec = $req6->execute();
    $result6 = $req6->fetchAll();
?>


<div class="main-container">
    <h1><?php echo $result1[0]['nom_projet']; ?></h1>
    <div class="projet">
        <div class="collumn">
            <div class="img-projet">
                <img src="<?php echo '../' . $result1[0]['url_img']?>" alt="">
            </div>
            <div class="groupes">
                <div class="fondateur">
                    <div class="row">
                        <h3>Fondateur du projet :</h3>
                        <a href="mailto:<?php echo $result2[0]['email']?>"><span><i class="fas fa-envelope"></i></span></a>
                    </div>
                    <div>
                        <span><?php echo $result2[0]['prenom_participant'] . ' ' . $result2[0]['nom_participant'] . ' ' . $result2[0]['promo'] ?></span>
                    </div>
                </div>
                <div class="membres">
                    <div class="row">
                        <h3>Membre du groupe 1 :</h3>
                        <a href="mailto:<?php $email = ''; foreach ($result3 as $value){ 
                            $email = $email . ',' . $value['email'];} echo $email; ?>
                        "><span><i class="fas fa-envelope"></i></span></a>
                    </div>
                    <div class="nom-membres">
                        <?php foreach ($result3 as $value){ ?>
                        <div>
                            <span><?php echo $value['prenom_participant'] . ' ' . $value['nom_participant']; ?></span>
                            <span><?php echo $value['promo'] ; ?></span>
                        </div>
                        <?php };?>
                    </div>
                </div>
                <div class = "row right mail-general">
                    <a href="mailto:<?php $email = $result2[0]['email'] . ','; foreach ($result3 as $value){ 
                            $email = $email . ',' . $value['email'];} echo $email; ?>">
                        <h3>Mail general</h3>
                        <span><i class="fas fa-envelope"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="info-projet">
            <div>
                <h3>Description du projet :</h3>
                <p><?php echo $result4[0]['texte_description']?></p>
            </div>
            <div>
                <h3>A quel besoin répond-t-il ?</h3>
                <p><?php echo $result4[0]['besoins']?></p>
            </div>
            <div>
                <h3>Quels sont les outils ou les technos qui seront mis en œuvre ?</h3>
                <p><?php echo $result4[0]['technos']?></p>
            </div>
            <div>
                <h3>Quelles sont les grandes étapes du développement ?</h3>
                <p><?php echo $result4[0]['etapes']?></p>
            </div>
            <div>
                <h3>Quelles sont les compétences attendues pour ce projet ?</h3>
                <p><?php echo $result4[0]['competances']?></p>
            </div>
            <?php if ($_SESSION['type'] == "professeur") {?>
                <div class="info-dowlnoad row">
                    <a href="../utils/download.php?id_description=<?php echo $id?>">
                        <span><i class="fas fa-download"></i></span>
                        <h3>Telecharger les fichiers du projet</h3>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="rendu">
            <div class="row rendu-titre">
                <span><i class="fas fa-inbox"></i></span>
                <h3>Rendus</h3>
            </div>
            <div>
                <span>Fichiers rendus :</span>
                    <?php $test = 0; foreach($result6 as $value) {?>
                        <div class="fichier_rendu">
                            <span>Intitulé : <?php echo $value['titre_rendu'] . ' '?></span>
                            <a href="../utils/download.php?id_rendu=<?php echo $value['id_rendu']?>"><span><i class="fas fa-download"></i>  Télecharger rendu</span></a>
                        </div>
                    <?php $test = $test + 1;}
                        if($test == 0){
                            ?><div><span>Aucun</span></div>
                    <?php   }
                    ?>
            </div>
            <div>
                <span>Rendus à venir :</span>
                <?php $test = 0; foreach($result5 as $value) {?>
                        <div>
                            <span><?php echo 'Intitulé :  '. $value['titre_rendu'] ?></span>
                            <span><?php echo 'date limite : ' . $value['date_rendu'] . ' '?></span>
                        </div>
                    <?php $test = $test + 1;}
                        if($test == 0){
                            ?><div><span>Aucun</span></div>
                    <?php   }
                    ?>
            </div>
        </div>
        <div class="row form_new_rendu">
                    <h3>Nouveau rendu</h3>
                    <form method="post">
                        <div class="row">
                            <div>
                                <label for="date">Date limite</label>
                                <input type="date" name='date'>
                            </div>
                            <div>
                                
                                <input type="text" placeholder="Titre rendu" name='titre'></input>
                            </div>
                            <div>
                                
                                <input type="text" placeholder="Consignes" name='travail'></input>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="submitfx">Validez</button>
                        </div>
                    </form>

                    <?php
                    
                        if($_SERVER['REQUEST_METHOD'] = 'POST'){
                            if(!empty($_POST['date']) && !empty($_POST['titre']) && !empty($_POST['travail'])){
                                $date = $_POST['date'];
                                $titre = $_POST['titre'];
                                $consignes = $_POST['travail'];
                                
                                $req7 = $db->prepare("SELECT COUNT(id_rendu) as nbr_rendu FROM rendu WHERE titre_rendu = ?");
                                $exec = $req7->execute(array($titre));
                                $nbr_rendu = $req7->fetchAll();


                                if($nbr_rendu[0]['nbr_rendu'] == 0){
                                    $req8 = $db->prepare("INSERT INTO rendu (date_rendu, titre_rendu, consignes, id_projet) VALUES ('$date', '$titre', '$consignes', '$id')");
                                    $exec = $req8->execute();
                                    
                                }
                                else{
                                    echo "<script>alert(\"Ce rendu existe déjà\")</script>";
                                }
                                
                            }
                            
                        }
                    ?>
        </div>
        <div class="actions">
            <?php if($_SESSION['type'] = 'professeur'){?>
                <div class="row">
                    <div class="new">
                        <a class="button" onclick="new_rendu_professeur()"><span>Nouveau rendu</span><span><i class="fas fa-plus-square"></i></span></a>
                    </div>
                    <div class="supp">
                        <a href="../../delete.php?id=<?php echo $id?>" class="button" ><span>Supprimer le projet</span><span><i class="fas fa-trash"></i></span></a>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</div>


<!-- include du footer -->
<?php include_once("../includes/front/footer.php") ?>