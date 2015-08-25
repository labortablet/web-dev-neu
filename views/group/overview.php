<?php
$groups = getGroups ();
?>
<div
	style="margin-left: auto; margin-right: auto; width: 100%; max-width: 800px;">
	<h1 style="text-align: center;">Group Overview (<?php echo count($groups); ?>)</h1>
	<table border="1" style="width: 100%;" class="rowlink table-striped table-hover">
		<thead>
			<tr>
				<th style="padding: 3px;">ID</th>
				<th style="padding: 3px;">Name</th>
				<th style="padding: 3px;">Users</th>
				<th style="padding: 3px;">Projects</th>
				<th style="padding: 3px;">Modified</th>
				<th style="padding: 3px;"></th>
			</tr>
		</thead>
		<tbody>
        <?php
								foreach ( $groups as $g ) :
									?>
        <tr href="<?php echo PROJECT_ROOT."/group/info/{$g['id']}"; ?>">
				<td style="padding: 3px;"><?php echo $g["id"]; ?></td>
				<td style="padding: 3px;"><?php echo $g["name"]; ?></td>
				<td style="padding: 3px;"><?php echo $g["users"]; ?></td>
				<td style="padding: 3px;"><?php echo $g["projects"]; ?></td>
				<td style="padding: 3px;"><?php echo $g["create_date"]; ?></td>
				<td style="padding: 3px; width: 5px; white-space: nowrap;"><a
					class="btn btn-primary disabled"
					href="<?php echo PROJECT_ROOT.""; ?>">Edit</a> <a
					class="btn btn-danger"
					href="<?php echo PROJECT_ROOT."/group/delete/{$g['id']}"; ?>">Delete</a>
				</td>
			</tr>
        <?php
								endforeach
								;
								?>
		</tbody>
	</table>
</div>