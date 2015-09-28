<?php

/**
 * Build the privacy content from the template in views/about/privacy.txt
 *
 * @return string
 */
function buildPrivacy() {

	$privacyContent = file_get_contents ( "views/about/privacy.txt" );
	
	return $privacyContent;

}