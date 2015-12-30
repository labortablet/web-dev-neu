<?php
$project = getProject ();
$groups = getGroups ();
?>
<div id="contentPanel">
	<h1 style="text-align: center;">Project info: <?php echo "{$project['name']} (ID {$project['id']})"; ?></h1>
	<h3 style="text-align: center;"><?php echo "{$project['description']}"; ?></h3>
	<hr />
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
		<table border="0" style="width: 100%;" class="">
			<tr>
				<td style="width: 100%; padding: 10px;"><button style="width: 100%;"
						class="btn btn-danger" data-toggle="modal"
						data-target="#deleteProject">
						<span class="glyphicon glyphicon-trash"></span> Delete
					</button></td>
			</tr>
		</table>
		<h2>Edit</h2>
		<form action="" method="POST">
			<input type="hidden" name="action" value="updateProjectSettings" />
			<table border="1" style="width: 100%;"
				class="table-striped table-hover">
				<tr>
					<th style="padding: 3px; width: 50%;">Name</th>
					<td style="padding: 3px;"><input class="form-control"
						name="projectName" type="text"
						value="<?php echo "{$project['name']}"; ?>" /></td>
				</tr>
				<tr>
					<th style="padding: 3px; width: 50%;">Description</th>
					<td style="padding: 3px;"><textarea name="projectDescription"
							class="form-control" rows="3">
<?php echo "{$project['description']}"; ?>
</textarea></td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 3px;">
						<button class="btn btn-primary" type="submit" style="width: 100%;">
							<span class="glyphicon glyphicon-floppy-disk"></span> Save
						</button>
					</td>
				</tr>
			</table>
		</form>
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

	<!-- Delete Project Modal -->
	<div id="deleteProject" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Delete project</h4>
				</div>
				<div class="modal-body" style="text-align: center;">
					<p>
						<strong><?php echo $project["name"]; ?></strong>
					</p>
					<p>
						ID: <?php echo $project["id"]; ?>
					</p>
					<p>
						<?php echo "{$project["description"]}"; ?>
					</p>
					<p style="margin-top: 50px;">
					
					
					<h4>This can not be undone</h4>
					<h4>Are you sure to delete this project?</h4>
					</p>
				</div>
				<div class="modal-footer">
					<form
						action="<?php echo PROJECT_ROOT."/project/info/".$project["id"]; ?>"
						method="POST" style="display: inline;">
						<input type="hidden" name="action" value="deleteProject" /> <input
							type="submit" class="btn btn-danger" value="Delete" />
					</form>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>

		</div>
	</div>

</div>