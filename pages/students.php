<!doctype html>
<html>
<head>
	<?php include "../scripts/database.php"; ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="../scripts/existingStudents.js"></script>
	<title>Students Page</title>
	<link rel="stylesheet" href="../styles/menuStyle.css">
	<link rel="stylesheet" href="../styles/studentStyle.css">
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
		<table id="table">
			<tr id="columnNames">
				<script type="text/javascript">
					const array = <?=sqlFunction('SELECT tblStudents."Student ID", tblStudents."Student Forename", tblStudents."Student Surname", tblStudents."Student Type", tblTeams."Team Name", tblTeams."Team ID" FROM tblStudents INNER JOIN tblTeams ON tblStudents."Team ID" = tblTeams."Team ID";')?>;
					console.log(array)
					array.forEach((e, i) => {
						if (typeof(e) === "string") {
							const newTH = document.createElement("th");
							newTH.innerHTML = e;
							$('#columnNames').append(newTH);
							delete array[i];
						}
					})
				</script>
			</tr>
			<script type="text/javascript">
				const hAmount = $('th').length;
				let num = 0
				array.forEach((e) => {
					for (let i = 0; i < e.length; i += hAmount) {
						console.log(i)
						const newTR = document.createElement("tr");
						$('#table').append(newTR);
						for (let c = 0; c < hAmount; c++) {
							const newTD = document.createElement("td")
							newTD.innerHTML = e[num];
							newTR.append(newTD)
							num++
						}
					}
				})
			</script>
		</table>
		<div id="OptionSelector">
			<button id="ShowAddStudent">Add Student Form</button>
			<button id="ShowRemoveStudent">Remove Student Form</button>
			<div id="AddStudentDiv">
				<form id="addStudentForm">
					<p>Student ID: <input type="text" placeholder="Enter ID" class="stuInput"></p>
					<p>Student Forename: <input type="text" placeholder="Enter Forename" class="stuInput"></p>
					<p>Student Surname: <input type="text" placeholder="Enter Surname" class="stuInput"></p>
					<p>Student Type: <input type="radio" name="teamorindiv" class="studentInd" id="TeamCheck" class="stuInput"> Team <input type="radio" name="teamorindiv" class="studentInd" checked="true"> Individual</input></p>
					<p id="teamID" hidden="true">Team ID: <input type="number" placeholder="Enter Team ID" class="stuInput"></p>
					<div id="submitButtons">
						<button type="submit" class="SubmitButton">Add Student</button>
						<button type="submit" class="SubmitButton">Remove Student</button>
					</div>
				</form>
			</div>
			<div id="RemoveStudentDiv">
				<form id="removeStudentForm">
					<p>Student ID: <input type="number" maxlength="1"></p>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
