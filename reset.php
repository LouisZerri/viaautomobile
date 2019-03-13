<?php
    
    require "include/header.php";
    require "include/functions.php";

    $user_id = $_GET['id'];
    $token = $_GET['token'];

    if(isset($user_id) && isset($token))
    {
        require "bdd/database.php";
        $vendeur = selectInfoVendeur($user_id, $token);

        if($vendeur)
        {
            if(!empty($_POST))
            {
                if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm'])
                {
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    updatePassword($password, $vendeur->id_vendeur);
                    session_start();
                    $_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
                    $_SESSION['auth'] = $user;
                    header('Location: login.php');
                    exit();
                }
            }
        }
        else
        {
            session_start();
            $_SESSION['flash']['error'] = "Ce token n'est pas valide";
            header('Location: login.php');
            exit();
        }
    }
    else
    {
        header('Location: login.php');
        exit();
    }
?>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style>
	html, body { 
	  margin:0;
	  padding:0;
	  font-family: 'Montserrat';
	  background: url(style/fond.svg) no-repeat center fixed; 
	  -webkit-background-size: cover; /* pour anciens Chrome et Safari */
	  background-size: cover; /* version standardisée */
	}

    .form-control
	{
		font-size: 10px;
	}

	#fin 
	{
		position: fixed;
  		right: 0;
  		bottom: 0;
		font-size: 12px;
		padding-right: 20px;
		color: white;
	}

	.card
	{
		position: absolute; 
		width: 35%; 
		height: 50%; 
		top:0; 
		bottom:0; 
		left:0; 
		right: 0; 
		margin: auto;
		border-radius: 15px;
	}

    @media screen and (min-width: 1080px) and (max-width: 1360px) {
  		.card {
    		position: absolute; 
			width: 25%; 
			height: 35%; 
			top:0; 
			bottom:0; 
			left:0; 
			right: 0; 
			margin: auto;
			border-radius: 15px;
  		}
	}

	@media screen and (min-height: 770px) and (max-height: 1920px) {
  		.card {
    		position: absolute; 
			width: 25%; 
			height: 35%; 
			top:0; 
			bottom:0; 
			left:0; 
			right: 0; 
			margin: auto;
			border-radius: 15px;
  		}
	}

</style>
<img style="right: 0; padding-bottom: 170px; position: fixed;" src="style/logo_blanc.svg" alt="logo" width="250" height="250">
<div class="card">
	<center>
		</br>
		<img src="style/logo_couleur.svg" alt="logo" width="300" height="75">
        </br>
	</center>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Saissisez votre nouveau mot de passe" required>
            </div>
            <div class="form-group">
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirmez votre nouveau mot de passe" required>
            </div>
            <center></br>
                <button style="background-color: #9D1458;" type="submit" class="btn btn-light"><span style="color: white;">Valider</span></button>
            </center>
        </form>
    </div>
</div>

<div id="fin">
	<p style="color: white;">Powered by Pepperbay</p>
</div>

<?php require "include/footer.php"; ?>