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
		<table border="1" style="width: 100%;" class="table-striped">
			<tr>
				<th style="padding: 3px;">Name</th>
				<th style="padding: 3px;">Description</th>
				<th style="padding: 3px;">Experiments</th>
			</tr>
	        <?php
									foreach ( $projects as $p ) :
										?>
	        <tr>
				<td style="padding: 3px;"><?php echo $p["name"]; ?></td>
				<td style="padding: 3px;"><?php echo $p["description"]; ?></td>
				<td style="padding: 3px;"><?php echo $p["experiments"]; ?></td>
			</tr>
	        <?php
									endforeach
									;
									?>
	    </table>

	</div>

</div>