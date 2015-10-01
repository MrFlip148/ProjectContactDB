<?php

class CUser
{

	public function IsLoggedIn()
	{
		$acronym = isset($_SESSION['CDB_USER_SESSION']) ? $_SESSION['CDB_USER_SESSION']->acronym : null;

		if($acronym) 
		{
			$output = "Du är inloggad som: $acronym ({$_SESSION['CDB_USER_SESSION']->name})";
			return $output;
		}
		else 
		{
			$output = "Du är INTE inloggad.";
			return $output;
		}
	}

    public function isAuthentic()
    {
        return isset($_SESSION['CDB_USER_SESSION']);
    }
    
	public function Login($database = array(), $user, $password)
	{
		$db = new CDatabase($database);
		$sql = "SELECT id, acronym, name, adress1, adress2, postnr, postadr, telnr1, telnr2, email, Institution, password FROM CDB_USER WHERE acronym = ? AND password = md5(concat(?, salt))";
		$res = $db->ExecuteSelectQueryAndFetchAll($sql, array($_POST['acronym'], $_POST['password']));

		if(isset($res[0])) 
		{
			$_SESSION['CDB_USER_SESSION'] = $res[0];
		}
		header('Location: index.php');
	}
   
	public function Logout()
	{
		unset($_SESSION['CDB_USER_SESSION']);
		header('Location: index.php');
	}
	
    public function editUser($database,$name,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email,$institute,$id)
	{
		$db = new CDatabase($database);
		$sql = '
			UPDATE CDB_USER SET
				name = ?,
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
        $params = array($name,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email,$institute,$id);
        $res = $db->ExecuteQuery($sql, $params);
        if($res)
		{
			$sql = "SELECT id, acronym, name, adress1, adress2, postnr, postadr, telnr1, telnr2, email, Institution, password FROM CDB_USER WHERE id = ?";
			$res = $db->ExecuteSelectQueryAndFetchAll($sql, array($id));

			if(isset($res[0])) 
			{
				$_SESSION['CDB_USER_SESSION'] = $res[0];
			}
			header('Location: index.php');
			return true;
		}
        else
		{
			return false;
        }
	}
	
	public function changePassword($database, $password, $id)
	{
		$db = new CDatabase($database);
		$sql = '
			UPDATE CDB_USER SET
				password = md5(concat(?,salt))
			WHERE
				id = ?
			';
		$params = array($password, $id);
		$res = $db->ExecuteQuery($sql, $params);
		if($res)
		{
			$sql = "SELECT id, acronym, name, adress1, adress2, postnr, postadr, telnr1, telnr2, email, Institution, password FROM CDB_USER WHERE id = ?";
			$res = $db->ExecuteSelectQueryAndFetchAll($sql, array($id));

			if(isset($res[0])) 
			{
				$_SESSION['CDB_USER_SESSION'] = $res[0];
			}
			header('Location: index.php');
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function newUserUpdatePassword($database, $password, $acronym)
	{
		$db = new CDatabase($database);
		$sql = '
			UPDATE CDB_USER SET
				password = md5(concat(?,salt))
			WHERE
				acronym = ?
			';
		$params = array($password, $acronym);
		$res = $db->ExecuteQuery($sql, $params);
		if($res)
		{
			header('Location: index.php');
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function newUser($database, $acronym)
	{
		$db = new CDatabase($database);
		$sql = 'INSERT INTO CDB_USER (acronym,salt) VALUES (?,unix_timestamp())';
		$params = array($acronym);
		$res = $db->ExecuteQuery($sql, $params);
		if($res)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function removeUser($database, $id)
	{
		$db = new CDatabase($database);
		$sql = 'DELETE FROM CDB_USER WHERE id = ? LIMIT 1';
		$res = $db->ExecuteQuery($sql, array($id));
		if($res)
		{
			header('Location: userList.php');
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getAllUsers($database)
	{
		$db = new CDatabase($database);
		$sql = 'SELECT id, acronym, name, adress1, adress2, postnr, postadr, telnr1, telnr2, email, Institution, password FROM CDB_USER';
		$res = $db->ExecuteSelectQueryAndFetchAll($sql);
		
		return $res;
	}
	
	public function getFullUserFromID($database, $id)
	{
		$db = new CDatabase($database);
		$sql = 'SELECT * FROM CDB_USER WHERE id = ?';
		$res = $db->ExecuteSelectQueryAndFetchAll($sql, array($id));

		return $res[0];
	}

	public function getUserId()
	{
		$id = $_SESSION['CDB_USER_SESSION']->id;
		return $id;
	}
	public function getUserName()
	{
		$name = $_SESSION['CDB_USER_SESSION']->name;
		return $name;
	}
	public function getUserAdress1()
	{
		$adress1 = $_SESSION['CDB_USER_SESSION']->adress1;
		return $adress1;
	}
	public function getUserAdress2()
	{
		$adress2 = $_SESSION['CDB_USER_SESSION']->adress2;
		return $adress2;
	}
	public function getUserPostnr()
	{
		$postnr = $_SESSION['CDB_USER_SESSION']->postnr;
		return $postnr;
	}
	public function getUserPostadr()
	{
		$postadr = $_SESSION['CDB_USER_SESSION']->postadr;
		return $postadr;
	}
	public function getUserTelnr1()
	{
		$telnr1 = $_SESSION['CDB_USER_SESSION']->telnr1;
		return $telnr1;
	}
	public function getUserTelnr2()
	{
		$telnr2 = $_SESSION['CDB_USER_SESSION']->telnr2;
		return $telnr2;
	}
	public function getUserEmail()
	{
		$email = $_SESSION['CDB_USER_SESSION']->email;
		return $email;
	}
	public function getUserPassword()
	{
		$password = $_SESSION['CDB_USER_SESSION']->password;
		return $password;
	}
	public function getUserAcronym()
	{
		$acronym = $_SESSION['CDB_USER_SESSION']->acronym;
		return $acronym;
	}
	public function getUserInst()
	{
		$institute = $_SESSION['CDB_USER_SESSION']->Institution;
		return $institute;
	}
}