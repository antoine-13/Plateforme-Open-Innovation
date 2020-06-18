<!-- include du header -->
<?php include_once("../includes/front/header.php"); 
?>

<!-- Importation css -->
<link rel="stylesheet" type="text/css" href="../assets/css/style2.css">

<!-- Code de la page -->

<?php
if($_SESSION["type"] == "etudiant"){
?>
    <div class="main-container-etudiant">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="gotop" onclick="gotop()"><span><i class="fas fa-arrow-up"></i></span></div>
            <br>
            <div class="titre">
                <h1>Proposition de projet</h1>
            </div>

            <div class="text_style">
                <div class="div_formu text_taille">
                    <label for="nom_projet">Nom donné au projet:</label>
                    <input type="text" id="nom_projet" name="nom_projet">
                </div>

                <h2>Initiateur du projet</h2>

                <div>
                    <label for="nom_participant">Nom :</label>
                    <input type="text" id="nom_participant" name="nom_participant">
                </div>

                <div>
                    <label for="prenom_participant">Prénom :</label>
                    <input type="text" id="prenom_participant" name="prenom_participant">
                </div>

                <div>
                    <label for="promo">Promo :</label>
                    <select id="promo" name="promo">
                        <option value="choisir"></option>
                        <option value="B1">B1</option>
                        <option value="B2">B2</option>
                        <option value="B3">B3</option>
                        <option value="I1">I1</option>
                        <option value="I2">I2</option>
                    </select>
                </div>

                <div>
                    <label for="email">adresse mail EPSI ou WIS :</label>
                    <input type="text" id="email" name="email">
                </div>

                <h2>Votre Projet</h2>

                <div>
                    <label for="text_description">décrivez votre projet :</label>
                    <br>
                    <textarea rows="5" cols="50" id="text_description" name="text_description"></textarea>
                </div>

                <div>
                    <label for="besoins">A quel besoin répondez-vous ?</label>
                    <br>
                    <textarea rows="5" cols="50" id="besoins" name="besoins"></textarea>
                </div>

                <div>
                    <label for="technos">Quels sont les outils ou les technos qui seront mis en oeuvre dans ce projet?</label>
                    <br>
                    <textarea rows="5" cols="50" id="technos" name="technos"></textarea>
                </div>

                <div>
                    <label for="etapes">Quelles sont les grandes étapes du développement de votre projet?</label>
                    <br>
                    <textarea rows="5" cols="50" id="etapes" name="etapes"></textarea>
                </div>

                <div>
                    <label for="competences">Quelles sont les compétences attendues pour ce projet (profil des membres de votre équipe, maxi 8 personne par projet) ?</label>
                    <br>
                    <textarea rows="5" cols="50" id="competences" name="competences"></textarea>
                </div>

                <h2>Etat d'avancement</h2>

                <div>
                    <label for="realisation">Qu'avez-vous réalisé jusqu'à présent (si le projet est déjà commencé) ?</label>
                    <br>
                    <textarea rows="5" cols="50" id="realisation" name="realisation"></textarea>
                </div>

                <div>
                    <br>
                    <h1 class="centrer">Explication ou maquette du projet (facultatif)<h1>

                    <div class="drop-zone2">
                        <input type="file" name="docs" id="file" is="drop-files"/>
                    </div>
                </div>

                <div>
                    <br>
                    <h1 class="centrer">Image du projet (facultatif)<h1>

                    <div class="drop-zone2">
                        <input type="file" name="image" id="file" is="drop-files"/>
                    </div>
                </div>

                <div class="button-submit">
                    <p class="centrer">Envoyer la demande de création de votre projet</p>
                    <button type="submit" class="submitfx centrer">Envoyer</button>
                </div>
            </div>
            <?php
                if($_SERVER['REQUEST_METHOD'] = 'POST'){
                    if(isset($_POST['nom_projet']) && isset($_POST['text_description']) && isset($_POST['besoins']) && isset($_POST['technos']) && isset($_POST['etapes']) && isset($_POST['competences']) && isset($_POST['nom_participant']) && isset($_POST['prenom_participant']) && isset($_POST['promo']) && isset($_POST['email'])){
                        $nom_projet = test_input($_POST['nom_projet']);
                        $text_description = test_input($_POST['text_description']);
                        $besoins = test_input($_POST['besoins']);
                        $technos = test_input($_POST['technos']);
                        $etapes = test_input($_POST['etapes']);
                        $competences = test_input($_POST['competences']);
                        $nom_participant = test_input($_POST['nom_participant']);
                        $prenom_participant = test_input($_POST['prenom_participant']);
                        $promo = test_input($_POST['promo']);
                        $email = test_input($_POST['email']);
                        //On insère les données reçues
                        $req1 = $db->prepare("INSERT INTO projet(validation, nom_projet) VALUES(0, '$nom_projet')");
                        $exec = $req1->execute();

                        $req2 = $db->prepare("SELECT LAST_INSERT_ID() as id_projet FROM Projet");
                        $exec = $req2->execute();
                        $result2 = $req2->fetchAll();

                        $id_projet = $result2[0]['id_projet'];

                        $req3 = $db->prepare("INSERT INTO description(texte_description, besoins, technos, etapes, competences, id_projet) VALUES('$text_description', '$besoins', '$technos', '$etapes', '$competences', '$id_projet');");
                        $exec = $req3->execute();

                        $req4 = $db->prepare("INSERT INTO Groupe(numero_groupe, id_projet) VALUE(1, '$id_projet')");
                        $exec = $req4->execute();

                        $req6 = $db->prepare("SELECT LAST_INSERT_ID() as id_groupe FROM Groupe");
                        $exec = $req6->execute();
                        $result6 = $req6->fetchAll();

                        $id_groupe = $result6[0]['id_groupe'];

                        $req5 = $db->prepare("INSERT INTO participant(nom_participant, prenom_participant, promo, email, id_groupe) VALUES('$nom_participant', '$prenom_participant', '$promo', '$email', '$id_groupe');");
                        $exec = $req5->execute();

                        $req7 = $db->prepare("SELECT LAST_INSERT_ID() as id_createur FROM Participant");
                        $exec = $req7->execute();
                        $result7 = $req7->fetchAll();

                        $id_createur = $result7[0]['id_createur'];

                        $req8 = $db->prepare("UPDATE Projet SET id_createur = '$id_createur' WHERE id_projet = '$id_projet' ");
                        $exec = $req8->execute();

                        if(!file_exists("../files/" . $nom_projet)){
                            $path_proj = "../files/" . $nom_projet;
                            $path_rendu = $path_proj . "/rendu";
                            mkdir($path_proj);
                            mkdir($path_rendu);
                        }
                        
                        if($_FILES["docs"]["error"] == 0){
                            $tmp_name = $_FILES["docs"]["tmp_name"];
                            $newName = "description";

                            // On crée un tableau avec les extensions autorisées
                            $legalExtensions = array("docx", "pdf");

                            // On récupère l'extension du fichier soumis et on vérifie qu'elle soit dans notre tableau
                            $extension = strtolower(pathinfo($_FILES['docs']['name'], PATHINFO_EXTENSION));

                            $destination = "files/" . $nom_projet . "/" . $newName . "." . $extension;

                            if (in_array($extension, $legalExtensions)) {
                                if (file_exists($destination)) {
                                    echo "<script>alert(\"Erreur lors de l'upload !\")</script>";
                                }
                                else{
                                    move_uploaded_file($tmp_name, "../". $destination);
                                    $req9 = $db->prepare("UPDATE Description SET fichier_description = '$destination' WHERE id_projet = '$id_projet' ");
                                    $exec = $req9->execute();
                                }
                            }
                            else{
                                echo "<script>alert(\"Merci de choisir des fichiers valides (docx, pdf) !\")</script>";
                                
                            } 
                        }

                        if($_FILES["image"]["error"] == 0){
                            
                            $tmp_name = $_FILES["image"]["tmp_name"];
                            $newName = "pdp";

                            // On crée un tableau avec les extensions autorisées
                            $legalExtensions = array("png", "jpeg", "gif", 'jpg');

                            // On récupère l'extension du fichier soumis et on vérifie qu'elle soit dans notre tableau
                            $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

                            $destination = "files/" . $nom_projet . "/" . $newName . "." . $extension;

                            if (in_array($extension, $legalExtensions)) {
                                if (file_exists($destination)) {
                                    echo "<script>alert(\"Erreur lors de l'upload !\")</script>";
                                }
                                else{
                                    move_uploaded_file($tmp_name, "../". $destination);

                                    $req10 = $db->prepare("UPDATE Projet SET url_img = '$destination' WHERE id_projet = '$id_projet';");
                                    $exec = $req10->execute();   
                                }
                            }
                            else{
                                echo "<script>alert(\"Merci de choisir des fichiers valides (docx, pdf) !\")</script>";  
                            } 
                        }
                        echo "<script>alert(\"Suceed !\")</script>";
                    }

                }      
            ?>
        </form>
    </div>
<?php } ?>



<!-- include du footer -->
<?php include_once("../includes/front/footer.php");?>