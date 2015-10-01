<?php

class CContact
{
	private $db;
	
	public function __construct($db)
	{
		$this->db = $db;
	}
	
	public function getContacts()
	{
		$sql = "SELECT * FROM contact";
		
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql);
		
		return($res);
	}

	public function getContactFromId($id)
	{
		$sql = "SELECT * FROM contact WHERE id = ?";
		
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($id));
		
		return($res[0]);
	}
	
	public function getContactNameFromId($id)
	{
		$sql = "SELECT name FROM contact WHERE id = ?";
		
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($id));
		
		return($res);
	}
	
	public function getCompanyFromName($name)
	{
		$sql = "SELECT company FROM contact WHERE name = ?";
		
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($name));
		
		return($res[0]);
	}
	
	public function add($name,$company,$position,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email)
	{
		$sql = '
			INSERT INTO contact (name,company,position,adress1,adress2,postnr,postadr,telnr1,telnr2,email)
			VALUES (?,?,?,?,?,?,?,?,?,?)';
		$params = array($name,$company,$position,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email);
		$res = $this->db->ExecuteQuery($sql, $params);
		
		if($res)
		{
			header('Location: contacts.php');
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
		$res = $this->db->ExecuteQuery($sql, array($id));
		
		if($res)
		{
			header('Location: contacts.php');
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function edit($name,$company,$position,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email,$id)
	{
		$sql = '
			UPDATE contact SET
				name = ?,
				company = ?,
				position = ?,
				adress1 = ?,
				adress2 = ?,
				postnr = ?,
				postadr = ?,
				telnr1 = ?,
				telnr2 = ?,
				email = ?
			WHERE
				id = ?
		';
		$params = array($name,$company,$position,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email,$id);
		$res = $this->db->ExecuteQuery($sql, $params);
		
		if($res)
		{
			header('Location: contacts.php');
			return true;
		}
		else
		{
			return false;
		}		
	}
	
}