<?php
	function sqlFunction($sql) {
		$pdo = new PDO("sqlite:".__DIR__."/../database.db");
		$statement = $pdo->query($sql);
		$sqlResult = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		$tableNames = [];
		$tableValues = [];
		
		foreach ($sqlResult as $null => $array) {
			$arrayKeys = array_keys($array);
			for ($i=0; $i < count($array);$i++) {
				array_push($tableNames, $arrayKeys[$i]);
				array_push($tableValues, $array[$arrayKeys[$i]]);
			}
		}
		$resultTable = array_unique($tableNames);
		array_push($resultTable, $tableValues);
		
		
		return json_encode($resultTable);
	}
?>