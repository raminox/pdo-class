<?php

namespace moofyme;

use \PDO;
use \PDOException;

class Database extends QueryBuilder
{
	protected $dbh;

	protected $table;

	protected function __construct()
	{
		try {
			$this->dbh = new PDO('mysql:host=localhost;dbname=github;', 'homestead', 'secret', array(

			));
		} catch (PDOException $e) {
			die($e->getMessage());
		}
		
	}

	/**
	 * Instantiates Databse class with table to select
	 * @param  string $name
	 * @return object
	 */
	public static function table($name)
	{
		return self::getInstance()->setTable($name);
	}

	/**
	 * Sets table to interact with
	 * @param string $name
	 */
	protected function setTable($name)
	{
		$this->table = $name;
		return $this;
	}
}
