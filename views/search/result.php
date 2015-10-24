<?php
$searchResults = getResults ();
?>

<div id="contentPanel">
	<h1 style="text-align: center;">
		Search<br /> <small>Searching for <strong><?php echo $_GET["s"]; ?></strong></small>
	</h1>
	<div
		style="margin-left: auto; margin-right: auto; width: 100%; max-width: 600px;">
		<div id="searchResults" style="margin-top: 50px;">
					
			<h4>Entries (<?php echo count ( $searchResults ["entries"] )?> found)</h4>
						<?php
						if (count ( $searchResults ["entries"] ) > 0) :
							?>
			<table class="table rowlink">
			<?php
							foreach ( $searchResults ["entries"] as $e ) :
								?>
				
					<tr href="<?php echo PROJECT_ROOT."/experiment/".$e["expr_id"];?>">
					<td><?php echo $e["title"]; ?></td>
				</tr>
			
			<?php
							endforeach
							;
							?>
			</table>
			
			
			
			
			
			
			
						<?php 
			
			endif;
						?>

		</div>
	</div>

</div>