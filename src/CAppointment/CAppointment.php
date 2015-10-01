<?php

class CAppointment
{
	private $db;
	
	public function __construct($db)
	{
		$this->db = $db;
	}
	
	public function getAppointments()
	{
		$sql = "SELECT * FROM `case`";
		
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql);
		
		return($res);
	}
	public function getAppointmentFromId($id)
	{
		$sql = "SELECT * FROM `case` WHERE id = ?";
		
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($id));
		
		return($res[0]);
	}
	
	public function getLatestCaseForRelContact($relContact)
	{
		$sql = "SELECT * FROM `case` WHERE relContact = ? ORDER BY dateOfCase, timeOfCase";

		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, array($relContact));
		
		if($res)
		{
			return($res[0]);
		}
		else
		{
			return false;
		}
	}
	
	public function add($type,$dateOfCase,$timeOfCase,$relContact,$relCompany,$createdBy,$content)
	{
		$sql = 'INSERT INTO `case` (type,dateOfCase,timeOfCase,relContact,relCompany,createdBy,content)
			VALUES (?,?,?,?,?,?,?)';
		$params = array($type,$dateOfCase,$timeOfCase,$relContact,$relCompany,$createdBy,$content);
		$res = $this->db->ExecuteQuery($sql, $params);
		if($res)
		{
			header('Location: appointments.php');
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function edit($type,$dateOfCase,$timeOfCase,$relContact,$relCompany,$createdBy,$content,$id)
	{
		$sql = '
			UPDATE `case` SET
				type = ?,
				dateOfCase = ?,
				timeOfCase = ?,
				relContact = ?,
				relCompany = ?,
				createdBy = ?,
				content = ?,
				lastEdited = NOW()
			WHERE
				id = ?
		';
		$params = array($type,$dateOfCase,$timeOfCase,$relContact,$relCompany,$createdBy,$content,$id);
		$res = $this->db->ExecuteQuery($sql, $params);
		if($res)
		{
			header('Location: appointments.php');
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function remove($id)
	{
		$sql = 'DELETE FROM `case` WHERE id = ?';
		$res = $this->db->ExecuteQuery($sql, array($id));
		
		if($res)
		{
			header('Location: appointments.php');
			return true;
		}
		else
		{
			return false;
		}
	}
}