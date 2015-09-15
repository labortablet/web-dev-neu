<?php
$projects = getProjects ();
?>
<div
	style="margin-left: auto; margin-right: auto; width: 100%; max-width: 800px;">
	<h1 style="text-align: center;">Project Overview (<?php echo count($projects); ?>)</h1>
	<table border="1" style="width: 100%;" class="rowlink table-striped table-hover">
		<thead>
			<tr>
				<th style="padding: 3px;">ID</th>
				<th style="padding: 3px;">Name</th>
				<th style="padding: 3px;">In Groups</th>
				<th style="padding: 3px;">Experiments</th>
				<th style="padding: 3px;">Modified</th>
			</tr>
		</thead>
		<tbody>
        <?php
								foreach ( $projects as $p ) :
									?>
        <tr href="<?php echo PROJECT_ROOT."/project/info/{$p['id']}"; ?>">
				<td style="padding: 3px;"><?php echo $p["id"]; ?></td>
				<td style="padding: 3px;"><?php echo $p["name"]; ?></td>
				<td style="padding: 3px;"><?php echo $p["groups"]; ?></td>
				<td style="padding: 3px;"><?php echo $p["experiments"]; ?></td>
				<td style="padding: 3px;"><?php echo $p["create_date"]; ?></td>
			</tr>
        <?php
								endforeach
								;
								?>
		</tbody>
	</table>
</div>