<!-- include du header -->
<?php include_once("../includes/front/header.php") ?>

<!-- Coder ici -->

<?php
    
    $id = $_GET['id'];
    $req1 = $db->prepare("SELECT id_projet, nom_projet, id_createur, url_img FROM projet WHERE id_projet = ?");
    $exec = $req1->execute(array($id));
    $result1 = $req1->fetchAll();

    $req2 = $db->prepare("SELECT nom_participant, prenom_participant, promo, email FROM participant WHERE id_participant = ?");
    $exec = $req2->execute(array($result1[0]['id_createur']));
    $result2 = $req2->fetchAll();

    $req3 = $db->prepare("SELECT nom_participant, prenom_participant, promo, email FROM participant as  p INNER JOIN Groupe as g ON p.id_groupe = g.id_groupe INNER JOIN projet as pr ON g.id_projet = pr.id_projet WHERE pr.id_projet = ? AND p.id_participant != pr.id_createur");
    $exec = $req3->execute(array($id));
    $result3 = $req3->fetchAll();

    $req4 = $db->prepare("SELECT texte_description, besoins, technos, etapes, competances  FROM description as  d INNER JOIN projet as p ON d.id_projet = p.id_projet WHERE p.id_projet = ?");
    $exec = $req4->execute(array($id));
    $result4 = $req4->fetchAll();
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
                    <h3>Mail general</h3>
                    <a href="mailto:"><span><i class="fas fa-envelope"></i></span></a>
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
            <div class="info-dowlnoad row">
                <a href="../download.php?id=<?php echo $id?>">
                    <span><i class="fas fa-download"></i></span>
                    <h3>Telecharger les fichiers du projet</h3>
                </a>
            </div>
        </div>
        <div class="rendu">
            <h3>Rendus</h3>
                    
        </div>
        <div class="actions">
            <div class="new">
                <a href="#" class="button">Nouveau rendu <span><i class="fas fa-plus-square"></i></span></a>
            </div>
            <div class="supp">
                <a href="#" class="button" >Supprimer le projet<span><i class="fas fa-trash"></i></span></a>
            </div>
        </div>
    </div>
</div>


<!-- include du footer -->
<?php include_once("../includes/front/footer.php") ?>