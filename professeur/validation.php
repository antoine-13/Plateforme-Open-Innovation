<!-- include du header -->
<?php include_once("../includes/front/header.php") ?>

<!-- Coder ici -->
<?php if($_SESSION['type'] = 'professeur'){ ?>
<div class="main-container">
    <h1>Validation</h1>
    <div class="tab_validation">
        <div class="demande">
            <div>
                <span>Veri-Equation</span>
            </div>
            <div>
                <a href=""><span><i class="fas fa-download"></i></span></a>
                <span><i class="fas fa-check"></i></span>
                <span><i class="fas fa-times"></i></span>
            </div>
        </div>
    
    </div>
</div>

<?php }?>

<!-- include du footer -->
<?php include_once("../includes/front/footer.php") ?>