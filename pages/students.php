<!doctype html>
<html>
<head>
	<?php include "../scripts/database.php"; ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="../scripts/existingStudents.js"></script>
	<title>Students Page</title>
	<link rel="stylesheet" href="../styles/menuStyle.css">
	<link rel="stylesheet" href="../styles/studentStyle.css"
	<meta charset="utf-8">
	<script type="text/javascript">
			const array = <?=sqlFunction("SELECT * FROM tblStudents");?>;
	</script>
</head>

<body>
	<div class="container">
		<h1>Students</h1>
		<div id="menupagecontainer">
			<a href="../MainMenu.html"><button class="menubutton">Main Menu</button></a>
			<a href="pages/events.html"><button class="menubutton">Events</button></a>
			<a href="pages/leaderboards.html"><button class="menubutton">Leaderboards</button></a>
			<a href="pages/teams.html"><button class="menubutton">Teams</button></a>
			<a href="pages/admin.html">
			<button class="menubutton">Admin</button></a>
		</div>
	</div>
	<div class="content">
		<img src="../images/students.png" alt="Image of Student" width="500px" height="250px">
		<table>
			<tr id="columnNames">
				<script type="text/javascript">
					array.forEach((e, i) => {
						if (i % 2 == 0 || i == 0) {
							var newTh = document.createElement("th");
							newTh.innerHTML = array[i];
							$('#columnNames').append(newTh);
						}
					})
				</script>
			</tr>
			<td>Hello World</td>
			
		</table>
		<form id="studentForm">
			<p>Student ID: <input type="text" placeholder="Enter ID" ></p>
			<p>Student Forename: <input type="text" placeholder="Enter Forename"></p>
			<p>Student Surname: <input type="text" placeholder="Enter Surname"></p>
			<p>Student Type: <input type="radio" name="teamorindiv" class="studentInd" id="TeamCheck"> Team <input type="radio" name="teamorindiv" class="studentInd"> Individual</input></p>
			<p id="teamID" hidden="true">Team ID: <input type="number" placeholder="Enter Team ID"></p>
			<button type="submit">Add Student</button>
			<button type="submit">Remove Student</button>
		</form>
	</div>
</body>
</html>
