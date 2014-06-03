<?php
class Database {
	// Settings
	private $host   = DB_HOST;
	private $user   = DB_USER;
	private $pass   = DB_PASS;
	private $dbname = DB_NAME;

	// DB
	private $pdo;
	private $error;

	// Queries
	private $stmt;

	/**
	 * Constructs database.
	 */
	public function __construct() {
		$source = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		$options = array(
		    PDO::ATTR_PERSISTENT => true,
		    PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
		);

		try {
			$this->pdo = new PDO($source, $this->user, $this->pass, $options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}
	}

	/**
	 * Prepare a query
	 * @param  string $query String to prepare.
	 * @return PDOStatement  Returned statement.
	 */
	public function query($query) {
		$this->stmt = $this->pdo->prepare($query);
	}

	/**
	 * Binds a value to a parameter 
	 * @param  string $param Placeholder value (ex: :name).
	 * @param  string $value Actual value to bind (ex: John Doe).
	 * @param  string $type  Datatype (integer, boolean, null or string).
	 * @return boolean       TRUE on success FALSE on failure.
	 */
	public function bind($param, $value, $type = null){
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
					break;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	/**
	 * Executes prepared statement.
	 * @return boolean TRUE on success FALSE on failure.
	 */
	public function execute() {
		return $this->stmt->execute();
	}

	/**
	 * Returns an array containing all of the result set rows.
	 * @param  string $style Fetch style (NUM, ASSOC, OBJ).
	 * @return array         Array containing all remaining rows.
	 */
	public function resultset($style) {
		$this->execute();
		return $this->stmt->fetchAll(constant("PDO::FETCH_{$style}"));
	}

	/**
	 * Fetches the next row from a result set.
	 * @param  string $style Fetch style (NUM, ASSOC, OBJ).
	 * @return string, int   Value of the fetch, if nothing return is FALSE.
	 */
	public function single($style) {
		$this->execute();
		return $this->stmt->fetch(constant("PDO::FETCH_{$style}"));
	}

	/**
	 * Returns the number of rows affected by the last SQL statement.
	 * @return int Returns the number of rows. 
	 */
	public function rowCount() {
		return $this->stmt->rowCount();
	}

	/**
	 * Returns the ID of the last inserted row or sequence value.
	 * @return string Returns string of last inserted id.
	 */
	public function lastInsertId() {
		return $this->pdo->lastInsertId();
	}

	/**
	 * Initiates a transaction.
	 * @return boolean Returns TRUE on success or FALSE on failure.
	 */
	public function beginTransaction() {
		return $this->pdo->beginTransaction();
	}

	/**
	 * Commits a transaction.
	 * @return boolean Returns TRUE on success or FALSE on failure.
	 */
	public function endTransaction() {
		return $this->pdo->commit();
	}

	/**
	 * Rolls back a transaction.
	 * @return boolean Returns TRUE on success or FALSE on failure.
	 */
	public function cancelTransaction() {
		return $this->pdo->rollBack();
	}

	/**
	 * Dump an SQL prepared command.
	 * @return NULL No value is returned.
	 */
	public function debugDumpParams() {
		return $this->stmt->debugDumpParams();
	}
}