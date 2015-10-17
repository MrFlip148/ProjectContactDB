<?php

class CUser
{
	private $db;
	
	public function __construct($db)
	{
		$this->db = $db;
	}
	
	public function isAuthentic()
	{
		return isset($_SESSION['CDBuser_session']);
	}
	
	public function Login($acronym, $password)
	{
		$sql = 'SELECT * FROM CDB_USER WHERE acronym = ? AND password = md5(concat(?, salt))';
		
		$params = array($acronym,$password);
		
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);

		if(isset($res[0])) 
		{
			$_SESSION['CDBuser_session'] = $res[0];
		}
	}
	public function Logout()
	{
		unset($_SESSION['CDBuser_session']);
	}
	
	public function getUser()
	{
		return $_SESSION['CDBuser_session'];
	}
	public function getUserFromId($id)
	{
		$sql = 'SELECT * FROM CDB_USER WHERE id = ?';
		$params = array($id);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		return $res[0];
	}
	public function getAllUsers()
	{
		$sql = 'SELECT * FROM CDB_USER';
		$params = array();
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		return $res;
	}
	
	public function edit($firstname,$lastname,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email,$institute,$id)
	{
		$sql = '
			UPDATE CDB_USER SET
				first_name = ?,
				last_name = ?,
				adress1 = ?,
				adress2 = ?,
				postnr = ?,
				postadr = ?,
				telnr1 = ?,
				telnr2 = ?,
				email = ?,
				Institution = ?
			WHERE
				id = ?
		';
		$params = array($firstname,$lastname,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email,$institute,$id);
		$res = $this->db->ExecuteQuery($sql,$params);
		if($res)
		{
			$sql = 'SELECT * FROM CDB_USER WHERE id = ?';
			$params = array($id);
			$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);
			
			if(isset($res[0])) 
			{
				$_SESSION['CDBuser_session'] = $res[0];
			}
			return true;
		}
		else
		{
			return false;
		}
	}
	public function changePassword($password,$id)
	{
		$sql = '
			UPDATE CDB_USER SET
				password = md5(concat(?,salt))
			WHERE
				id = ?
		';
		$params = array($password,$id);
		$res = $this->db->ExecuteQuery($sql, $params);
		if($res)
		{
			$sql = 'SELECT * FROM CDB_USER WHERE id = ?';
			$params = array($id);
			$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);
			
			if(isset($res[0])) 
			{
				$_SESSION['CDBuser_session'] = $res[0];
			}
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function add($acronym)
	{
		$sql = 'INSERT INTO CDB_USER (acronym,salt) VALUES (?,unix_timestamp())';
		$params = array($acronym);
		$res = $this->db->ExecuteQuery($sql, $params);
		if($res)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function addPassword($password, $acronym)
	{
		$sql = '
			UPDATE CDB_USER SET
				password = md5(concat(?,salt))
			WHERE
				acronym = ?
		';
		$params = array($password, $acronym);
		$res = $this->db->ExecuteQuery($sql,$params);
		if($res)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function remove($id)
	{
		$sql = 'DELETE FROM CDB_USER WHERE id = ? LIMIT 1';
		$params = array($id);
		$res = $this->db->ExecuteQuery($sql,$params);
		if($res)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}