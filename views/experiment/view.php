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

		<div class="dropdown" style="margin-bottom: 20px;">
			<button class="btn btn-primary dropdown-toggle" type="button"
				id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
				aria-expanded="true">
				Create Entry <span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li><a href="#" data-toggle="modal" data-target="#createEntryText">Text</a></li>
				<li><a href="#">Table</a></li>
			</ul>
		</div>
		
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

	<!-- Create Text Entry Modal -->
	<div id="createEntryText" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Create Text Entry</h4>
				</div>
				<div class="modal-body" style="text-align: center;">
					<form action="" method="POST" style="display: inline;">
						<p>
							<input class="form-control" type="text" name="entryTitle"
								placeholder="Entry Title" required />
						</p>
						<p>
							<textarea class="form-control" rows="4" name="entryAttachment"
								placeholder="Entry Data" required></textarea>
						</p>
				
				</div>
				<div class="modal-footer">

					<input type="hidden" name="action" value="createEntryText" /> <input
						type="submit" class="btn btn-primary" value="Create Entry" />
					</form>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>

		</div>
	</div>

</div>


