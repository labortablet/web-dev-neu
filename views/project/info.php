<?php
$project = getProject ();
$groups = getGroups ();
?>
<div
	style="margin-left: auto; margin-right: auto; width: 100%; max-width: 800px;">
	<h1 style="text-align: center;">Project info: <?php echo "{$project['name']} (ID {$project['id']})"; ?></h1>
	<h3 style="text-align: center;"><?php echo "{$project['description']}"; ?></h3>
	<hr />
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
		<table border="0" style="width: 100%;" class="">
			<tr>
				<td style="width: 100%; padding: 10px;"><a class="btn btn-danger"
					style="width: 100%;"
					href="<?php echo PROJECT_ROOT."/project/delete/{$project['id']}"; ?>">Delete
						Project</a></td>
			</tr>
		</table>
		<h2><?php echo count($groups); ?> assigned groups</h2>
		<table border="1" style="width: 100%;"
			class="rowlink table-striped table-hover">
			<tr>
				<th style="padding: 3px;">ID</th>
				<th style="padding: 3px;">Name</th>
			</tr>
	        <?php
									foreach ( $groups as $g ) :
										?>
	        <tr href="<?php echo PROJECT_ROOT."/group/info/{$g['id']}"; ?>">
				<td style="padding: 3px;"><?php echo $g["id"]; ?></td>
				<td style="padding: 3px;"><?php echo $g["name"]; ?></td>
			</tr>
	        <?php
									endforeach
									;
									?>
	    </table>
	</div>

</div>