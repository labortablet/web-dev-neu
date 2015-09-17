<?php
$groups = getGroups ();
$projects = getProjects ();

// var_dump($projects);

?>
<div
	style="margin-left: auto; margin-right: auto; width: 100%; max-width: 800px;">
	<h1 style="text-align: center;">My profile</h1>

	<hr />
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
		<h3 style="text-align: center;">You are member of <?php echo count($groups);?> Group(s)</h3>
		<table border="1" style="width: 100%;" class="rowlink table-striped">
			<tr href="<?php echo PROJECT_ROOT."/group/my"; ?>">
				<th style="padding: 3px;">Name</th>
				<th style="padding: 3px;">Description</th>
			</tr>
	        <?php
									foreach ( $groups as $g ) :
										?>
	        <tr href="<?php echo PROJECT_ROOT."/group/my"; ?>">
				<td style="padding: 3px;"><?php echo $g["name"]; ?></td>
				<td style="padding: 3px;"><?php echo $g["description"]; ?></td>
			</tr>
	        <?php
									endforeach
									;
									?>
	    </table>
		<br />
		<h3 style="text-align: center;">You are member of <?php echo count($projects);?> Project(s)</h3>
		<table border="1" style="width: 100%;" class="rowlink table-striped">
			<tr href="<?php echo PROJECT_ROOT."/project/my"; ?>">
				<th style="padding: 3px;">Name</th>
				<th style="padding: 3px;">Description</th>
			</tr>
	        <?php
									foreach ( $projects as $p ) :
										?>
	        <tr href="<?php echo PROJECT_ROOT."/project/my"; ?>">
				<td style="padding: 3px;"><?php echo $p["name"]; ?></td>
				<td style="padding: 3px;"><?php echo $p["description"]; ?></td>
			</tr>
	        <?php
									endforeach
									;
									?>
	    </table>

	</div>

</div>