<?php

?>
<div id="contentPanel">
	<h1 style="text-align: center;">Settings</h1>
	<hr />
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 600px;">


		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Directories</div>

			<!-- Table -->
			<table class="table">
				<tr>
					<th>Directory</th>
					<th>Writable</th>
				</tr>
				<tr>
					<td>upload</td>
					<td><strong style="color: <?php echo (is_writable("upload") ? "green;\">YES" : "red;\">NO");?></strong></td>
				</tr>
			</table>
		</div>
	</div>
</div>


