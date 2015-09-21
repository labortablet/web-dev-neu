<?php
$experiment = getExperiment ();
$entries = getEntries ();
?>
<div id="contentPanel">
	<h1 style="text-align: center;">
		<small>Experiment</small>
	</h1>
	<h1 style="text-align: center;"><?php echo $experiment["name"]; ?></h1>
	<h3 style="text-align: center;"><?php echo $experiment["description"]; ?></h3>
	<hr />
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 600px;">
		<?php foreach($entries as $en): ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					Entry: <strong><?php echo $en["title"]; ?></strong>
				</h3>
				Created by <?php echo "{$en["firstname"]} {$en["lastname"]}";?>
			</div>
			<div class="panel-body">[CONTENT]</div>
		</div>
		<?php endforeach; ?>

	</div>

</div>


