<?php require "include/header.php"; ?>
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

	p
	{
		color: white;
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

	.index
	{
		position: absolute; 
		width: 100%; 
		height: 25%; 
		top:0; 
		bottom:0; 
		left:0; 
		right: 0; 
		margin: auto;
	}
	
</style>
<img style="right: 0; padding-bottom: 170px; position: fixed;" src="style/logo_blanc.svg" alt="logo" width="250" height="250">
<?php if(isset($_SESSION['flash'])): ?>
	<?php foreach($_SESSION['flash'] as $type => $message): ?>
		<div class="alert alert-<?= $type;?> alert-dismissible fade show" role="alert">
	  		<?= $message; ?>
	  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
  	<?php endforeach; ?>
  	<?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="index">
	<div style="padding-left: 20px;">
		<span id="p1">CHALLENGEZ</span></br>
		<b id="p2">VOS COLLABORATEURS</b>
	</div>

	<a style="margin-left: 20px;" class="btn btn-outline-light" href="login.php" role="button">connexion</a>
	<a style="margin-left: 20px;" class="btn btn-outline-light" href="creation_compte.php" role="button">inscription</a>
</div>


<div id="fin">
	<p>Powered by Pepperbay</p>
</div>


<?php require "include/footer.php"; ?>