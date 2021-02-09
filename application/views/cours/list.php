<div class="row">	
	<div class="col-md-11" style="margin-left:10px">
		<div class="card">
			<div class="card-header">
				<h3>Ajouter un cours</h3>
			</div>
			<div class="card-body">
				<form action="<?php echo site_url("Cours/add");?>" method="post">
					<div class="row">
						<label for="nom_cours">Nom du cours</label>
						<div class="col-4">
							<input type="text" name="nom_cours" class="form-control" required>
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
							<button type="submit" class="btn btn-primary">Ajouter</button>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card-body table-responsive p-0">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>N°</th>
						<th>Nom du cours</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$c = 1;
					foreach ($cours as $element) 
					{
						?>			
					<tr>
						<td><?php echo $c++ ?></td>
						<td><?php echo $element["nom_cours"] ?></td>			
						<td>
							<a href="<?php echo base_url("Edit_course/".$element['id_cours']) ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-container="body" title="Modifier">
								<i class="nav-icon fas fa-edit"></i>
							</a>
							<a href="<?php echo base_url("Delete_course/".$element['id_cours']) ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-container="body" title="Supprimer">
								<i class="far fa-trash-alt"></i>
							</a>
						</td>			
					</tr>

					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
			
</div>
	
	

