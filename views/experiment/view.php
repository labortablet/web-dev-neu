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
		<div class="panel-group" id="entry<?php echo $en["id"]; ?>"
			role="tablist" aria-multiselectable="false">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion"
							href="#collapse<?php echo $en["id"]; ?>" aria-expanded="false"
							aria-controls="collapse<?php echo $en["id"]; ?>">
							<h3 class="panel-title">
								Entry: <strong><?php echo $en["title"]; ?></strong>
							</h3>
				Created by <?php echo "{$en["firstname"]} {$en["lastname"]} on {$en["date"]}";?></a>
					</h4>
					(Type <?php echo $en["attachment_type"]; ?>)
				</div>
				<div id="collapse<?php echo $en["id"]; ?>"
					class="panel-collapse collapse" role="tabpanel"
					aria-labelledby="headingOne">
					<div class="panel-body"><?php echo renderEntryAttachment($en["attachment"], $en["attachment_type"]);?></div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>

	</div>

</div>


