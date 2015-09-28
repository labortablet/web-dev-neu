<?php
global $nav;

// LOGIC //

$separator = new NavSeparator ();

// USERS
$nav->addItem ( new NavBarItem ( "My Profile", PROJECT_ROOT . "/me", "" ) );

// GROUPS
// $nav->addItem ( new NavBarItem ( "Groups", PROJECT_ROOT . "/group/my", "" ) );

// PROJECTS
$nav->addItem ( new NavBarItem ( "Projects", PROJECT_ROOT . "/project/my", "" ) );

// ADMIN
if (isAdmin () || GODMODE) {
	$dropDown = new NavBarDropDown ( "Admin" );
	$dropDown->addItem ( new NavHeader ( "User" ) );
	$dropDown->addItem ( new NavBarItem ( "All User", PROJECT_ROOT . "/user/overview", "" ) );
	$dropDown->addItem ( new NavBarItem ( "New User", PROJECT_ROOT . "/user/newuser", "" ) );
	$dropDown->addItem ( $separator );
	$dropDown->addItem ( new NavHeader ( "Groups" ) );
	$dropDown->addItem ( new NavBarItem ( "All Groups", PROJECT_ROOT . "/group/overview", "" ) );
	$dropDown->addItem ( new NavBarItem ( "New Group", PROJECT_ROOT . "/group/create", "" ) );
	$dropDown->addItem ( $separator );
	$dropDown->addItem ( new NavHeader ( "Projects" ) );
	$dropDown->addItem ( new NavBarItem ( "All Projects", PROJECT_ROOT . "/project/overview", "" ) );
	$dropDown->addItem ( new NavBarItem ( "New Project", PROJECT_ROOT . "/project/create", "" ) );
	$dropDown->addItem ( $separator );
	$dropDown->addItem ( new NavBarItem ( "Settings", PROJECT_ROOT . "/settings", "" ) );
	$nav->addItem ( $dropDown );
}

// LOGOUT
$nav->addItem ( new NavBarItem ( "Logout", PROJECT_ROOT . "/login/logout", "" ) );

function isAdmin() {

	global $db;
	global $self;
	
	return $db->isAdmin ( $self ["id"] );

}
?>