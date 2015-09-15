<?php
global $self;
global $nav;

// $nav = new Navigation ();
// var_dump($nav->build());
// var_dump($nav->db->getUserType(35));
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="?"><?php echo $self["email"]; ?></a>
		</div>
            <?php
												if ($session->isValid ()) :
													?>
            <!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<?php
													echo $nav->build ();
													?>
		</div>
		<!-- /.navbar-collapse -->
            
												 

												<?php
												
												else :
													?>
            <!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo PROJECT_ROOT; ?>/login">Login</a></li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
            

												<?php
													
													echo "";
												endif;
												?>
        </div>
	<!-- /.container -->
</nav>
<?php
if (GODMODE == 1) {
	echo "<p style=\"width: 100%; color:#F00; text-align: center;\">!!! GODMODE ENABLED !!!</p>";
}
?>
<p></p>