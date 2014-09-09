<?php

	class Database {

		private $connection;

		function __construct () {
			
			$this->connection = mysql_connect(DB_HOST_NAME, DB_USER_NAME, DB_PASSWORD);
			$selectedDB = mysql_select_db(DB_NAME, $this->connection);
			// var_dump($selectedDB);

			if ($this->connection) {
				
				// echo 'mysql connected!';

				if (!$selectedDB) {
					
					// echo 'Could not select database!';
				}
			} else {

				// echo 'mysql did not connect!';
			}
		}

		public function ExecuteSqlQuery ($sql) {

			$result = mysql_query($sql, $this->connection);

			if ($result === false) {
				// TODO: Create an output function.
				$output = mysql_error();
				// echo $output;
				return false;

			} else {

				return $result;
			}
		}
	}

	$database = new Database();