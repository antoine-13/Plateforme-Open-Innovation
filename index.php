<!-- include de l'entete -->
<?php include_once("includes/front/entete.php"); ?>

	<main class="main-index">
		<div class="connect-form-div">
			<form action="" method="POST">
				<div class=form-logo>
					<div class="logo"><img src="assets/img/logo open innov.png" alt=""></div>
				</div>
				
				<div class="div-input">
					<span>Utilisateur</span>
					<div class="input">
						<span><i class="fas fa-user"></i></span>
						<input type="text" name="username" placeholder="Nom d'utilisateur" id="username"></input>
					</div>
				</div>
				<div class="div-input">
					<span>Mot de passe</span>
					<div class="input">
						<span><i class="fas fa-key"></i></span>
						<input type="password" name="password" placeholder="Mot de passe"></input>
					</div>
					<div class="forgot-mdp">
						<a href="">Mot de passe oublié ?</a>
					</div>
				</div>
				<div class="remember">
					<input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">Se souvenir de moi</label></input>
				</div>
				<div class="valid-form">
					<button type="submit" name="submit">Connexion</button>
				</div>
			</form>
		</div>
	</main>

<?php 
if($_SERVER['REQUEST_METHOD'] = 'POST'){
	if(!empty($_POST['password']) && !empty($_POST['username'])){
		if($_POST['password'] == 'etudiant' and $_POST['username'] == 'etudiant'){ 
			$_SESSION["type"] = "etudiant";
			header('location: /aprenant/accueil.php');
			
		}
		elseif($_POST['password'] == 'professeur' and $_POST['username'] == 'professeur'){
			$_SESSION["type"] = "professeur";
			header('location: /professeur/accueil.php');
		}
	}

}
?>

<!-- include de la fin du fichier -->
<?php include_once("includes/front/fin.php"); ?>

