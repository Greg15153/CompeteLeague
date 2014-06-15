<?php	
	class MYSQL {
	
		public function __construct($host, $user, $pass, $dbase){
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->dbase = $dbase;
			mysql_connect($host, $user, $pass);
			mysql_select_db($dbase);
		}

		public function getMax($table, $col){
			return $this->getArray("SELECT MAX($col) FROM $table");
		}
		
		public function getMin($table, $col){
			return $this->getArray("SELECT MIN($col) FROM $table");
		}
		
		public function getTotal($table, $col){
			return $this->getArray("SELECT SUM($col) FROM $table");
		}
		
		public function search($term, $table){
			$term = mysql_real_escape_string($term);
			$table = mysql_real_escape_string($table);
			return $this->getArray("SELECT * FROM $table WHERE name like '%$term%'");
		}
		
		public function query($query) {
			return mysql_query($query);
		}

		public function getArray($query){
			$result = array();
			$query = mysql_query($query);
			while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
				array_push($result, $row);
			}
			return $result;
		}
	}
?>