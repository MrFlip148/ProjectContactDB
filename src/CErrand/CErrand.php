<?php

class CErrand
{
	private $db;
	
	public function __construct($db)
	{
		$this->db = $db;
	}
	public function getAll()
	{
		$sql = '
			SELECT e.*, c.last_name, c.first_name, c.id AS cID, co.cname
			FROM errands AS e, contact AS c, company AS co
			WHERE e.id_Contacts = c.id AND c.company = co.id
		';
		$params = array(null);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		return($res);
	}
	
	public function getErrandFromCompanyId($id)
	{
		$sql='
			SELECT e.*, c.last_name, c.first_name, c.id AS cID FROM errands AS e, contact AS c
			WHERE id_Contacts = c.id AND c.company = ?		
		';
		$params = array($id);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		if($res)
		{
			return ($res);
		}
		else
		{
			return false;
		}
	}
	public function getErrandFromSelfId($id)
	{
		$sql='
			SELECT e.*, c.last_name, c.first_name, co.cname
			FROM errands AS e, contact AS c, company AS co
			WHERE e.id = ? AND e.id_Contacts = c.id AND c.company = co.id
		';
		$params = array($id);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);

		if($res)
		{
			return ($res[0]);
		}
		else
		{
			return false;
		}
	}
	public function getErrandFromContactId($id)
	{
		$sql='
			SELECT e.* FROM errands AS e
			WHERE e.id_Contacts = ?;
		';
		$params = array($id);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);
		
		if($res)
		{
			return ($res);
		}
		else
		{
			return false;
		}
	}

	public function getUserErrands($acronym)
	{
		$sql = '
			SELECT * FROM errands WHERE createdBy = ?;
		';
		$params = array($acronym);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);
		
		if($res)
		{
			return ($res);
		}
		else
		{
			return false;
		}
	}
	
	public function add($type,$date_errand,$time_errand,$id_Contacts,$cretedBy,$content)
	{
		$sql = '
			INSERT INTO errands (type,date_errand,time_errand,id_Contacts,createdBy,content)
			VALUES (?,?,?,?,?,?)
		';
		$params = array($type,$date_errand,$time_errand,$id_Contacts,$cretedBy,$content);
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
		$sql = 'DELETE FROM errands WHERE id = ?';
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
	
	public function edit($type,$date_errand,$time_errand,$id_Contacts,$content,$id)
	{
		$sql = '
			UPDATE errands SET
				type = ?,
				date_errand = ?,
				time_errand = ?,
				id_Contacts = ?,
				content = ?,
				lastEdited = NOW()
			WHERE
				id = ?
		';
		$params = array($type,$date_errand,$time_errand,$id_Contacts,$content,$id);
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