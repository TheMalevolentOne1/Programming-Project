<?php 
    function sqlRequest($sql) {
        $pdo = new PDO('sqlite:database.db');
        $statement = $pdo->query($sql);
        $result = $statement->fetchall(PDO::FETCH_ASSOC);
		return $result;
    }

    if (isset($_GET['sql'])) {
		echo("Hello World");
        
    }

//$table = json_encode(sqlRequest($_GET(['sql']));
        //echo $table;
?>