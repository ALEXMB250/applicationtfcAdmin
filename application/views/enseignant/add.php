
<div class="row">	
	<div class="col-md-11 ml-3" style="magin-left:10px">
		<div class="card">
			<div class="card-header">
				<h3>Ajouter un enseignant</h3>				
			</div>
			<div class="card-body">

				<form action="<?php echo base_url("Enseignant/add") ?>" method="post">
					<label for="email">Email de l'enseignant</label>
					<input type="text" name="email" class="form-control" required><br>
					<label for="mdp">Mot de passe</label>
					<input type="text" name="mdp" class="form-control" required><br>
					<label for="mdp">Cours</label>
					<?php ?>
					<div class="form-group">
						<select multiple name="cours[]" class="form-control" required>
						<?php
							foreach ($cours as $key => $item) {							
							?>
							<option value="<?php echo $item["id_cours"] ?>"><?php echo $item["nom_cours"] ?></option>
							<?php
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label>Selectionnez les promotions</label>
						<select multiple name="promotions[]" class="form-control" required>
						<?php
							foreach ($promotions as $key => $promotion) {							
							?>
							<option value="<?php echo $promotion["id_promotion"] ?>"><?php echo $promotion["nom_promotion"] ?></option>
							<?php
							}
						?>
						</select>
					</div>

					<button type="submit" class="btn btn-primary">Ajouter</button>
				</form>
			</div>
		</div>

	</div>
</div>
	
	

