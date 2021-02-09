<div class="row">	
	<div class="col-md-11 ml-3" style="margin-left:10px">
		<div class="card">
			<div class="card-header">
				<h3>Ajouter une promotion</h3>
			</div>
			<div class="card-body">
				<form action="<?php echo site_url("Promotion/add");?>" method="post">
					<label for="nom_promotion">Nom de la promotion</label>
					<input type="text" name="nom_promotion" class="form-control" required><br>
					<button type="submit" class="btn btn-primary">Ajouter</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row">
		<?php
		foreach ($promotions as $key => $promotion) {
			echo '
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">'.$promotion["nom_promotion"].'</h3>
					</div>
			';
			if (is_array($promotion["cours"])) {

				echo '
				<div class="card-body">
						<table class="table table-bordered">
							<thead>                  
								<tr>
									<th style="width: 10px">N°</th>
									<th>Cours</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
				';
				$i = 1;
				// <?php echo site_url("Edit_promotion/".$promotion['id_promotion']);>

				foreach ($promotion["cours"] as $key => $cours) {
					echo '
								<tr>
									<td>'.$i++.'</td>
									<td>'.$cours["nom_cours"].'</td>
									<td>
										<a href="'.base_url("Edit_course/".$cours["id_cours"]).'" data-toggle="tooltip" data-container="body" title="Modifier">
											<i class="nav-icon fas fa-edit"></i>
										</a>
										<a href="'.base_url("Delete_course/".$cours["id_cours"]).'" data-toggle="tooltip" data-container="body" title="Supprimer">
											<i class="far fa-trash-alt"></i>
										</a>
									</td>
								</tr>
					';
				} 


				echo '
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
				';
			}
		}
		
		?>
	</div>
</div>


	

