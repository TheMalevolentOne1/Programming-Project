<?php
	function sqlFunction($sql) {
		$pdo = new PDO("sqlite:".__DIR__."/../database.db");
		$statement = $pdo->query($sql);
		$sqlResult = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		$tableValues = [];
		foreach ($sqlResult as $null => $array) {
			$arrayKeys = array_keys($array);
			for ($i=0; $i < count($array);$i++) {
				array_push($tableValues, $arrayKeys[$i]);
				array_push($tableValues, $array[$arrayKeys[$i]]);
			}
		}
		
		return json_encode($tableValues);
	}
?>