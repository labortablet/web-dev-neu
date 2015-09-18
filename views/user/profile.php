<?php
$groups = getGroups ();
$projects = getProjects ();

// var_dump($projects);

?>
<div id="contentPanel">
	<h1 style="text-align: center;">My profile</h1>

	<hr />

	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>You are member of <?php echo count($projects);?> Project(s)</strong>
			</div>

			<table class="table rowlink">
				<tr href="<?php echo PROJECT_ROOT."/project/my"; ?>">
					<th>Name</th>
					<th>Description</th>
				</tr>
	        <?php
									foreach ( $projects as $p ) :
										?>
				<tr href="<?php echo PROJECT_ROOT."/project/my"; ?>">
					<td><?php echo $p["name"]; ?></td>
					<td><?php echo $p["description"]; ?></td>
				</tr>
					        <?php
									endforeach
									;
									?>
			</table>
		</div>
		<!-- /My Projects Panel -->


		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>You are member of <?php echo count($groups);?> Group(s)</strong>
			</div>

			<table class="table">
				<tr>
					<th>Name</th>
					<th>Description</th>
				</tr>
	        <?php
									foreach ( $groups as $g ) :
										?>
				<tr>
					<td><?php echo $g["name"]; ?></td>
					<td><?php echo $g["description"]; ?></td>
				</tr>
					        <?php
									endforeach
									;
									?>
			</table>
		</div>
		<!-- /My Groups Panel -->
	</div>

</div>