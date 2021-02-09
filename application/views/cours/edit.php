
<div class="row">	
	<div class="col-md-10 ml-3" style="margin-left:10px">
		<div class="card">
			<div class="card-header">
				<h3>Modifier un cours</h3>
				
			</div>
			<div class="card-body">
				<form action="<?php echo site_url("Edit_course/".$course['id_cours']);?>" method="post">
					<label for="nom_cours">Nom du cours</label>
					<input type="text" name="nom_cours" value="<?php echo $course['nom_cours'];?>" class="form-control" required><br>
					<button type="submit" class="btn btn-primary">Modifier</button>
				</form>
			</div>
		</div>

	</div>
</div>
	
	

