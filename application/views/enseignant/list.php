<div class="row">	
	<div class="col-md-12 ml-2 ">
		<?php // echo "<pre>"; print_r($enseignants); echo "</pre>";?>
		<div class="card">
			<div class="card-header">
                <h3 class="card-title">Liste des Enseignants</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                      <a href="<?php echo base_url("Enseignant/add") ?>" type="submit" class="btn btn-default">Ajouter <i class="fas fa-plus"></i></a>
                    </div>
                  </div>
                </div>
            </div>
			<div class="card-body table-responsive p-0">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>N°</th>
							<th>Email de l'enseignant</th>
							<th>Mot de passe</th>
							<th>Cours données</th>
							<th>Promotions</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$i = 0;
						foreach ($enseignants as $key => $enseignant)
						{ 
							$i++;
							?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $enseignant["enseignant"]["email"]; ?></td>
							<td><?php echo $enseignant["enseignant"]["mdp"]; ?></td>
							<td><?php
									if (!empty($enseignant['cours'])) {
										$j = 0;
										foreach ($enseignant['cours'] as $key => $course) {
											$j++;
											if ($j == 4) {
												echo "<br>";
											}
											if (!empty($course)){
												echo $course[0]["nom_cours"]. ",";
											}
											
										}
										
									}
															
							?></td>
							<td><?php
									if (!empty($enseignant['promotions'])) {
										$j = 0;
										foreach ($enseignant['promotions'] as $key => $promotion) {
											$j++;
											if ($j == 4) {
												echo "<br>";
											}
											if (!empty($promotion)) {
												echo $promotion[0]['nom_promotion']. ",";
											}
											
										}
									}
															
							?></td>	
							<td>
								<a href="<?php echo base_url("Edit_enseignant/".$enseignant["enseignant"]["id_enseignant"]) ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-container="body" title="Modifier">
									<i class="nav-icon fas fa-edit"></i>
								</a>
								<a href="<?php echo base_url("Delete_enseignant/".$enseignant["enseignant"]["id_enseignant"]) ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-container="body" title="Supprimer">
									<i class="far fa-trash-alt"></i>
								</a>
							</td>
						<tr>
							<?php
						}
						
						?>
					</tbody>
				</table>
			</div>

		</div>
		
	</div>
			
</div>
	
	

