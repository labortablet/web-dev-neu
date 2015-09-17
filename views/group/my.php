<?php
$groups = getGroups ();

?>
<div id="contentPanel">
	<h1 style="text-align: center;">My groups</h1>
	<h3 style="text-align: center;">You are member of <?php echo count($groups);?> Group(s)</h3>
	<hr />
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
		<table border="1" style="width: 100%;"
			class="table-striped">
			<tr>
				<th style="padding: 3px;">Name</th>
				<th style="padding: 3px;">Description</th>
			</tr>
	        <?php
									foreach ( $groups as $g ) :
										?>
	        <tr>
				<td style="padding: 3px;"><?php echo $g["name"]; ?></td>
				<td style="padding: 3px;"><?php echo $g["description"]; ?></td>
			</tr>
	        <?php
									endforeach
									;
									?>
	    </table>

	</div>

</div>