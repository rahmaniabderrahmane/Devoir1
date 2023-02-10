<?php 

$bdd = new PDO("mysql:host=127.0.0.1;dbname=form", "root", "root");






if (isset($_POST['inscription']))
{
		$pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $email2 = htmlspecialchars($_POST['email2']);
        $mdp = md5($_POST['mdp']);
        $mdp2 = md5($_POST['mdp2']);

	if (!empty($_POST['pseudo']) and !empty($_POST['email']) and !empty($_POST['email2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2'])) 
	{
		
        if ($email== $email2)
        { 	
        	$reqpseudo= $bdd->prepare("SELECT * FROM membre where pseudo=?");
        	$reqpseudo->execute(array($pseudo));
        	$pseudoexist = $reqpseudo->rowcount();
        	if($pseudoexist==0){
	        	$reqemail= $bdd->prepare("SELECT * FROM membre where email= ?");
	        	$reqemail-> execute (array($email));
	        	$emailexist = $reqemail->rowCount();
	        	if ($emailexist==0){ 

		        	if ($mdp==$mdp2)
		        	{
		        	$insertmbr = $bdd->prepare("INSERT INTO membre(pseudo, email, motdepasse) VALUES(?, ?, ?)");
		        	if($insertmbr -> execute(array($pseudo, $email, $mdp)))
						{	
							$erreur ="votre compte a bien été créé ! <br> 
							<a href=\"acceuil.php\">Me connecter</a>";
						}  
					else{
						$erreur= $mdp;
					}    	  
		        	}
		        	else{
		        		$erreur ="vos mot de passe ne correspendent pas !";
	        		
	        		}
	        	}
	        	else{
	        		$erreur=" l'adresse mail est déja utilisé";
	        	}	
            }
            else{
            	$erreur="le pseudo est déja utilisé";
            }    
        }
        else {
        	$erreur = "vos adresses mail ne correspendent pas !";
        	
         } 
        
	}else {
		$erreur ="tous les champs doivent etre complétés !";
	    
	}
}



?>
<html>
<head>
	<title>Inscription</title>
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
					<li><a href="acceuil.php">CONNEXION</a></li>	
					<li><a href="inscription.php">INSCRIPTION</a></li>
					
				</ul>
			</div>
		</nav>
	</header>


			
<div class='main'style="width: 500px;">
	
	<div class="acceuild">
	 	
	 	
									 
		<?php  if(isset($_SESSION['id'])){

		}
	else{ ?>
		
		<table class="connexion">
			<form action="" method="POST" accept-charset="utf-8">
				
			
							<tr><td class="label">pseudo  </td><td><input class="connexion_input" type="text" name="pseudo" 
								value="<?php if (isset($pseudo))
							{echo $pseudo ;} ?>" placeholder=""></td></tr>

							<tr><td class="label">email</td><td><input class="connexion_input" type="email" name="email" 
								value="<?php if (isset($email))
							{echo $email ;}?>" placeholder=""></td></tr>

							<tr><td class="label">email</td><td><input class="connexion_input" type="email" name="email2" 
								value="<?php if (isset($email2)){echo $email2 ;} ?>" placeholder=""></td></tr>

							<tr><td class="label">password</td><td><input class="connexion_input" type="password" name="mdp" value="" placeholder=""></td></tr>

							<tr><td class="label">password</td><td><input class="connexion_input" type="password" name="mdp2" value="" placeholder=""></td></tr>

			    			
							
							
				

		</table><?php } ?>			
		
		<input class="submit_connexion" type="submit" name="inscription" value="Inscription">
		<input type="reset" class="submit_connexion" value="Reset">

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