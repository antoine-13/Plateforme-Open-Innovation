<!-- include du header -->
<?php include_once("../includes/front/header.php"); 
    $req1 = $db->prepare('SELECT id_projet, nom_projet, url_img FROM projet WHERE validation = 1');
    $exec = $req1->execute();
    $result = $req1->fetchAll();
?>

<!-- Coder ici -->
<?php
if($_SESSION["type"] == "etudiant"){
?>
<div class="main-container-aprenant">
    <h1>Projets</h1>
    <div class="wrapper">
        <?php foreach($result as $projet)  { ?>
            <div class="card">
                <div class="imgBox">
                    <img src="<?php echo '../' . $projet['url_img']?>" alt="">
                </div>
                <div class="content">
                    <span><?php echo $projet['nom_projet']?></span>
                    <p>
                        <?php 
                            $req2 = $db->prepare("SELECT texte_description as texte_description FROM description as  d INNER JOIN projet as p ON d.id_projet = p.id_projet WHERE p.id_projet = ?");
                            $exec = $req2->execute(array($projet['id_projet']));
                            $result2 = $req2->fetchAll();
                            
                            $description = wordwrap($result2[0]['texte_description'], 10);
                            echo $description;

                        
                        ?>
                    </p>
                    <form action="visu_projet.php" method="get">
                        <input type="hidden" value="<?php echo $projet['id_projet']?>" name="id">
                        <button type="submit"><span>Voir plus</span></button>
                    </form>
                </div>
            </div>
        <?php } ?>
        
        <!--<div class="tab-info-groups">
            <div class="user">
                <div class="right-button" onclick="swipe(this.id)" id="left"><span><i class="fas fa-caret-left"></i></span></div>
                <div class="content">
                    <span>Utilisateurs</span>
                </div>
            </div>

            <div class="groups">
                <div class="content">
                    <span>Groupes</span>
                </div>
                <div class="right-button" onclick="swipe(this.id)" id="right"><span><i class="fas fa-caret-right"></i></span></div>
            </div>
            
        </div>-->
    </div>
</div>
<?php 
}
else{
    header('Location: ../index.php');
}
?>

<!-- include du footer -->
<?php include_once("../includes/front/footer.php") ?>