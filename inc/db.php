<?php

/**
 * 
 */
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "survey_db");

class Database
{
	private $con;

	public function connect()
	{
		$this->con = new Mysqli(HOST, USER, PASS, DB);
		if ($this->con) {
			return $this->con;
		}
		return "DATABASE_CONNECTION_FAIL";
	}
}

//$db = new Database();
//$db->connect();
