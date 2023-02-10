<?php  
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=form', 'root' ,'root');

if (isset($_POST['connexion'])){	
	$pseudo_connect= htmlspecialchars($_POST['pseudoconnect']);
	$mdp_connect= md5($_POST['mdpconnect']);
	if(!empty($pseudo_connect) and !empty($mdp_connect)){
		$requser = $bdd->prepare("SELECT * FROM membre WHERE pseudo=? and motdepasse=?");	
		$requser->execute(array($pseudo_connect, $mdp_connect));	
		$userexist = $requser->rowCount();
		if($userexist==1){
			$userinfo=$requser->fetch();
			
			$_SESSION['pseudo']=$userinfo['pseudo'];
			$_SESSION['email']=$userinfo['email'];
			

		}	

		else{
			$erreur="mauvais pseudo ou mot de passe";
		}
	}
 	else{
 		$erreur="tous les champs doivent etre complétés";

 	}
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>ACCUEIL</title>
    <link rel="stylesheet" type="text/css" href="test1.css">
    	
    </style>	
</head>
<meta name=<meta charset="utf-8"> 
<body>

	<header>
		<H1>JOB DONE</H1>

		<nav>
		
			
				
			<div class="container">
				<ul>
					
							
						<?php  if(isset($_SESSION['pseudo'])){?>
					
					
					<li><a href="deconnexion.php">DECONNEXION</a></li><?php } 
					
					else { ?>
						<?php } ?>
						<li><a href="acceuil.php">CONNEXION</a></li>	
					
					
					<li><a href="inscription.php">INSCRIPTION</a></li>
				</ul>
			</div>
		</nav>
	</header>


<div class='main'style="width: 500px;">
	
	<div class="acceuild">
	 	
	 	
									 
		<?php  if(isset($_SESSION['pseudo'])){
			$erreur="Vous etes bien connécté";

		}
	else{ ?>
		<h3 class="titreconnexion">Connectez-vous et partagez votre offre</h3>
		<table class="connexion">
			<form action="" method="POST" accept-charset="utf-8">
				
			
				<tr>
					<td class="label"><label>Pseudo</label></td><td><input class="connexion_input" type="text" name="pseudoconnect" value="" placeholder="Introduisez le pseudo"></td></tr>
				</tr>
				<tr>
					<td class="label"><label>Pasword</label></td><td><input class="connexion_input" type="password" name="mdpconnect" value="" placeholder="Introduisez le password"></td>
			    </tr>
			   
		</table>			
		<input class="submit_connexion" type="submit" name="connexion" value="Connexion">
		<input type="reset" class="submit_connexion" value="Reset">
		<?php } ?>
		<?php if(isset($erreur)){
			echo '<p class="erreur_connexion">'.$erreur.'</p>';}
		 ?>
	
	</div>	
</div>

</body>
<footer>
	<div class="container">
		<p>&copy; Tous droits réservés ...</p>
	</div>
</footer>
</html>


