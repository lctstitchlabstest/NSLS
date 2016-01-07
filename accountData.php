<?php
include_once($IDDir . "DBConn.php");
//  PHP 5 version
class accountData extends DBConn {
    private static $NSLS_Database = 'NSLS';  //  This is set when an object to this class is instantiated and is passed in whenever a database call is made
                                                 //   This database value assignment Needs to be in here
    function __construct()  {
	  $not_returned = DBConn::SingleDB(accountData::$NSLS_Database);	
	}   //   This instantiation is necessary for setting the Singleton for each accountData object
	
	function find_account($id){
		$dbh = DBConn::SingleDB(accountData::$NSLS_Database);
		$sql="select `id`, MAX(recordtime) as Latest from `account` where `id`=".$id." LIMIT 1";

		$sthselect = $dbh->PrepareSQL($sql);
		$dbh->ExecuteSQL($sthselect, array());

		if(!($results = $dbh->GetSQLResultSet($sthselect)))
			$results = "could not retrieve record";
        //echo "      \n       " . $sql . "      \n       ";

		return $results;  
	}
 
	public function get_accounts($sql = '') {
		$dbh = DBConn::SingleDB(accountData::$NSLS_Database);
		
		$sql = "
			SELECT * 
			  FROM account" . $sql . "";
			  
		$sthselect = $dbh->PrepareSQL($sql);
		$dbh->ExecuteSQL($sthselect, array());

		if(!($results = $dbh->GetAllSQLResults($sthselect)))
			$results = "could not retrieve records";
        //echo "      \n       " . $sql . "      \n       ";

		return $results;  

	}


	public static function delete_accounts($sql = '') {
		//  This is NOT completely implemented and not used
		$dbh = DBConn::SingleDB(accountData::$NSLS_Database);
		
		$sql = "
			DELETE 
			  FROM account" . $sql . "";
			  
		$sthselect = $dbh->PrepareSQL($sql);
		$dbh->ExecuteSQL($sthselect, array());

		if(!($results = $dbh->GetSQLResultSet($sthselect)))
			$results = "could not delete records";
        //echo "      \n       " . $sql . "      \n       ";

		return $results;  

	}
	
		public static function add_accounts($account)
	{ //  This is used in both Parts I and II
	  //	$piece1 = '(';
			$insertPiece .= ' (name, email) VALUES (?, ?)';
			echo " \n ";
			//  print_r($_POST);  The post fields are available here possibly because the code files are all together
			echo " \n ";
            $insert[] = addslashes($account->get_name());
            $insert[] = addslashes($account->get_email());
			//$piece1 = implode( "',")
			//$insertPiece = $piece1 . $piece2;
			
			$dbh = DBConn::SingleDB(accountData::$NSLS_Database);
			
			$sql = " INSERT INTO account" .  $insertPiece."";
			
			$sthselect = $dbh->PrepareSQL($sql);
			$dbh->ExecuteSQL($sthselect, $insert);
			$recordID = $dbh->LastInsertId();
			if(!(empty($recordID)))
				$results = "ID:  " . $recordID . PHP_EOL . "One record for accounts has been successfully inserted.";
			else
				$results = false;     // "could not insert account record";

			return $results;  
		
	}



}
