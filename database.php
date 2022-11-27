<?php
	function sqlRequest($sql) {
        $pdo = new PDO('sqlite:database.db');
        $statement = $pdo->query($sql);
        $result = $statement->fetchall(PDO::FETCH_ASSOC);
		return $result;
    }

    if (isset($_GET['sql'])) {
		$data = $_GET['sql'];
		$table = json_encode(sqlRequest($data));
		echo "<script src='scripts/existingStudents.js'></script>";
		echo "<script text='text/javascript'>sqlfunc($table)</script>";
        
    }
?>