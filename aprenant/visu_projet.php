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

    $req5 = $db->prepare("SELECT date_fichier_rendu, fichier_rendu FROM rendu as  r INNER JOIN projet as p ON r.id_projet = p.id_projet WHERE r.id_projet = ? AND fichier_rendu IS NOT NULL");
    $exec = $req5->execute(array($id));
    $result5 = $req5->fetchAll();

    $req6 = $db->prepare("SELECT date_rendu, titre_rendu FROM rendu as  r INNER JOIN projet as p ON r.id_projet = p.id_projet WHERE r.id_projet = ? AND fichier_rendu IS NULL AND date_fichier_rendu IS NULL");
    $exec = $req6->execute(array($id));
    $result6 = $req6->fetchAll();
?>


<div class="main-container-aprenant">
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
        </div>
        <div class="rendu">
            <div class="row rendu-titre">
                <span><i class="fas fa-inbox"></i></span>
                <h3>Rendus</h3>
            </div>
            <div>
                <span>Fichiers rendus :</span>
                    <?php $test = 0; foreach($result5 as $value) {?>
                        <div>
                            <span><?php echo $value['date_fichier_rendu'] . ' '?> </span>
                        </div>
                    <?php $test = $test + 1;}
                        if($test == 0){
                            ?><div><span>Aucun</span></div>
                    <?php   }
                    ?>
            </div>
            <div>
                <span>Rendus à venir :</span>
                <?php $test = 0; foreach($result6 as $value) {?>
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
        <div class="form_new_rendu_etudiant">
                    <h3>Nouveau rendu</h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        
                        <div class="choix">
                            <label for="choix">Choisir rendu :</label>
                            <select name="choix" id="">
                            <?php $req9 = $db->prepare("SELECT id_rendu, titre_rendu FROM rendu WHERE fichier_rendu IS NULL");
                                $exec = $req9->execute();
                                $result9 = $req9->fetchAll();

                                foreach($result9 as $result){ ?>
                                <option value="<?php echo $result['id_rendu']?>"><?php echo $result['titre_rendu']?></option>
                                <?php }
                            
                            ?>
                            </select>
                        </div>
                        <div class="drop-zone">
                            <input type="file" name="pictures[]" multiple="" id="file" is="drop-files"/>
                        </div>
                        <div class ="choix">
                            <input type="text" placeholder="Commentaires" name='commentaire'></input>
                        </div>
                        <div class="row">
                            <button type="submit" class="submitfx">Validez</button>
                        </div>
                    </form>

                    <?php
                        
                        if($_SERVER['REQUEST_METHOD'] = 'POST'){
                            if(isset($_FILES['pictures'])){
                                $id_rendu = $_POST['choix'];
                                $date = date("Y-m-d");
                                
                                $req11 = $db->prepare("SELECT nom_projet FROM Projet  as p INNER JOIN Rendu as r ON  p.id_projet=r.id_projet WHERE r.id_rendu = ?");
                                $exec = $req11->execute();
                                $result11 = $req11->fetchAll();

                                foreach ($_FILES["pictures"]["error"] as $key => $error) {
                                    if ($error == UPLOAD_ERR_OK) {
                                        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
                    
                                        // basename() peut empêcher les attaques "filesystem traversal";
                                        // une autre validation/néttoyage du nom de fichier peux être appropriée
                                        $name = basename($_FILES["pictures"]["name"][$key]);
                                        $destination = "files/" . $result11[0]['nom_projet'] . "\/rendu/" . $name;
                                        move_uploaded_file($tmp_name, "../". $destination);

                                        $req12 = $db->prepare("INSERT INTO Fichier (destination, date_rendu, id_rendu) VALUES ?, ?, ?");
                                        $exec = $req12->execute(array($destination, $date ,$id_rendu));
                                        
                                        echo "<script>alert(\"Suceed !\")</script>";
                                    }
                                }
                            }

                        }
                    ?>
        </div>
        <div class="form-inscription">
                    <h3>S'inscrire</h3>
                    <form method="post">
                        <div class="row">
                            <div>
                                <label for="nom">Nom :</label>
                                <input type="text" name='nom' placeholder='Votre nom'>
                            </div>
                            <div>
                                <label for="prenom">Prenom :</label>
                                <input type="text" placeholder="Votre prenom" name='prenom'></input>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label for="promo">Promo :</label>
                                <select name="promo" id="">
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="M1">M1</option>
                                    <option value="M2">M2</option>
                                </select>
                            </div>
                            <div>
                                <label for="email">Email :</label>
                                <input type="email" placeholder="Votre email" name='email'></input>
                            </div>
                        </div>
                        
                        <div class="row">
                            <button type="submit" class="submitfx">Validez
                            </button>
                        </div>
                    </form>

                    <?php
                    
                        if($_SERVER['REQUEST_METHOD'] = 'POST'){
                            if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['promo']) && !empty($_POST['email'])){
                                
                                $nom = $_POST['nom'];
                                $prenom = $_POST['prenom'];
                                $promo = $_POST['promo'];
                                $email = $_POST['email'];
                                
                                $req7 = $db->prepare("SELECT COUNT(id_participant) as nbr FROM participant WHERE email = ?");
                                $exec = $req7->execute(array($email));
                                $nbr = $req7->fetchAll();

                                if($nbr_rendu[0]['nbr'] == 0){
                                    $req10 = $db->prepare("SELECT id_groupe FROM groupe WHERE id_projet = ?");
                                    $exec = $req10->execute(array($id));
                                    $result10 = $req10->fetchAll();
                                    $id_groupe = $result10[0]['id_groupe'];
                                    $req8 = $db->prepare("INSERT INTO participant (nom_participant, prenom_participant, promo, email, id_groupe) VALUES ('$nom', '$prenom', '$promo', '$email', '$id_groupe')");
                                    $exec = $req8->execute();
                                    echo "<script>alert(\"Inscription réussit !\")</script>";
                                   
                                    
                                }
                                else{
                                    echo "<script>alert(\"Vous etes déjà inscrit !\")</script>";
                                }
                                
                            }
                            
                        }
                    ?>
        </div>
        <div class="actions">
            <?php if($_SESSION['type'] = 'etudiant') { ?>
                 <div class="row">
                    <div class="new">
                        <a class="button" onclick="new_rendu_etudiant()">Nouveau rendu <span><i class="fas fa-plus-square"></i></span></a>
                    </div>
                    <div class="incription">
                        <a class="button" onclick="inscription()">S'inscrire au projet<span><i class="fas fa-plus-circle"></i></span></a>
                    </div>
                </div>
            <?php }?>
            
        </div>
    </div>
</div>


<!-- include du footer -->
<?php include_once("../includes/front/footer.php") ?>