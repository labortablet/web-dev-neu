<?php
session_unset ();
session_destroy ();
header ( "Location: " . PROJECT_ROOT );
?>