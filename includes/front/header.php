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
        <nav>
            
            <ul>
                <li><span><i class="fas fa-plus-circle"></i></span>Nouveau</li>
                <li><span><i class="fas fa-users"></i></span>S'inscrire</li>
                <li class="Open-innov-logo">
                    <img src="../../assets/img/logo open innov.png" alt=""></img>
                </li>
                <li><span><i class="fas fa-file-import"></i></span>Rendu</li>
                <li><span><i class="fas fa-info-circle"></i></span>Contact</li>
            </ul>
        </nav>
    </div>
    
</header>

<?php } ?>