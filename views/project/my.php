<?php
$projects = getProjects ();

?>
<div
	style="margin-left: auto; margin-right: auto; width: 100%; max-width: 800px;">
	<h1 style="text-align: center;">My projects</h1>
	<h3 style="text-align: center;">You are assigned to <?php echo count($projects);?> Project(s)</h3>
	<hr />
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
	    <?php
					foreach ( $projects as $p ) :
						
						$experiments = getExperiments ( $p {"id"} );
						?>
	    <div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<strong><?php echo $p["name"]; ?></strong>
				</h3>
				<small><?php echo $p["description"]; ?></small><br /> <small>999 Entries in <?php echo $p["experiments"]; ?> Experiments</small>
			</div>
			<div class="panel-body">
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

				</div>
			<?php
						endforeach
						;
						?>
			</div>
		</div>
	    <?php
					endforeach
					;
					?>

	</div>

</div>


