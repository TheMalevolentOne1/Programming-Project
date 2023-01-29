<!doctype html>
<html>
<head>
	<?php include "../scripts/database.php"; ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<title>Students Page</title>
	<link rel="stylesheet" href="../styles/menuStyle.css">
	<link rel="stylesheet" href="../styles/phpSiteStyle.css">
	<meta charset="utf-8">
	<script type="text/javascript">
		$(document).ready(()=>{
			$('.studentInd').click((checkbox) => {
				checkbox.target.checked && checkbox.target.id == "TeamCheck" ? $('#teamID').show() : $('#teamID').hide();
				
				checkbox.target.checked && checkbox.target.id == "indv" ? $('#TeamCheck').checked = !$('#TeamCheck').checked : $('#TeamCheck').checked = $('#TeamCheck').checked
			});
			
			$('#ShowRemoveStudent').click(() => {
				$('#AddStudentDiv').hide();
				$('#RemoveStudentDiv').show();
			});
	
			$('#ShowAddStudent').click(() => {
				$('#AddStudentDiv').show();
				$('#RemoveStudentDiv').hide();
			});
	
			$('#addStudentForm').submit((formData) => {
				formData.preventDefault();
				var formArr = $(formData.target).serializeArray();
				formArr.forEach((data) => { 
					
				})
				formArr.forEach((data) => {
					tdArr = $('td').toArray()
					for (let xd=0; xd < tdArr.length - 1; xd++) {
						if (data.value == tdArr[xd].innerHTML) {
							switch(data.name) {
								case("stuID"):
									alert("Student ID is Empty!");
									break;
							}
						}
					}
				});
			});
		});
	</script>
</head>

<body>
	<div class="container">
		<h1>Students</h1>
		<div id="menupagecontainer">
			<a href="../MainMenu.html"><button class="menubutton">Main Menu</button></a>
			<a href="events.php"><button class="menubutton">Events</button></a>
			<a href="leaderboards.php"><button class="menubutton">Leaderboards</button></a>
			<a href="teams.php"><button class="menubutton">Teams</button></a>
			<a href="admin.html"><button class="menubutton">Admin</button></a>
		</div>
	</div>
	<div class="content">
		<img src="../images/students.png" alt="Image of Student" width="500px" height="250px">
		<table id="table">
			<tr id="columnNames">
				<script type="text/javascript">
					const array = <?=sqlFunction('SELECT tblStudents."Student ID", tblStudents."Student Forename", tblStudents."Student Surname", tblTeams."Team Name" FROM tblStudents JOIN tblTeams ON tblStudents."Team ID" = tblTeams."Team ID";')?>;
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
		<div id="formsDiv">
			<div id="OptionSelector">
				<button id="ShowAddStudent" class="optionSel">Add Student Form</button>
				<button id="ShowRemoveStudent" class="optionSel">Remove Student Form</button>
			</div>
			<div id="AddStudentDiv">
				<form id="addStudentForm">
					<p>Student ID: <input type="text" placeholder="Enter ID" class="stuInput" name="stuID" id=StuID></p>
					<script>
						$('#StuID').attr({"min": ($('td').length / $('th').length) + 1});
					</script>
					<p>Student Forename: <input type="text" placeholder="Enter Forename" class="stuInput" name="stuForename"></p>
					<p>Student Surname: <input type="text" placeholder="Enter Surname" class="stuInput" name="stuSurname"></p>
					<p>Student Type: <input type="radio" name="Team" name="teamorindiv"  class="studentInd" id="TeamCheck" class="stuInput">Team <input type="radio" name="Individual"  name="teamorindiv" class="studentInd" checked="true" id="indv"> Individual</input></p>
					<p id="teamID" hidden="true">Team ID: <input type="number" placeholder="Enter Team ID" class="stuInput"></p>
					<button type="submit" class="SubmitButton">Add Student</button>
				</form>
			</div>
			<div id="RemoveStudentDiv" hidden="false">
				<form id="removeStudentForm">
					<p>Student ID: <input type="number" id="removeStudentID"></p>
					<script>
						$('#removeStudentID').attr({"min": 1,"max": $('td').length / $('th').length});
					</script>
					<button type="submit" class="SubmitButton">Remove Student</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
