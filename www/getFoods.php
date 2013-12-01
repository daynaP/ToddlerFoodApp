<?php
	
	//the meal needs to be the exact db table name without the tbl_ prefix
	$meal=$_GET['meal'];
	
	
	if($meal!=NULL) {
		require_once("connect.php");
		
		$sql="SELECT * FROM `tbl_$meal`";
		
		//get the data from the db
		$results = query($sql);

		//check that data came back
		if ( $results ){

			//encode the data as JSON and send it back to the caller
			echo json_encode($results);
		}else{
			echo "no data";
		}
	}







	//generic query string
	function query($sql){

		//run the query against the database and store the results in $results
		$results = mysql_query($sql);
	
		$yesThereWereSomeRows = false;

		//multidementional array to return to the caller
		$returnArray = Array();

		//loop through all the rows returned from the database
		while($row = mysql_fetch_assoc($results)) {

			//create an inner array
			$innerArray = Array();

			foreach($row as $key => $value) {
		        $innerArray[] = $value;
		     }			

			$yesThereWereSomeRows = true;
			$returnArray[]=$innerArray;
		}

		if ( $yesThereWereSomeRows ==false ) $returnArray = false;

		//return the results to the calling function
		return $returnArray;
	}


?>