
<div class="row">	
	<div class="col-md-10 ml-3" style="margin-left:10px">
		<div class="card">
			<div class="card-header">
				<h3>Modifier une Promotion</h3>				
			</div>
			<div class="card-body">
				<form action="<?php echo site_url("Edit_promotion/".$promotion['id_promotion']);?>" method="post">
					<label for="nom_promotion">Nom de la promotion</label>
					<input type="text" name="nom_promotion" value="<?php echo $promotion['nom_promotion'];?>" class="form-control" required><br>
					<button type="submit" class="btn btn-primary">Modifier</button>
				</form>
			</div>
		</div>

	</div>
</div>
	
	

