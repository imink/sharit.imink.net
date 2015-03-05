<?php
class SQLHelper {
	private $con = null;
	private $results;
	//private $debug = TRUE;
	private $error = FALSE;
	private $debug=FALSE;
	//private $sqlDebug=FALSE;
	function open() {
		if ($this->con == null) {
			$this->con = mysqli_connect ( "localhost", "root", "mysqlpass", "test1" );
		}
		
		if (mysqli_connect_errno ()) {
			if ($this->debug) {
				
				echo "Failed to connect to MySQL: " . mysqli_connect_error ();
			}
		} else {
			if ($this->debug) {
				
				echo "Connected ok";
			}
		}
	}
	function doSQL($sql) {
		$this->error = FALSE;
		if ($this->sqlDebug) {
			echo "Trying to execute ... " . $sql;
		}
		$this->open ();
		if ($this->results = mysqli_query ( $this->con, $sql )) {
			// echo "SQL Executed OK";
		} else {
			$this->error = TRUE;
			if ($this->debug) {
				echo "Error executing : " . mysqli_error ( $this->con );
			}
		}
		return ($this->results);
	}
	function close() {
		mysqli_close ( $con );
	}
	function get_Error() {
		return ($this->error);
	}
}

?>
