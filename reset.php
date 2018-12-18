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
                    updatePassword($password);
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

	#p1
	{
		color: white;
		font-size: 5em;
	}

	#p2
	{
		color: white;
		font-size: 5em;
	}

	#fin 
	{
  		position : absolute;
  		bottom : 0px;
  		padding-left: 1200px;
  		font-size: 12px;
	}

	.card
	{
		width: 40%;
		margin-left: 400px;
		margin-top: 125px;
	}

</style>
<img style="float: right; padding-bottom: 150px;" src="style/logo_blanc" alt="logo" width="250" height="250">
<div class="card">
	<center>
		</br>
		<img src="style/logo_couleur.png" alt="logo" width="200" height="50">
	</center>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Saissisez votre nouveau mot de passe" required>
            </div>
            <div class="form-group">
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirmez votre nouveau mot de passe" required>
            </div>
            <center>
                <button style="background-color: #9D1458;" type="submit" class="btn btn-light"><span style="color: white;">Valider</span></button>
            </center>
        </form>
    </div>
</div>

<div id="fin">
	<p style="color: white;">Powered by Pepperbay</p>
</div>

<?php require "include/footer.php"; ?>