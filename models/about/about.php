<?php

/**
 * Build the about content from the template in views/about/about.txt
 * 
 * @return string
 */
function buildAbout() {

	$aboutContent = file_get_contents ( "views/about/about.txt" );
	
	$replaceArray = array (
			"%%NAME%%" => ABOUT_NAME,
			"%%STREET%%" => ABOUT_STREET,
			"%%CITY%%" => ABOUT_CITY,
			"%%EMAIL%%" => ABOUT_EMAIL,
			"%%PHONE%%" => ABOUT_PHONE,
			"%%FAX%%" => ABOUT_FAX 
	);
	
	foreach ( $replaceArray as $v => $n ) {
		$aboutContent = str_replace ( $v, $n, $aboutContent );
	}
	
	return $aboutContent;

}