<?php
$group = getGroup ();
$users = getUsers ();
$projects = getProjects ();

$usersNotInGroup = getUsersNotInGroup ();
$projectsNotInGroup = projectsNotInGroup ();
?>
<div
	style="margin-left: auto; margin-right: auto; width: 100%; max-width: 800px;">
	<h1 style="text-align: center;">Group info: <?php echo "{$group['name']} (ID {$group['id']})"; ?></h1>
	<h3 style="text-align: center;"><?php echo "{$group['description']}"; ?></h3>
	<hr />
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
		<table border="0" style="width: 100%;" class="">
			<tr>
				<td style="width: 100%; padding: 10px;"><a class="btn btn-danger"
					style="width: 100%;"
					href="<?php echo PROJECT_ROOT."/group/delete/{$group['id']}"; ?>">Delete
						Group</a></td>
			</tr>
		</table>
		<h2>Edit</h2>
		<form action="" method="POST">
			<input type="hidden" name="action" value="updateGroupSettings" />
			<table border="1" style="width: 100%;"
				class="table-striped table-hover">
				<tr>
					<th style="padding: 3px; width: 50%;">Name</th>
					<td style="padding: 3px;"><input class="form-control"
						name="groupName" type="text"
						value="<?php echo "{$group['name']}"; ?>" /></td>
				</tr>
				<tr>
					<th style="padding: 3px; width: 50%;">Description</th>
					<td style="padding: 3px;"><textarea name="groupDescription"
							class="form-control" rows="3">
<?php echo "{$group['description']}"; ?>
</textarea></td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 3px;"><input
						class="btn btn-primary" type="submit" style="width: 100%;"
						value="Save settings" /></td>
				</tr>
			</table>
		</form>
		<h2><?php echo count($users); ?> group members</h2>
		<table border="1" style="width: 100%;"
			class="rowlink table-striped table-hover">
			<tr>
				<th style="padding: 3px;">ID</th>
				<th style="padding: 3px;">Name</th>
				<th style="padding: 3px;">E-Mail</th>
				<th style="padding: 3px;"></th>
			</tr>
	        <?php
									foreach ( $users as $u ) :
										?>
	        <tr href="<?php echo PROJECT_ROOT."/user/info/{$u['id']}"; ?>">
				<td style="padding: 3px;"><?php echo $u["id"]; ?></td>
				<td style="padding: 3px;"><?php echo $u["firstname"]." ".$u["lastname"]; ?></td>
				<td style="padding: 3px;"><?php echo $u["email"]; ?></td>
				<td style="padding: 3px; width: 1px;"><a class="btn btn-danger"
					href="<?php echo PROJECT_ROOT."/group/removeuser/{$group['id']}/{$u['id']}"; ?>">Remove</a></td>
			</tr>
	        <?php
									endforeach
									;
									?>
	    </table>
		<table border="1" style="width: 100%;">
			<tr>
				<form
					action="<?php echo PROJECT_ROOT."/group/adduser/{$group['id']}"; ?>"
					method="POST">
					<input type="hidden" name="action" value="addUser" />
					<td style="padding: 3px;"><select name="userId"
						class="form-control" required>
							<option></option>
						<?php foreach($usersNotInGroup as $u):?>
						<option value="<?php echo $u['id']; ?>"><?php echo "{$u['firstname']} {$u['lastname']} (ID {$u['id']})"; ?></option>
						<?php endforeach; ?>
					</select></td>
					<td style="padding: 3px; width: 1px;"><input type="submit"
						value="Add User" class="btn btn-success" />
				
				</form>
			</tr>
		</table>

		<h2><?php echo count($projects); ?> assigned projects</h2>
		<table border="1" style="width: 100%;"
			class="rowlink table-striped table-hover">
			<tr>
				<th style="padding: 3px;">ID</th>
				<th style="padding: 3px;">Name</th>
				<th style="padding: 3px; width: 1px;"></th>
			</tr>
	        <?php
									foreach ( $projects as $p ) :
										?>
	        <tr
				href="<?php echo PROJECT_ROOT."/project/info/{$p['id']}"; ?>">
				<td style="padding: 3px;"><?php echo $p["id"]; ?></td>
				<td style="padding: 3px;"><?php echo $p["name"]; ?></td>

				<td style="padding: 3px; width: 1px;"><a class="btn btn-danger"
					href="<?php echo PROJECT_ROOT."/group/removeproject/{$group['id']}/{$p['id']}"; ?>">Remove</a></td>

			</tr>
	        <?php
									endforeach
									;
									?>
	    </table>
		<table border="1" style="width: 100%;">
			<tr>
				<form
					action="<?php echo PROJECT_ROOT."/group/addproject/{$group['id']}"; ?>"
					method="POST">
					<input type="hidden" name="action" value="addProject" />
					<td style="padding: 3px;"><select name="projectId"
						class="form-control" required>
							<option></option>
						<?php foreach($projectsNotInGroup as $p):?>
						<option value="<?php echo $p['id']; ?>"><?php echo "{$p['name']} (ID {$p['id']})"; ?></option>
						<?php endforeach; ?>
					</select></td>
					<td style="padding: 3px; width: 1px;"><input type="submit"
						value="Add Project" class="btn btn-success" /></td>
				</form>
			</tr>
		</table>

	</div>

</div>