<?php
$users = getUsers ( 100 );
?>
<div id="contentPanel">
	<h1 style="text-align: center;">User Overview (<?php echo count($users); ?>)</h1>
	<table border="1" style="width: 100%;"
		class="rowlink table-striped table-hover">
		<tr>
			<th style="padding: 3px;">ID</th>
			<th style="padding: 3px;">Name</th>
			<th style="padding: 3px;">E-Mail</th>
			<th style="padding: 3px;">Modified</th>
		</tr>
        <?php
								foreach ( $users as $u ) :
									$userType = "";
									if ($u ["type"] == 2) {
										$userType = " (Admin)";
									}
									
									?>
        <tr href="<?php echo PROJECT_ROOT."/user/info/{$u['id']}"; ?>">
			<td style="padding: 3px;"><?php echo $u["id"]; ?></td>
			<td style="padding: 3px;"><?php echo "{$u["firstname"]} {$u["lastname"]}{$userType}"; ?></td>
			<td style="padding: 3px;"><?php echo $u["email"]; ?></td>
			<td style="padding: 3px;"><?php echo $u["create_date"]; ?></td>
		</tr>
        <?php
								endforeach
								;
								?>
    </table>
	<p style="margin-top: 10px; text-align: center;">Type 1 = User | Type 2
		= Admin</p>
</div>