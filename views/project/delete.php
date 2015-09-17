<?php
$project = getProject ();
?>
<div id="contentPanel">
	<h1 style="text-align: center;">Delete Project: <?php echo "{$project['name']} (ID {$project['id']})"; ?></h1>
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
		<p>
			Are you sure to <strong>delete <?php echo "{$project['name']}"; ?></strong>?
		</p>
		<form action="" method="POST">
			<input type="hidden" name="action" value="deleteProject" /> <input
				type="submit" value="Delete" class="form-control btn-danger" />
		</form>
		<p>
			<a href="<?php echo PROJECT_ROOT ?>/project/overview"
				class="btn btn-default form-control">Cancel</a>
		</p>
	</div>

</div>