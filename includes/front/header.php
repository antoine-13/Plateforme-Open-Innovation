<?php include "entete.php"; 
if($_SESSION["type"] == "etudiant"){
?>

<header>
    <div class="container-nav">
        <div class="logo-nav">
            <span>
                <i class="fas fa-align-left"></i>
            </span>
        </div>
        <nav class="nav-etudiant">
            <ul>
                <li class="li-etudiant"><span><i class="fas fa-plus-circle"></i></span>Nouveau</li>
                <li class="li-etudiant"><span><i class="fas fa-users"></i></span>S'inscrire</li>
                <li class="Open-innov-logo">
                    <img src="../../assets/img/logo open innov.png" alt=""></img>
                </li>
                <li class="li-etudiant"><span><i class="fas fa-file-import"></i></span>Rendu</li>
                <li class="li-etudiant"><span><i class="fas fa-info-circle"></i></span>Contact</li>
            </ul>
        </nav>
    </div>
    
</header>

<?php } ?>

<?php 
if($_SESSION["type"] == "professeur"){
?>
<main class="main-accueil-professeur">
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="../../assets/img/logo open innov.png" alt="">
        </div>
        <ul>
            <li><a href=""><span><i class="fas fa-home"></i></span>Home</a></li>
            <li><a href=""><span><i class="fas fa-users"></i></span>Groupes</a></li>
            <li><a href=""><span><i class="fas fa-clipboard-check"></i></span>Validation</a></li>
        </ul>

        
    </div>
<?php } ?>