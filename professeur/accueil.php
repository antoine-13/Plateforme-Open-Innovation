<!-- include du header -->
<?php include_once("../includes/front/header.php") ?>

<!-- Coder ici -->
    <div class="main-container">
        <h1>Dashboard</h1>
        <div class="stats">
            <div class="stat-1">
                <div class="stat-text">
                    <span>projets</span>
                    <span><?php
                        $req1 = $db->prepare('SELECT COUNT(*) FROM projet');
                        $nbr_projets = $req1->execute();
                        echo $nbr_projets;
                        
                    ?></span>
                </div>
                <div class="stat-logo">
                    <span><i class="fas fa-file-alt"></i></span>
                </div>
            </div>
            <div class="stat-2">
                <div class="stat-text">
                    <span>participants</span>
                    <span><?php
                        $req2 = $db->prepare('SELECT COUNT(*) FROM participant');
                        $nbr_participants = $req2->execute();
                        echo $nbr_participants;
                        
                    ?></span>
                </div>
                <div class="stat-logo">
                    <span><i class="fas fa-user-check"></i></span>
                </div>
            </div>
            <div class="stat-4">
                <div class="stat-text">
                    <span>groupes</span>
                    <span><?php 
                        $req3 = $db->prepare('SELECT COUNT(*) FROM groupe');
                        $nbr_groupes = $req3->execute();
                        echo $nbr_groupes;
                        
                    ?></span>
                </div>
                <div class="stat-logo">
                    <span><i class="fas fa-users"></i></span>
                </div>
            </div>
            <div class="stat-3">
                <div class="stat-text">
                    <span>demandes de validation</span>
                    <span><?php 
                        $req4 = $db->prepare('SELECT COUNT(*) FROM projet WHERE validation = 0');
                        $nbr_valid = $req4->execute();
                        echo $nbr_valid;
                        
                    ?></span>
                </div>
                <div class="stat-logo">
                    <span><i class="fas fa-arrows-alt-h"></i></span>
                </div>
            </div>
        </div>
        <div class="graph">
            <div class="graph-1">
                <div class="titre-graphe"></div>
                <div class="graphique"></div>
            </div>
            <div class="graph-2">
                <div class="titre-graphe"></div>
                <div class="graphique"></div>
            </div>
        </div>
    </div>
</main>


<!-- include du footer -->
<?php include_once("../includes/front/footer.php") ?>