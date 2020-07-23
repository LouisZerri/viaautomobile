<?php require "include/header.php"; ?>
<style>

	/*Pour les grands écrans */

	@media screen and (min-width: 1080px) and (max-width: 1360px) 
	{
		.index
		{
			position: absolute; 
			width: 100%; 
			height: 25%; 
			top: 0; 
			bottom: 0; 
			left: 0; 
			right: 0; 
			margin: auto;
			zoom: 125%;
		}
	}
	@media screen and (min-height: 770px) and (max-height: 1920px)
	{
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
			zoom:125%;
		}
	}


	/*Pour les tablettes et ipad */

	@media (min-width: 768px) and (max-width: 1024px) 
	{
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
			zoom:100%;
		}
	}
	@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) 
	{
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
		<span id="p2">VOS COLLABORATEURS</span>
	</div>
	</br>
	<a id="connexion" class="btn btn-light" href="login.php" role="button">connexion</a>
	<a id="inscription" class="btn btn-light" href="creation_compte.php" role="button">inscription</a>
</div>


<div id="fin">
	<p>Powered by Pepperbay</p>
</div>


<?php require "include/footer.php"; ?>