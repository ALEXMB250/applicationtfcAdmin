<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php 				
				if(!empty($status)){
					echo '<div class="alert alert-danger">'.$status.'</div>';
				}				
				?>
				<div class="card">
					<div class="card-body">
						<form action="<?php echo site_url("Apprenant/add");?>" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-4">
									<input type="file" name="file" required>
								</div>
								<div class="col-4">
									<div class="form-group">
										<select class="form-control" name="promotion">
											<?php foreach ($promotions as $key => $promotion) {
												if (!empty($promotion)) {
													echo '<option value="'.$promotion["id_promotion"].'">'.$promotion["nom_promotion"]."<option>";
												}
											}?>
										</select>
									</div>
								</div>
								<div class="col-2">
									<button class="btn btn-primary" type="submit" >Valider</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="container-fluid">
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
						if (is_array($promotion["apprenants"])) {

							echo '
							<div class="card-body">
									<table class="table table-bordered">
										<thead>                  
											<tr>
												<th style="width: 10px">N°</th>
												<th>Email</th>
												<th>Mot de passe</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											
							';
							$i = 1;

							foreach ($promotion["apprenants"] as $key => $apprenant) {
								echo '
											<tr>
												<td>'.$i++.'</td>
												<td>'.$apprenant["email"].'</td>
												<td>'.$apprenant["mdp"].'</td>
												<td>
													<a href="'.base_url("Edit_apprenant/".$apprenant["id_apprenant"]).'" data-toggle="tooltip" data-container="body" title="Modifier">
														<i class="nav-icon fas fa-edit"></i>
													</a>
													<a href="'.base_url("Delete_apprenant/".$apprenant["id_apprenant"]).'" data-toggle="tooltip" data-container="body" title="Supprimer">
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
	</div>
</section>
