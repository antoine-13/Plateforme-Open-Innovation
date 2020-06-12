<?php include "entete.php"; 
if($_SESSION["type"] == "etudiant"){
?>

<header>
    <div class="container-nav">
        <nav class="nav-etudiant">
            <div class="marker"></div>
            <a href="../../aprenant/accueil.php"><span><i class="fas fa-home"></i></span><span>Accueil</span></a>
            <a href="../../aprenant/projets.php"><span><i class="fas fa-users"></i></span><span>Projets</span></a>
            <a href="#"><span><i class="fas fa-info-circle"></i></span><span>Contact</span></a>

        </nav>
    </div>
</header>
<?php } ?>


<?php 
if($_SESSION["type"] == "professeur"){
?>
<main class="main-professeur">
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="../../assets/img/logo open innov.png" alt="">
        </div>
        <ul>
            <li><a href="../../professeur/accueil.php"><span><i class="fas fa-home"></i></span>Home</a></li>
            <li><a href="../../professeur/projets.php"><span><i class="fas fa-users"></i></span>Projets</a></li>
            <li><a href=""><span><i class="fas fa-clipboard-check"></i></span>Validation</a></li>
        </ul>
        <span>Copyright &copy; FOUVRY</span>

        
    </div>
<?php } ?>