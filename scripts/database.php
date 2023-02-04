<?php
	function sqlFunction($sql) {
		$pdo = new PDO("sqlite:".__DIR__."/../testdatabase.db");
		$statement = $pdo->query($sql);
		if (str_contains($sql, 'SELECT')) {
			$sqlResult = $statement->fetchAll(PDO::FETCH_ASSOC);
		}
		
		if (str_contains($sql, 'SELECT')) {
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
	}

	if (isset($_GET['sql'])) {
		if (str_contains($_GET['sql'], 'INSERT')) {
			sqlFunction($_GET['sql'].");");
		} else {
			sqlFunction($_GET['sql'].";");
		}
		
	}
?>