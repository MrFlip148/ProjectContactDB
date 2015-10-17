<?php

class CContact
{
	private $db;
	
	public function __construct($db)
	{
		$this->db = $db;
	}
	
	public function getAll()
	{
		$sql = 'SELECT c.*, c.id AS cID, co.cname FROM contact AS c, company AS co
				WHERE c.company = co.id
				ORDER BY cname,last_name,first_name';
		$params = array(null);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		return($res);
	}
	public function getCompany()
	{
		$sql = 'SELECT DISTINCT co.cname AS cname, c.company AS id
				FROM company AS co, contact AS c
				WHERE co.id = c.company';
		$params = array(null);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		return($res);
	}
	public function getAllCompanies()
	{
		$sql = 'SELECT * FROM company';
		$params = array(null);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		return($res);
	}
	public function getCompanyNameFromId($id)
	{
		$sql = 'SELECT cname FROM company WHERE id = ?';
		$params = array($id);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		return($res[0]);
	}
	public function getCompanyFromName($cname)
	{
		$sql = 'SELECT id FROM company WHERE cname = ?';
		$params = array($cname);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		return($res[0]);
	}
	public function getCompanyIdFromContactId($id)
	{
		$sql = '
			SELECT co.id AS coID FROM company AS co
			INNER JOIN contact AS c
			WHERE c.company = co.id AND c.id = 5
		';
		$params = array($id);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		return($res[0]);
	}
	public function getAllFromCompanyId($id)
	{
		$sql = 'SELECT * FROM contact WHERE company = ?';
		$params = array($id);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		if($res)
		{
			return($res);
		}
		else
		{
			return false;
		}
	}

	public function getInfoFromId($id)
	{
		$sql = 'SELECT * FROM contact AS c
				INNER JOIN company AS co
				WHERE c.company = co.id AND c.id = ?';
		$params = array($id);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql,$params);
		
		if($res)
		{
			return($res[0]);
		}
		else
		{
			return false;
		}
	}
	
	public function add($last_name,$first_name,$company,$pos,$adress1,$adress2,$postnr,$postadr,$telnr,$dirnr,$mobilnr,$email,$add)
	{
		$sql = 'INSERT INTO contact (last_name,first_name,company,position,adress1,adress2,postnr,postadr,telnr,telnrDirect,mobilnr,email,acronymAdd) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
		$params = array($last_name,$first_name,$company,$pos,$adress1,$adress2,$postnr,$postadr,$telnr,$dirnr,$mobilnr,$email,$add);
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
		$sql = 'DELETE FROM contact WHERE id = ?';
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
	
	public function edit($last_name,$first_name,$company,$position,$adress1,$adress2,$postnr,$postadr,$telnr,$dirNr,$mobilnr,$email,$id)
	{
		$sql = '
			UPDATE contact SET
				last_name = ?,
				first_name = ?,
				company = ?,
				position = ?,
				adress1 = ?,
				adress2 = ?,
				postnr = ?,
				postadr = ?,
				telnr = ?,
				telnrDirect = ?,
				mobilnr = ?,
				email = ?
			WHERE
				id = ?
		';
		$params = array($last_name,$first_name,$company,$position,$adress1,$adress2,$postnr,$postadr,$telnr,$dirNr,$mobilnr,$email,$id);
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