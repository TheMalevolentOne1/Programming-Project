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
		<table id="stuTable">
			<tr id="columnNames">
				<script type="text/javascript">
					const array = <?=sqlFunction("SELECT * FROM tblStudents");?>;
					
					const tableValues = ["Student ID", "Student Forename", "Student Surname", "Student Type", "Team ID"];
					tableValues.forEach((e, i) => {
						var newTh = document.createElement("th");
						newTh.innerHTML = tableValues[i];
						$('#columnNames').append(newTh);
					});
				</script>
			</tr>
			<script type="text/javascript">
				for (let i=0; i < array.length; i++) {
					if (i%6==0 || i == 0) {
						const newTR = document.createElement("tr").setAttribute("class", "columnData");
						$('#stuTable').append(newTR);
					}
				}
			</script>
			
		</table>
		<form id="studentForm">
			<p>Student ID: <input type="text" placeholder="Enter ID" class="stuInput"></p>
			<p>Student Forename: <input type="text" placeholder="Enter Forename" class="stuInput"></p>
			<p>Student Surname: <input type="text" placeholder="Enter Surname" class="stuInput"></p>
			<p>Student Type: <input type="radio" name="teamorindiv" class="studentInd" id="TeamCheck" class="stuInput"> Team <input type="radio" name="teamorindiv" class="studentInd"> Individual</input></p>
			<p id="teamID" hidden="true">Team ID: <input type="number" placeholder="Enter Team ID" class="stuInput"></p>
			<div id="submitButtons">
				<button type="submit" class="SubmitButton">Add Student</button>
				<button type="submit" class="SubmitButton">Remove Student</button>
			</div>
		</form>
	</div>
</body>
</html>
