<!-- include du header -->
<?php include_once("../includes/front/header.php") ?>

<!-- Coder ici -->

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $req9 = $db->prepare("SELECT id_projet FROM Projet");
    $exec = $req9->execute();
    $result9 = $req9->fetchAll();
    
    if(in_array($id, $result9[0])){
    
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

    $req5 = $db->prepare("SELECT id_rendu, titre_rendu, date_rendu FROM rendu WHERE id_rendu NOT IN (SELECT id_rendu FROM fichier GROUP BY id_rendu)");
    $exec = $req5->execute();
    $result5 = $req5->fetchAll();

    $req6 = $db->prepare("SELECT id_rendu, titre_rendu FROM rendu WHERE id_rendu IN (SELECT id_rendu FROM fichier GROUP BY id_rendu)");
    $exec = $req6->execute();
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
                    <?php $test = 0; foreach($result6 as $value) {?>
                        <div>
                            <span><?php echo $value['titre_rendu'] . ' '?> </span>
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
        <div class="form_new_rendu_etudiant">
                    <h3>Nouveau rendu</h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        
                        <div class="choix">
                            <label for="choix">Choisir rendu :</label>
                            <select name="choix" id="">
                            <?php 
                                foreach($result5 as $result){ ?>
                                <option value="<?php echo $result['id_rendu']?>"><?php echo $result['titre_rendu']?></option>
                                <?php }
                            
                            ?>
                            </select>
                        </div>
                        <div class="drop-zone">
                            <input type="file" name="pictures[]" multiple="" id="file" is="drop-files" accept="image/png, .jpeg, .jpg, image/gif, .zip"/>
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
                                $commentaire = test_input($_POST['commentaire']);
                                
                                $req11 = $db->prepare("SELECT nom_projet FROM Projet  as p INNER JOIN Rendu as r ON  p.id_projet=r.id_projet WHERE r.id_rendu = ?");
                                $exec = $req11->execute(array($id_rendu));
                                $result11 = $req11->fetchAll();

                                foreach ($_FILES["pictures"]["error"] as $key => $error) {
                                    if ($error == UPLOAD_ERR_OK) {
                                        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
                                        $newName = bin2hex(random_bytes(10));

                                        // On crée un tableau avec les extensions autorisées
                                        $legalExtensions = array("jpg", "png", "zip", "txt", "gif");

                                        // On récupère l'extension du fichier soumis et on vérifie qu'elle soit dans notre tableau
                                        $extension = strtolower(pathinfo($_FILES['pictures']['name'][$key], PATHINFO_EXTENSION));

                                        $destination = "files/" . $result11[0]['nom_projet'] . "\/rendu/" . $newName . "." . $extension;

                                        if (in_array($extension, $legalExtensions)) {
                                            if (file_exists($destination)) {
                                                echo "<script>alert(\"Erreur lors de l'upload !\")</script>";
                                            }
                                            else{
                                                move_uploaded_file($tmp_name, "../". $destination);

                                                $req12 = $db->prepare("INSERT INTO Fichier (destination, date_rendu, commentaire, id_rendu) VALUES ('$destination', '$date', '$commentaire', '$id_rendu');");
                                                $exec = $req12->execute();
                                                
                                                echo "<script>alert(\"Suceed !\")</script>";
                                            }
                                        }
                                        else{
                                            echo "<script>alert(\"Merci de choisir des fichiers valides (jpg, png, zip, txt) !\")</script>";
                                        }
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
                                <label for="email">Email :</label>
                                <input type="email" placeholder="Votre email" name='email'></input>
                            </div>
                            <div>
                                <label for="promo">Promo :</label>
                                <select name="promo" id="">
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="I1">I1</option>
                                    <option value="I2">I2</option>
                                </select>
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
                                
                                $nom = test_input(strtolower($_POST['nom']));
                                $prenom = test_input(strtolower($_POST['prenom']));
                                $promo = test_input($_POST['promo']);
                                $email = test_input($_POST['email']);
                                
                                $req7 = $db->prepare("SELECT id_participant, id_groupe, id_groupe_1, COUNT(id_participant) as nbr FROM participant WHERE email = ?");
                                $exec = $req7->execute(array($email));
                                $nbr = $req7->fetchAll();

                                if($nbr[0]['nbr'] == 0){
                                    $req10 = $db->prepare("SELECT id_groupe FROM groupe WHERE id_projet = ?");
                                    $exec = $req10->execute(array($id));
                                    $result10 = $req10->fetchAll();
                                    $id_groupe = $result10[0]['id_groupe'];
                                    $req8 = $db->prepare("INSERT INTO participant (nom_participant, prenom_participant, promo, email, id_groupe) VALUES ('$nom', '$prenom', '$promo', '$email', '$id_groupe')");
                                    $exec = $req8->execute();

                                    $req15 = $db->prepare("SELECT nom_projet FROM Projet WHERE id_projet = ?");
                                    $exec = $req15->execute(array($id));
                                    $result15 = $req15->fetchAll();

                                    ini_set( 'display_errors', 1 );
                                    error_reporting( E_ALL );
                                    

                                    // Le message
                                    $message = "Bienvenue " . $prenom . ",\nVous etes maintenant inscrit sur le projet " . $result15[0]['nom_projet'];
                                    $subject = "Bienvenue " . $prenom . " !";
                                    // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
                                    $message = wordwrap($message, 70);
                                    
                                    mail($email,$subject,$message);

                                    echo "<script>alert(\"Inscription réussit !\")</script>";  
                                }
                                else if($nbr[0]['id_groupe_1'] == NULL){
                                    $req14 = $db->prepare("SELECT id_groupe FROM groupe WHERE id_projet = ?");
                                    $exec = $req14->execute(array($id));
                                    $result14 = $req14->fetchAll();
                                    $id_groupe = $result14[0]['id_groupe'];

                                    if($nbr[0]['id_groupe'] != $id_groupe){
                                        $req13 = $db->prepare("UPDATE participant SET id_groupe_1 = ? WHERE id_participant = ?");
                                        $exec = $req13->execute(array($id_groupe, $nbr[0]['id_participant']));

                                        $req15 = $db->prepare("SELECT nom_projet FROM Projet WHERE id_projet = ?");
                                        $exec = $req15->execute(array($id));
                                        $result15 = $req15->fetchAll();
                                         // Le message
                                        $message = "Bonjour " . $prenom . ",\nVotre demande de changement de projet vers le projet " . $result15[0]['nom_projet'] . " à bien été prise en compte !\n Elle doit maintenant etre accepter.";
                                        $subject = "Demande de changement de projet";
                                        // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
                                        $message = wordwrap($message, 70);
                                        
                                        mail($email,$subject,$message);
                                        echo "<script>alert(\"Demande de changement de groupe prise en compte !\")</script>";  
                                    }
                                    else{
                                        echo "<script>alert(\"Sa sert à rien de se re-inscrire au projet PIGEON !\")</script>";
                                    }
                                }
                                else{
                                    echo "<script>alert(\"Une demande de changement de projet est déjà en cours !\")</script>";
                                }
                                
                            }
                            
                        }
                    ?>
        </div>
        <div class="actions">
            <?php if($_SESSION['type'] = 'etudiant') { ?>
                 <div class="row">
                    <div class="new">
                        <a class="button" onclick="new_rendu_etudiant()"><span>Nouveau rendu</span><span><i class="fas fa-plus-square"></i></span></a>
                    </div>
                    <div class="incription">
                        <a class="button" onclick="inscription()"><span>S'inscrire au projet</span><span><i class="fas fa-plus-circle"></i></span></a>
                    </div>
                </div>
            <?php }?>
            
        </div>
    </div>
</div>
<?php
    }
    else{
        header('Location: projets.php');
    }
}
else{
    header('Location: projets.php');
}
?>

<!-- include du footer -->
<?php include_once("../includes/front/footer.php") ?>