<?php
$user = getUser ();
// $users = getUsers();
$projects = getProjects ();
$groups = getGroups ();
global $db;
?>
<div
	style="margin-left: auto; margin-right: auto; width: 100%; max-width: 800px;">
	<h1 style="text-align: center;">User info: <?php echo "{$user['firstname']} {$user['lastname']} (ID {$user['id']})"; ?></h1>
	<h3 style="text-align: center;"><?php echo "{$user['email']}"; ?></h3>
	<hr />
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
		<table border="0" style="width: 100%;" class="">
			<tr>
				<td style="width: 50%; padding: 10px;"><a class="btn btn-primary"
					style="width: 100%;"
					href="<?php echo PROJECT_ROOT."/user/changepassword/{$user['id']}"; ?>">Set
						password</a></td>
				<td style="width: 50%; padding: 10px;"><button style="width: 100%;"
						class="btn btn-danger" data-toggle="modal"
						data-target="#deleteUser">Delete</button></td>
			</tr>
		</table>
		<h2>Edit</h2>
		<form action="" method="POST">
			<input type="hidden" name="action" value="updateUserSettings" />
			<table border="1" style="width: 100%;"
				class="table-striped table-hover">
				<tr>
					<th style="padding: 3px; width: 50%;">E-Mail</th>
					<td style="padding: 3px;"><input class="form-control" type="text"
						value="<?php echo "{$user['email']}"; ?>" disabled /></td>
				</tr>
				<tr>
					<th style="padding: 3px; width: 50%;">First name</th>
					<td style="padding: 3px;"><input class="form-control"
						name="userFirstName" type="text"
						value="<?php echo "{$user['firstname']}"; ?>" /></td>
				</tr>
				<tr>
					<th style="padding: 3px; width: 50%;">Last name</th>
					<td style="padding: 3px;"><input class="form-control"
						name="userLastName" type="text"
						value="<?php echo "{$user['lastname']}"; ?>" /></td>
				</tr>
				<tr>
					<th style="padding: 3px; width: 50%;">Type</th>
					<td style="padding: 3px;"><select class="form-control"
						name="userType">
							<option value="1"
								<?php echo $user['type'] == 1 ? " selected" : ""; ?>>User</option>
							<option value="2"
								<?php echo $user['type'] == 2 ? " selected" : ""; ?>>Admin</option>
					</select></td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 3px;"><input
						class="btn btn-primary" type="submit" style="width: 100%;"
						value="Save settings" /></td>
				</tr>
			</table>
		</form>
		<hr />
		<h2>Member of <?php echo count($groups); ?> groups</h2>
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

	<!-- Delete User Modal -->
	<div id="deleteUser" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Delete user</h4>
				</div>
				<div class="modal-body" style="text-align: center;">
					<p>
						<strong><?php echo "{$user["firstname"]} {$user["lastname"]}"; ?></strong>
					</p>
					<p>
						ID: <?php echo $user["id"]; ?>
					</p>
					<p>
						<?php echo "{$user["email"]}"; ?>
					</p>
					<p style="margin-top: 50px;">


						
					<h4>This can not be undone</h4>
					<h4>Are you sure to delete this user?</h4>
					</p>
				</div>
				<div class="modal-footer">
					<form action="" method="POST" style="display: inline;">
						<input type="hidden" name="action" value="deleteUser" />
						<input type="submit" class="btn btn-danger" value="Delete" /></form>
					<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
				</div>
			</div>

		</div>
	</div>

</div>