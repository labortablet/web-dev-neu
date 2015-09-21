<?php

function buildPrivacy() {

	$privacyContent = file_get_contents ( "views/about/privacy.txt" );
	
	return $privacyContent;

}