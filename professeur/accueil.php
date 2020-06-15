<!-- include du header -->
<?php include_once("../includes/front/header.php") ?>

<!-- Coder ici -->
<?php
if($_SESSION["type"] == "professeur"){


    $req5 = $db->prepare("SELECT COUNT(id_participant) AS nbr_utilisateur FROM participant WHERE promo = ?");
    $exec = $req5->execute(array('B1'));
    $result5 = $req5->fetchAll();

    $req6 = $db->prepare("SELECT COUNT(id_participant) AS nbr_utilisateur FROM participant WHERE promo = ?");
    $exec = $req6->execute(array('B2'));
    $result6 = $req6->fetchAll();

    $req7 = $db->prepare("SELECT COUNT(id_participant) AS nbr_utilisateur FROM participant WHERE promo = ?");
    $exec = $req7->execute(array('B3'));
    $result7 = $req7->fetchAll();

    $req8 = $db->prepare("SELECT COUNT(id_participant) AS nbr_utilisateur FROM participant WHERE promo = ?");
    $exec = $req8->execute(array('I1'));
    $result8 = $req8->fetchAll();

    $req9 = $db->prepare("SELECT COUNT(id_participant) AS nbr_utilisateur FROM participant WHERE promo = ?");
    $exec = $req9->execute(array('I2'));
    $result9 = $req9->fetchAll();

    $req10 = $db->prepare("SELECT nom_projet, id_projet FROM Projet");
    $exec = $req10->execute();
    $result10 = $req10->fetchAll();
    
?>
    <div class="main-container">
        <h1>Dashboard</h1>
        <div class="stats">
            <div class="stat-1">
                <div class="stat-text">
                    <span>projets</span>
                    <span><?php
                        $req1 = $db->prepare('SELECT COUNT(id_projet) as nbr_projets FROM projet');
                        $nbr_projets = $req1->execute();
                        $nbr_projets = $req1->fetchAll();
                        echo $nbr_projets[0]['nbr_projets'];
                        
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
                        $req2 = $db->prepare('SELECT COUNT(id_participant) as nbr_participants FROM participant');
                        $nbr_participants = $req2->execute();
                        $nbr_participants = $req2->fetchAll();
                        echo $nbr_participants[0]['nbr_participants'];
                        
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
                        $req3 = $db->prepare('SELECT COUNT(id_groupe) as nbr_groupes FROM groupe');
                        $nbr_groupes = $req3->execute();
                        $nbr_groupes = $req3->fetchAll();
                        echo $nbr_groupes[0]['nbr_groupes'];
                        
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
                        $req4 = $db->prepare('SELECT COUNT(id_projet) as nbr_valid FROM projet WHERE validation = 0');
                        $exec = $req4->execute();
                        $nbr_valid = $req4->fetchAll();
                        echo $nbr_valid[0]['nbr_valid'];
                        
                    ?></span>
                </div>
                <div class="stat-logo">
                    <span><i class="fas fa-arrows-alt-h"></i></span>
                </div>
            </div>
        </div>
        <div class="graph">
            <div class="graph-1">
                <div class="titre-graphe">
                    <span>INSCRIPTION</span>
                </div>
                <div class="graphique">
                    <canvas id="bar-chart"></canvas>
                    <script>
                        new Chart(document.getElementById("bar-chart"), {
                        type: 'bar',
                        data: {
                        labels: ["B1", "B2", "B3", "I1", "I2"],
                        datasets: [
                            {
                            label: "Incrits",
                            backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                            data: [<?php echo $result5[0]['nbr_utilisateur'] . ', ' . $result6[0]['nbr_utilisateur'] . ', ' . $result7[0]['nbr_utilisateur'] . ', ' . $result8[0]['nbr_utilisateur'] . ', ' . $result9[0]['nbr_utilisateur'];?>]
                            }
                        ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            },
                            legend: { display: false },
                            title: {
                                display: true,
                                text: 'Nombre d\'étudiant inscrit par promo'
                            }
                        }
                    });
                    </script>
                </div>
            </div>
            <div class="graph-2">
                <div class="titre-graphe">
                    <span>PROJETS</span>
                </div>
                <div class="graphique">
                    <canvas id="myChart_2"></canvas>
                    <script>
                        var ctx_2 = document.getElementById('myChart_2').getContext('2d');
                        var myDoughnutChart = new Chart(ctx_2, {
                        type: 'doughnut',
                        data: {
                            labels: [
                                <?php 
                                    foreach($result10 as $value){
                                        echo "\"". $value['nom_projet'] . "\"";
                                    
                                ?>
                            ],
                            datasets: [{
                            label: 'Nombre',
                            data: [
                                <?php 
                                    $req11 = $db->prepare('SELECT COUNT(id_participant) AS nbr FROM participant AS p INNER JOIN groupe AS g ON p.id_groupe=g.id_groupe INNER JOIN projet AS pr ON pr.id_projet=g.id_projet WHERE pr.id_projet = ?');
                                    $exec = $req11->execute(array($value['id_projet']));
                                    $result11 = $req11->fetchAll();
                                    echo $result11[0]['nbr'];

                                }
                                ?>
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgb(178, 181, 243)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgb(178, 181, 243)'
                            ],
                            borderWidth: 1
                            }]
                        },
                        options: {
                            //cutoutPercentage: 40,
                            responsive: true,
                            title: {
                                display: true,
                                text: 'Nombre d\'étudiant inscrit par projets'
                            }
                        }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</main>
<?php 
}
else{
    header('Location: ../index.php');
}
?>

<!-- include du footer -->
<?php include_once("../includes/front/footer.php") ?>