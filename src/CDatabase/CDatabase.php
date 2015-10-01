<?php
class CDatabase
{
 
	/**
	 * Private Members
	 */
	private $options; // Options used when creating the PDO object
	private $db = null; // The PDO object
	private $stmt = null;
	private static $numQueries = 0;
	private static $queries = array();
	private static $params = array();
	
	/**
	 * Public Members
	 */
	
	public function __construct($options)
	{
		$default = array(
			'dsn' => null,
			'username' => null,
			'password' => null,
			'driver_options' => null,
			'fetch_style' => PDO::FETCH_OBJ,
		);
		$this->options = array_merge($default, $options);

		try
		{
		$this->db = new PDO($this->options['dsn'], $this->options['username'], $this->options['password'], $this->options['driver_options']);
		}
		catch(Exception $e)
		{//throw $e; // For debug purpose, shows all connection details
		throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
		}
		
		$this->db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->options['fetch_style']); 
	}
	
	public function ExecuteSelectQueryAndFetchAll($query, $params=array(), $debug=false)
	{
		self::$queries[] = $query; 
		self::$params[]	= $params; 
		self::$numQueries++;
 
		if($debug)
		{
			echo "<p>Query = <br/><pre>{$query}</pre></p><p>Num query = " . self::$numQueries . "</p><p><pre>".print_r($params, 1)."</pre></p>";
		}
		$this->stmt = $this->db->prepare($query);
		$this->stmt->execute($params);
		return $this->stmt->fetchAll();
	}
	
	public function ExecuteQuery($query, $params = array(), $debug=false)
	{
 
		self::$queries[] = $query; 
		self::$params[]	= $params; 
		self::$numQueries++;
 
		if($debug)
		{
			echo "<p>Query = <br/><pre>{$query}</pre></p><p>Num query = " . self::$numQueries . "</p><p><pre>".print_r($params, 1)."</pre></p>";
		}
 
		$this->stmt = $this->db->prepare($query);
		return $this->stmt->execute($params);
	}
	
	public function SaveDebug($debug=null)
	{
		if($debug)
		{
			self::$queries[] = $debug;
			self::$params[] = null;
		}
 
		self::$queries[] = 'Saved debuginformation to session.';
		self::$params[] = null;
 
		$_SESSION['Con_CDB']['numQueries'] = self::$numQueries;
		$_SESSION['Con_CDB']['queries'] = self::$queries;
		$_SESSION['Con_CDB']['params'] = self::$params;
	}
	
	public function LastInsertId()
	{
		return $this->db->lastInsertid();
	}
	
	public function Dump()
	{
		$html	= '<p><i>You have made ' . self::$numQueries . ' database queries.</i></p><pre>';
		foreach(self::$queries as $key => $val)
		{
			$params = empty(self::$params[$key]) ? null : htmlentities(print_r(self::$params[$key], 1)) . '<br/></br>';
			$html .= $val . '<br/></br>' . $params;
		}
		return $html . '</pre>';
	}
	
		public function RowCount() {
		return is_null($this->stmt) ? 0 : $this->stmt->rowCount();
	}

	public function ErrorCode() {
		return $this->stmt->errorCode();
	}

	public function ErrorInfo() {
		return $this->stmt->errorInfo();
	}
}