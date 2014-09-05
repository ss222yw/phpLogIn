<?php

	class Database {

		private $connection;

		function __construct () {
			
			$this->connection = mysql_connect(DB_HOST_NAME, DB_USER_NAME, DB_PASSWORD);
			$selectedDB = mysql_select_db(DB_NAME, $this->connection);
			var_dump($selectedDB);

			if ($this->connection) {
				
				echo 'mysql connected!';

				if (!$selectedDB) {
					
					echo 'Could not select database!';
				}
			} else {

				echo 'mysql did not connect!';
			}
		}
	}

	$database = new Database();