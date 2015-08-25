<?php

global $nav;
// LOGIC //

	$separator = new NavSeparator();

	// USERS
	$dropDown = new NavBarDropDown ( "Users" );
	$dropDown->addItem ( new NavBarItem ( "My Profile", PROJECT_ROOT . "/user/profile", "" ) );
	$dropDown->addItem($separator);
	$dropDown->addItem(new NavHeader("Admin"));
	$dropDown->addItem ( new NavBarItem ( "All User", PROJECT_ROOT . "/user/overview", "" ) );
	$dropDown->addItem ( new NavBarItem ( "New User", PROJECT_ROOT . "/user/newuser", "" ) );
	$nav->addItem ( $dropDown );
	
	
	// GROUPS
	$dropDown = new NavBarDropDown ( "Groups" );
	$dropDown->addItem ( new NavBarItem ( "My Groups", PROJECT_ROOT . "/group/my", "" ) );
	$dropDown->addItem($separator);
	$dropDown->addItem(new NavHeader("Admin"));
	$dropDown->addItem ( new NavBarItem ( "All Groups", PROJECT_ROOT . "/group/overview", "" ) );
	$dropDown->addItem ( new NavBarItem ( "New Group", PROJECT_ROOT . "/group/create", "" ) );
	$nav->addItem ( $dropDown );
	
	
	// PROJECTS
	$dropDown = new NavBarDropDown ( "Projects" );
	$dropDown->addItem ( new NavBarItem ( "My Projects", PROJECT_ROOT . "#", "disabled" ) );
	$dropDown->addItem($separator);
	$dropDown->addItem(new NavHeader("Admin"));
	$dropDown->addItem ( new NavBarItem ( "All Projects", PROJECT_ROOT . "/project/overview", "" ) );
	$dropDown->addItem ( new NavBarItem ( "New Project", PROJECT_ROOT . "/project/create", "" ) );
	$nav->addItem ( $dropDown );
	
	$nav->addItem ( new NavBarItem ( "Logout", PROJECT_ROOT . "/login/logout", "" ) );

?>