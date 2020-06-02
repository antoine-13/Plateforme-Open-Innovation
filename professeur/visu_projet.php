<!-- include du header -->
<?php include_once("../includes/front/header.php") ?>

<!-- Coder ici -->

<?php
    /*
    $id = $_POST['id'];
    $req1 = $db->prepare('SELECT * FROM projet WHERE id = ?');
    $result = $req1->execute(array($id));
    $result = $result->fetch();
    */

?>
<div class="main-container">
    <h1> Nom du projet </h1>
    <div class="projet">
        <div class="collumn">
            <div class="img-projet"></div>
            <div class="groupes">
                <div class="fondateur">
                    <div class="row">
                        <p>Fondateur du projet :</p>
                        <a href="mailto:"><span><i class="fas fa-envelope"></i></span></a>
                    </div>
                </div>
                <div class="membres">
                    <div class="row">
                        <p>Membre du groupe 1 :</p>
                        <a href="mailto:"><span><i class="fas fa-envelope"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="info-projet">
            <div>
                <p>Description du projet :</p>
            </div>
            <div>
                <p>A quel besoin répond-t-il ?</p>
            </div>
            <div>
                <p>Quels sont les outils ou les technos qui seront mis en œuvre ?</p>
            </div>
            <div>
                <p>Quelles sont les grandes étapes du développement ?</p>
            </div>
            <div>
                <p>Quelles sont les compétences attendues pour ce projet ?</p>
            </div>
            <div class="info-dowlnoad row">
                <span><i class="fas fa-download"></i></span>
                <p>Telecharger les fichiers du projet</p>
            </div>
        </div>
        <div class="actions">
            <div class="new">
                <a href="#" class="button">Nouveau rendu <span><i class="fas fa-plus-square"></i></span></a>
            </div>
            <div class="valid">
                <a href="#" class="button" >Validez le projet <span><i class="fas fa-check"></i></span></a>
            </div>
        </div>
    </div>
</div>


<!-- include du footer -->
<?php include_once("../includes/front/footer.php") ?>