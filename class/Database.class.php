<?php

/**
 * Controls database connection and operations
 *
 * @author Andre Beging
 *        
 */
class Database extends Mysqli {
	public function __construct() {
		parent::__construct ( DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT, NULL );
	}
	
	/**
	 * Get a single user by id from database
	 *
	 * @param int $userId
	 *        	User ID
	 * @return Array with user data
	 */
	public function getUser($userId) {
		$result = $this->processSelectQuery ( "SELECT * FROM `users` WHERE id = '{$userId}'" );
		
		if (count ( $result ) == 0) {
			return false;
		}
		
		return $result [0];
	}
	
	/**
	 * Checks if a user is admin
	 *
	 * @param int $userId        	
	 * @return boolean
	 */
	public function isAdmin($userId) {
		if ($this->getUserType ( $userId ) == 2) {
			return true;
		}
		return false;
	}
	
	/**
	 * Get group information by group id
	 *
	 * @param int $groupId        	
	 */
	public function getGroup($groupId) {
		$result = $this->processSelectQuery ( "SELECT * FROM `groups` WHERE id = '{$groupId}'" );
		
		if (count ( $result ) == 0) {
			return false;
		}
		
		return $result [0];
	}
	
	/**
	 * Get project information by group id
	 *
	 * @param int $projectId        	
	 */
	public function getProject($projectId) {
		$result = $this->processSelectQuery ( "SELECT * FROM `projects` WHERE id = '{$projectId}'" );
		
		if (count ( $result ) == 0) {
			return false;
		}
		
		return $result [0];
	}
	
	/**
	 * Returns the user type by user id
	 *
	 * @param int $userId        	
	 * @throws mysqli_sql_exception
	 * @return int userType
	 */
	public function getUserType($userId) {
		if (! $userId) {
			return null;
		}
		
		$query = "SELECT type FROM users WHERE id = {$userId}";
		$result = $this->query ( $query );
		
		$type = $result->fetch_array ( MYSQL_ASSOC );
		
		if (! $type ['type']) {
			throw new mysqli_sql_exception ( "User '{$userId}' not found" );
		}
		
		$type = $type ['type'];
		
		return $type;
	}
	
	/**
	 *
	 * @todo reduce return to hash
	 *      
	 *       Get a single users password hash by email
	 *      
	 * @param string $email
	 *        	E-Mail
	 * @return array Password Hash
	 */
	public function getHashByEMail($email) {
		$result = $this->processSelectQuery ( "SELECT id, email, salt, hash_password FROM `users` WHERE email = '{$email}'" );
		
		if (count ( $result ) == 0) {
			return false;
		}
		
		if (isset ( $result [0] ["salt"] )) {
			$result [0] ["salt"] = bin2hex ( $result [0] ["salt"] );
		}
		
		if (isset ( $result [0] ["hash_password"] )) {
			$result [0] ["hash_password"] = bin2hex ( $result [0] ["hash_password"] );
		}
		
		return $result [0];
	}
	
