<?php
$projects = getProjects ();

?>
<div id="contentPanel">
	<h1 style="text-align: center;">My projects</h1>
	<h3 style="text-align: center;">You are assigned to <?php echo count($projects);?> Project(s)</h3>
	<hr />
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 600px;">
	    <?php
					foreach ( $projects as $p ) :
						
						$experiments = getExperiments ( $p ["id"] );
						$experimentsCount = 0;
						
						foreach ( $experiments as $ex ) {
							$experimentsCount += $ex ["entries"];
						}
						
						?>
	    <div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<strong><?php echo $p["name"]; ?></strong>
				</h3>
				<small><?php echo $p["description"]; ?></small><br /> <small><?php echo $experimentsCount;?> Entries in <?php echo $p["experiments"]; ?> Experiments</small>
			</div>
			<div class="panel-body">
				<div style="text-align: center; margin: 0px 0px 15px 0px;">
					<button class="btn btn-primary" data-toggle="modal"
						data-target="#createExperiment<?php echo $p ["id"]; ?>">New
						Experiment</button>
				</div>
			<?php
						foreach ( $experiments as $ex ) :
							?>
				<div class="well experiment">
					Experiment: <?php echo $ex["name"];?>
					<p>
						<small><?php echo $ex["description"];?></small>
					</p>
					<ul>
						<li><?php echo $ex["entries"]; ?> Entries total</li>
						<li><?php echo $ex["entries_me"]; ?> Entries by me</li>
					</ul>
					<div class="delete-button-xs visible-xs">
						<button class="btn btn-danger" data-toggle="modal"
							data-target="#deleteExperiment<?php echo $ex["id"]; ?>">Delete
							Experiment</button>
					</div>
					<div class="delete-button-sm hidden-xs">
						<button class="btn btn-danger" data-toggle="modal"
							data-target="#deleteExperiment<?php echo $ex["id"]; ?>">Delete</button>
					</div>
				</div>
			<?php
						endforeach
						;
						?>
			</div>
		</div>
		
		<?php
						foreach ( $experiments as $ex ) :
							
							$moveToExperiments = getUserExperiments ( $ex ["id"] );
							?>
		<!-- Delete Experiment Modal -->
		<div id="deleteExperiment<?php echo $ex ["id"]; ?>" class="modal fade"
			role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Delete Experiment</h4>
					</div>
					<div class="modal-body" style="text-align: left;">

						<div class="text-center"
							style="margin: auto; width: 100%; max-width: 300px; margin-bottom: 20px;">
							<p>
								<strong>Project:</strong> <?php echo $p["name"]; ?>
							</p>
							<p>
								<strong>Experiment:</strong> <?php echo $ex["name"]; ?>
							</p>
							<p>
								<strong>Entries:</strong> <?php echo $ex["entries"]; ?> total, <?php echo $ex["entries_me"]; ?> by me
							</p>

							<p style="margin-top: 25px;">Move entries to experiment:</p>
							<form action="" method="POST">
								<input type="hidden" name="experimentId"
									value="<?php echo $ex["id"]; ?>" /> <select
									class="form-control" name="moveToExperiment">
									<option value="0">[ Delete entries aswell ]</option>
									<?php foreach ($moveToExperiments as $mte): ?>
									<option value="<?php echo $mte["id"]; ?>"><?php echo "{$mte["project_name"]}/{$mte["experiment_name"]}"; ?></option>
									
									
									<?php endforeach; ?>
								
								
								</select>
						
						</div>

						<div class="text-center">
							<strong>Are you sure to delete this experiment?</strong>
						</div>

					</div>
					<div class="modal-footer">

						<input type="hidden" name="action" value="deleteExperiment" /> <input
							type="submit" class="btn btn-danger" value="Delete" />


						</form>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>

			</div>
		</div>
		<?php
						endforeach
						;
						?>

		<!-- Create Experiment Modal -->
		<div id="createExperiment<?php echo $p ["id"]; ?>" class="modal fade"
			role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">New Experiment</h4>
					</div>
					<div class="modal-body" style="text-align: left;">
						<strong>Create new Experiment in Project <?php echo $p ["name"]; ?></strong>
						<form action="" method="POST" style="display: inline;">
							<div
								style="width: 100%; padding-top: 25px; max-width: 300px; margin: auto;">
								<input type="hidden" name="experimentProject"
									value="<?php echo $p ["id"]; ?>" />
								<p>
									<input class="form-control" type="text" name="experimentName"
										placeholder="Name" />
								</p>
								<p>
									<textarea class="form-control" name="experimentDescription"
										rows="3" placeholder="Description"></textarea>
								</p>
							</div>
					
					</div>
					<div class="modal-footer">

						<input type="hidden" name="action" value="createExperiment" /> <input
							type="submit" class="btn btn-primary" value="Create" />


						</form>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>

			</div>
		</div>
	
	    <?php
					endforeach
					;
					?>

	</div>

</div>


