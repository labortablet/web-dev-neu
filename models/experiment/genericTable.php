<?php

$rowCount = 3;
$colCount = 3;

if (@$_GET ["r"]) {
	if (is_numeric ( $_GET ["r"] )) {
		$rowCount = $_GET ["r"];
	}
}

if (@$_GET ["c"]) {
	if (is_numeric ( $_GET ["c"] )) {
		$colCount = $_GET ["c"];
	}
}

?>
<form action="" method="POST" name="createEntryTableForm"
	style="display: inline;">
	<input type="hidden" name="action" value="createEntryTable" /> <input
		type="hidden" name="rowCount" value="<?php echo $rowCount; ?>" /> <input
		type="hidden" name="colCount" value="<?php echo $colCount; ?>" />
	<p>
		<input class="form-control" type="text" name="entryTitle"
			placeholder="Entry Title" required />
	</p>
	<table class="table" style="width: 100%;">
	<?php
	for($r = 1; $r <= $rowCount; $r ++) :
		?>
	<tr>
		<?php
		for($c = 1; $c <= $colCount; $c ++) :
			?>
		<td><input type="text" style="width: 100%;"
				name="<?php echo "R{$r}C{$c}"; ?>"></td>
		<?php
		endfor
		;
		?>
	</tr>
	<?php
	endfor
	;
	?>
</table>
</form>