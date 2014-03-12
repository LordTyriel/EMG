<?php
	function db_connect() 
		{    
			
			//Connection to the localhost sql server on the opentech server defined as a functional variable 
			$conn = pg_connect("host=localhost port=5432 dbname=ateam user=ateam password=admin" ); 
			  
			return $conn; 
		} 
?>