	/**
	 *
	 * @todo reduce return to challenge id
	 *      
	 *       Get the challenge ID of a session by user ID and session ID
	 *      
	 * @param string $sessionId
	 *        	Session ID
	 * @param int $userId
	 *        	User ID
	 * @return array Challenge ID
	 */
	public function getChallenge($sessionId, $userId) {
		$result = $this->processSelectQuery ( "
				SELECT HEX(challenge) as challenge FROM `sessions` WHERE HEX(id) = '{$sessionId}' AND `user_id` = '{$userId}' AND `authorized` = 1" );
		
		return $result;
	}
	
	/**
	 *
	 * @todo Disable users old sessions in database
	 *      
	 *       Insert a new session into session table
	 *      
	 * @param int $userId
	 *        	User ID
	 * @param string $sessionId
	 *        	Session ID
	 * @param string $challenge
	 *        	Challenge ID
	 */
	public function insertSession($userId, $sessionId, $challenge) {
		$this->processInsertQuery ( "UPDATE `sessions` SET `authorized` = 0 WHERE `user_id` = '{$userId}'" );
		
		$id = $this->processInsertQuery ( "
            INSERT INTO `sessions` 
                (
                `id`,
                `update_time`,
                `challenge`,
                `user_id`,
                `authorized`
                ) 
            VALUES
                (
                UNHEX('{$sessionId}'),
                CURRENT_TIMESTAMP,
                UNHEX('{$challenge}'),
                '{$userId}',
                '1'
                );" );
	}
	
	/**
	 * Updates the users name and type
	 *
	 * @param int $userId        	
	 * @param string $firstName        	
	 * @param string $lastName        	
	 * @param int $type        	
	 * @return mixed
	 */
	public function updateUserSettings($userId, $firstName, $lastName, $type) {
		$result = $this->processInsertQuery ( "UPDATE users SET lastname = '{$lastName}', firstname = '{$firstName}', type = '{$type}' WHERE id = {$userId};" );
		
		return $result;
	}
	
	/**
	 * Updates the groups name and description
	 *
	 * @param int $groupId        	
	 * @param string $name        	
	 * @param string $description        	
	 * @return mixed
	 */
	public function updateGroupSettings($groupId, $name, $description) {
		$result = $this->processInsertQuery ( "UPDATE groups SET name = '{$name}', description = '{$description}' WHERE id = {$groupId};" );
		
		return $result;
	}
	
	/**
	 * Updates the projects name and description
	 *
	 * @param int $projectId        	
	 * @param string $name        	
	 * @param string $description        	
	 * @return mixed
	 */
	public function updateProjectSettings($projectId, $name, $description) {
		$result = $this->processInsertQuery ( "UPDATE projects SET name = '{$name}', description = '{$description}' WHERE id = {$projectId};" );
		
		return $result;
	}
	
	/**
	 * Removes a user from database
	 *
	 * @param int $userId        	
	 * @return mixed
	 */
	public function deleteUser($userId) {
		$this->processInsertQuery ( "UPDATE `sessions` SET `user_id` = NULL WHERE user_id = {$userId};" );
		$this->processInsertQuery ( "DELETE FROM `users_groups` WHERE `user_id` = {$userId}" );
		$this->processInsertQuery ( "DELETE FROM `users` WHERE `id` = {$userId}" );
	}
	
	/**
	 * Removes a user from a group
	 *
	 * @param int $groupId        	
	 * @param int $userId        	
	 * @return mixed
	 */
	public function removeUserFromGroup($groupId, $userId) {
		$result = $this->processInsertQuery ( "DELETE FROM users_groups WHERE user_id = {$userId} AND group_id = {$groupId}" );
		
		return $result;
	}
	
	/**
	 * Removes a project from a group
	 *
	 * @param int $groupId        	
	 * @param int $projectId        	
	 * @return mixed
	 */
	public function removeProjectFromGroup($groupId, $projectId) {
		$result = $this->processInsertQuery ( "DELETE FROM projects_groups WHERE project_id = {$projectId} AND group_id = {$groupId}" );
		
		return $result;
	}
	
	/**
	 * Deletes a group from the database
	 *
	 * @param int $groupId        	
	 * @return mixed
	 */
	public function deleteGroup($groupId) {
		$this->processInsertQuery ( "DELETE FROM `projects_groups` WHERE `group_id` = {$groupId}" );
		$this->processInsertQuery ( "DELETE FROM `users_groups` WHERE `group_id` = {$groupId}" );
		$result = $this->processInsertQuery ( "DELETE FROM groups WHERE id = {$groupId};" );
		
		return $result;
	}
	
	/**
	 * Deletes a project from the database
	 *
	 * @param int $projectId        	
	 * @return mixed
	 */
	public function deleteProject($projectId) {
		$this->processInsertQuery ( "DELETE FROM experiments WHERE project_id = {$projectId};" );
		
		$this->processInsertQuery ( "DELETE FROM projects_groups WHERE project_id = {$projectId};" );
		
		$this->processInsertQuery ( "DELETE FROM projects WHERE id = {$projectId};" );
	}
	
	/**
	 * Adds a user to a group
	 *
	 * @param int $groupId        	
	 * @param int $userId        	
	 */
	public function addUserToGroup($groupId, $userId) {
		$query = "
				INSERT INTO users_groups (id, user_id, group_id, dateInOut, status)
				VALUES (NULL, '{$userId}', '{$groupId}', CURRENT_TIMESTAMP, '1');
				";
		
		if ($stmt = $this->prepare ( $query )) {
			$stmt->execute ();
			
			if ($this->error == '') {
				return $stmt->insert_id;
			} else {
				return $this->error;
			}
		}
	}
	
	/**
	 * Adds a project to a group
	 *
	 * @param int $groupId        	
	 * @param int $projectId        	
	 */
	public function addProjectToGroup($groupId, $projectId) {
		$query = "
		INSERT INTO projects_groups (id, project_id, group_id, create_date)
		VALUES (NULL, '{$projectId}', '{$groupId}', CURRENT_TIMESTAMP);
		";
		
		if ($stmt = $this->prepare ( $query )) {
			$stmt->execute ();
			
			if ($this->error == '') {
				return $stmt->insert_id;
			} else {
				return $this->error;
			}
		}
	}
	
	/**
	 * Changes the password of an existing user
	 *
	 * @param int $userId
	 *        	User ID
	 * @param string $password
	 *        	Password hash
	 * @param string $salt
	 *        	Salt
	 * @return mixed
	 */
	public function updatePassword($userId, $password, $salt) {
		if (strlen ( $password ) != 64) {
			return false;
		}
		
		$password = hex2bin ( $password );
		$salt = hex2bin ( $salt );
		
		$password = $this->real_escape_string ( $password );
		$salt = $this->real_escape_string ( $salt );
		
		$result = $this->processInsertQuery ( "UPDATE users SET hash_password = '{$password}', salt = '{$salt}' WHERE id = {$userId};" );
		
		if ($result === 0) {
			return true;
		} elseif ($result == false || $result == null) {
			
			return false;
		}
		return true;
	}
	public function verifyPassword($email, $password) {
		return 0;
	}
	
	/**
	 * Get all users
	 *
	 * @param int $limit
	 *        	Limit users in response
	 * @return array User list
	 */
	public function getUsers($limit = null) {
		$query = "SELECT * FROM users LIMIT {$limit}";
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Gets users that are not member of the given group
	 *
	 * @param int $groupId        	
	 * @return multitype:
	 */
	public function getUsersNotInGroup($groupId) {
		$query = "
			SELECT *
			FROM users
			WHERE id NOT IN (
				SELECT user_id
				FROM users_groups
				WHERE group_id = {$groupId}
			)
				";
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Gets projects that are not assigned with the given group
	 *
	 * @param int $groupId        	
	 * @return multitype:
	 */
	public function projectsNotInGroup($groupId) {
		$query = "
		SELECT *
		FROM projects
		WHERE id NOT IN (
		SELECT project_id
		FROM projects_groups
		WHERE group_id = {$groupId}
		)
		";
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Gets all groups including numbers of assigned users and projects
	 *
	 * @return multitype:
	 */
	public function getGroups() {
		$query = "
			SELECT g.id, g.name, g.description, g.create_date, COALESCE(projects,0) AS projects, COALESCE(users,0) AS users FROM groups g
			LEFT JOIN (
			    SELECT COUNT(*) as projects, group_id as id
			    FROM groups g
				INNER JOIN projects_groups pg 
			    ON pg.group_id = g.id
				GROUP BY g.id) ppg
			ON ppg.id = g.id
			LEFT JOIN (
			    SELECT COUNT(*) as users, group_id as id
			    FROM groups g
				INNER JOIN users_groups ug
			    ON ug.group_id = g.id
				GROUP BY g.id) upg
			ON upg.id = g.id
				";
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Get experiments by a given project id
	 *
	 * @param int $projectId        	
	 * @return Ambigous <multitype:, multitype:>
	 */
	public function getExperiments($projectId, $userId = 0) {
		$experiments = $this->processSelectQuery ( "
			SELECT ex.id, ex.name, ex.description, ex.create_date, COALESCE(en.entries,0) AS entries, COALESCE(enme.entries,0) AS entries_me
			FROM `experiments` ex
			LEFT JOIN (SELECT expr_id, count(*) entries FROM `entries` GROUP BY `expr_id`) en ON en.expr_id = ex.id
			LEFT JOIN (SELECT expr_id, count(*) entries FROM `entries` WHERE `user_id` = '{$userId}' GROUP BY `expr_id`) enme ON enme.expr_id = ex.id
			WHERE `project_id` = '{$projectId}'" );
		
		return $experiments;
	}
	
	/**
	 * Get entries by experiment id
	 *
	 * @param int $experimentId        	
	 * @return Ambigous <multitype:, multitype:>
	 */
	public function getEntries($experimentId) {
		$entries = $this->processSelectQuery ( "
			SELECT en.id, en.title, en.attachment, en.attachment_type, u.firstname, u.lastname, en.date
			FROM  `entries` en
			INNER JOIN `users` u ON u.id = en.user_id
			WHERE expr_id = '{$experimentId}'
			ORDER BY `date` DESC" );
		
		return $entries;
	}
	
	/**
	 * Create entry
	 *
	 * TODO Restrict query to experiments the user has rights to
	 *
	 * @param int $entryType        	
	 * @param int $experimentId        	
	 * @param int $userId        	
	 * @param string $entryTitle        	
	 * @param string $entryAttachment        	
	 * @return boolean
	 */
	public function createEntry($entryType, $experimentId, $userId, $entryTitle, $entryAttachment) {
		global $helper;
		
		$query = "
			INSERT INTO `entries` (`id`, `title`, `date`, `date_user`, `attachment`, `attachment_type`, `user_id`, `expr_id`, `current_time`)
				VALUES (
					NULL,
					'{$entryTitle}',
					'{$helper->now()}',
					'{$helper->now()}',
					'{$entryAttachment}',
					'{$entryType}',
					'{$userId}',
					'{$experimentId}',
					'{$helper->now()}'
				);";
		
		$result = $this->processInsertQuery ( $query );
		
		return $result;
	}
	
	/**
	 * Get experiment Information
	 *
	 * @param int $experimentId        	
	 * @return Ambigous <>
	 */
	public function getExperiment($experimentId) {
		$experiment = $this->processSelectQuery ( "
			SELECT ex.id, ex.name, ex.description, ex.create_date, ex.project_id, p.name as project_name FROM `experiments` ex
			INNER JOIN `projects` p ON p.id = ex.project_id
			WHERE ex.id = {$experimentId}" );
		
		return $experiment [0];
	}
	
	/**
	 * Get all experiments a user can access
	 *
	 * @param int $userId        	
	 * @param int $excludeExperiment        	
	 * @return Ambigous <multitype:, multitype:>
	 */
	public function getUserExperiments($userId, $excludeExperiment = 0) {
		$experiments = $this->processSelectQuery ( "
			SELECT ex.id, ex.name experiment_name, p.name project_name
			FROM  `groups` g
			INNER JOIN  `users_groups` ug ON ug.group_id = g.id
			INNER JOIN  `projects_groups` pg ON pg.group_id = g.id
			INNER JOIN `projects` p ON p.id = pg.project_id
			INNER JOIN  `experiments` ex ON ex.project_id = pg.project_id
			WHERE ug.user_id = '{$userId}' AND ex.id != '{$excludeExperiment}'	
		" );
		
		return $experiments;
	}
	
	/**
	 * Checks if a user can access a certain experiment
	 *
	 * @param int $userId        	
	 * @param int $experimentId        	
	 * @return boolean
	 */
	public function canAccessExperiment($userId, $experimentId) {
		$canAccess = $this->processSelectQuery ( "
			SELECT count(*) as count
			FROM `users` u
			INNER JOIN `users_groups` ug ON ug.user_id = u.id
			INNER JOIN `projects_groups` pg ON pg.group_id = ug.group_id
			INNER JOIN `projects` p ON p.id = pg.project_id
			INNER JOIN `experiments` ex ON ex.project_id = p.id
			WHERE u.id = '{$userId}' AND ex.id = '{$experimentId}'		
		" );
		
		return ($canAccess [0] ["count"] >= 1);
	}
	
	/**
	 * Delete experiment and move its entries to another experiment
	 *
	 * @param int $experimentId        	
	 * @param int $moveEntriesTo        	
	 */
	public function deleteExperiment($experimentId, $moveEntriesTo) {
		$this->processInsertQuery ( "UPDATE entries SET expr_id = '{$moveEntriesTo}' WHERE expr_id = {$experimentId};" );
		$this->processInsertQuery ( "DELETE FROM `experiments` WHERE `id` = '{$experimentId}'" );
	}
	
	/**
	 * Create an experiment
	 *
	 * @param int $projectId        	
	 * @param string $experimentName        	
	 * @param string $experimentDescription        	
	 * @return boolean
	 */
	public function createExperiment($projectId, $experimentName, $experimentDescription) {
		$result = $this->processInsertQuery ( "
			INSERT INTO `experiments` (`id`, `name`, `description`, `project_id`, `create_date`)
				VALUES (NULL, '{$experimentName}', '{$experimentDescription}', '{$projectId}', CURRENT_TIMESTAMP);
		" );
		
		return $result;
	}
	
	/**
	 * Gets all projects
	 *
	 * @return multitype:
	 */
	public function getProjects() {
		$query = "
			SELECT p.id, p.name, p.description, p.create_date, COALESCE(groups,0) AS groups, COALESCE(e.experiments,0) AS experiments FROM projects p
			LEFT JOIN (
				SELECT COUNT(*) as groups, project_id as id
				FROM projects p
				INNER JOIN projects_groups pg
				ON pg.project_id = p.id
				GROUP BY p.id) gpg
			ON gpg.id = p.id
			LEFT JOIN (
                SELECT `project_id`, count(*) `experiments`
                FROM `experiments`
				GROUP BY `project_id`) e
			ON e.project_id = p.id
				";
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Gets users that are member of the given group
	 *
	 * @param int $groupId        	
	 * @return multitype:
	 */
	public function getUsersByGroup($groupId) {
		$query = "
			SELECT DISTINCT(u.id) as id, u.firstname, u.lastname, u.email
			FROM users_groups ug
			INNER JOIN users u ON ug.user_id = u.id
			WHERE ug.group_id = {$groupId}
				";
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Gets groups that are assigned with the given project
	 *
	 * @param int $projectId        	
	 * @return multitype:
	 */
	public function getGroupsByProject($projectId) {
		$query = "
		SELECT DISTINCT(g.id) as id, g.name, g.description
		FROM projects_groups pg
		INNER JOIN groups g ON g.id = pg.group_id
		WHERE pg.project_id = {$projectId}
		";
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Gets the groups that the given user is member of
	 *
	 * @param int $userId        	
	 * @return multitype:
	 */
	public function getGroupsByUser($userId) {
		$query = "
			SELECT DISTINCT(group_id) as id, name, description 
			FROM users_groups ug
			INNER JOIN groups g 
			ON g.id = ug.group_id
			WHERE user_id = {$userId}
		";
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Gets the projects assigned with the given group
	 *
	 * @param int $projectId        	
	 * @return multitype:
	 */
	public function getProjectsByGroup($groupId) {
		$query = "
			SELECT DISTINCT(p.id) as id, p.name, p.description
			FROM projects_groups pg
			INNER JOIN projects p ON p.id = pg.project_id
			WHERE pg.group_id = {$groupId}
		";
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Gets project that the given user is assigned with (via group)
	 *
	 * @param int $userId        	
	 * @return multitype: TODO hier scheint nicht alles so zu funktionieren, wie es sollte
	 */
	public function getProjectsByUser($userId) {
		$query = "
			SELECT p.id, p.name, p.description, p.create_date, COALESCE(e.experiments,0) AS experiments
			FROM projects p
			LEFT JOIN (
                SELECT project_id, count(*) experiments
                FROM experiments
            	GROUP BY project_id) e
			ON e.project_id = p.id
			WHERE p.id IN (
				SELECT project_id
				FROM projects_groups
				WHERE group_id IN (
					SELECT group_id
					FROM users_groups
					WHERE user_id = {$userId}
				)
			)
		";
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Create a new group
	 *
	 * @param string $name        	
	 * @param string $description        	
	 */
	public function createGroup($name, $description) {
		$query = "
			INSERT INTO `groups` (`id`, `name`, `description`, `create_date`)
				VALUES (NULL, '{$name}', '{$description}', CURRENT_TIMESTAMP);
		";
		
		if ($stmt = $this->prepare ( $query )) {
			$stmt->execute ();
			
			if ($this->error == '') {
				return $stmt->insert_id;
			} else {
				return $this->error;
			}
		}
	}
	
	/**
	 * Create a new project
	 *
	 * @param string $name        	
	 * @param string $description        	
	 */
	public function createProject($name, $description) {
		$query = "
		INSERT INTO `projects` (`id`, `name`, `description`, `create_date`)
		VALUES (NULL, '{$name}', '{$description}', CURRENT_TIMESTAMP);
		";
		
		if ($stmt = $this->prepare ( $query )) {
			$stmt->execute ();
			
			if ($this->error == '') {
				return $stmt->insert_id;
			} else {
				return $this->error;
			}
		}
	}
	
	/**
	 * Creates a new user
	 *
	 * @param string $firstname
	 *        	First name
	 * @param string $lastname
	 *        	Last name
	 * @param string $profile_image
	 *        	Profile Image
	 * @param int $type
	 *        	User type
	 * @param string $email
	 *        	E-Mail
	 * @param string $salt
	 *        	Salt
	 * @param string $hash
	 *        	Password hash
	 */
	public function createUser($firstname, $lastname, $profile_image = "path", $type, $email, $salt, $hash) {
		$salt = hex2bin ( $salt );
		$hash = hex2bin ( $hash );
		
		$query = "
        INSERT INTO `users` (
            `lastname`,
            `firstname`,
            `profil_image`,
            `create_date`,
            `type`,
            `email`,
            `salt`,
            `hash_password`)
        VALUES (
            '{$lastname}',
            '{$firstname}',
            '{$profile_image}',
            CURRENT_TIMESTAMP,
            '{$type}',
            '{$email}',
            '{$salt}',
            '{$hash}'
        );
        ";
		
		if ($stmt = $this->prepare ( $query )) {
			$stmt->execute ();
			
			if ($this->error == '') {
				return $stmt->insert_id;
			} else {
				return $this->error;
			}
		}
	}
	
	/**
	 * Collect search results from the single search methods
	 *
	 * @param string $searchTerm        	
	 * @return multitype:multitype:
	 */
	public function performSearch($searchTerm) {
		$searchResults = array ();
		
		$searchProjects = $this->searchProjects ( $searchTerm );
		$searchResults ["projects"] = $searchProjects;
		
		$searchEntries = $this->searchEntries ( $searchTerm );
		$searchResults ["entries"] = $searchEntries;
		
		return $searchResults;
	}
	
	/**
	 * Get entries by a search term, searching in entry title and attachment
	 *
	 * @param string $searchTerm        	
	 * @return multitype:
	 */
	private function searchEntries($searchTerm) {
		$query = "
			SELECT * 
			FROM entries
			WHERE `title` LIKE  '%{$searchTerm}%'
			OR `attachment` LIKE  '%{$searchTerm}%'";
		
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Get projects by a search term, searching in project name and description
	 *
	 * @param string $searchTerm        	
	 * @return multitype:
	 */
	private function searchProjects($searchTerm) {
		$query = "
			SELECT * FROM projects
			WHERE `name` LIKE '%{$searchTerm}%'
			OR `description` LIKE '%{$searchTerm}%'";
		
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
	
	/**
	 * Generic function to process insert and update queries
	 *
	 * @param string $query        	
	 * @return boolean
	 */
	public function processInsertQuery($query) {
		if ($stmt = $this->prepare ( $query )) {
			$stmt->execute ();
			
			if ($this->error == '') {
				return $stmt->insert_id;
			} else {
				return $this->error;
			}
		}
		return false;
	}
	
	/**
	 * Generic function to process select queries
	 *
	 * @param string $query        	
	 * @return multitype:
	 */
	private function processSelectQuery($query) {
		$result = $this->query ( $query );
		$tmpresult = array ();
		
		while ( $row = $result->fetch_array ( MYSQL_ASSOC ) ) {
			array_push ( $tmpresult, $row );
		}
		
		return $tmpresult;
	}
}

?>