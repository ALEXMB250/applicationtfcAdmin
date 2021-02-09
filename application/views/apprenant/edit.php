
<div class="row">	
	<div class="col-md-10 ml-3" style="margin-left:10px">
		<div class="card">
			<div class="card-header">
				<h3>Modifier un apprenant</h3>				
			</div>
			<div class="card-body">
				<form action="<?php echo base_url("Edit_apprenant/".$apprenant["id_apprenant"]);?>" method="post">
					<label for="email">Email de l'apprenant</label>
					<input type="email" name="email" value="<?php echo $apprenant['email'];?>" class="form-control" required><br>

					<label for="mdp">Mot de passe</label>
					<input type="text" name="mdp" value="<?php echo $apprenant['mdp'];?>" class="form-control" required><br>
					<button type="submit" class="btn btn-primary">Modifier</button>
				</form>
			</div>
		</div>

	</div>
</div>
	
	

