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
			
			$('#ShowAddStudent').click(() => {
				$('#AddStudentDiv').show();
				$('#RemoveStudentDiv').hide();
			});
	
			$('#ShowRemoveStudent').click(() => {
				$('#AddStudentDiv').hide();
				$('#RemoveStudentDiv').show();
			});
			
			$('#showTeamID').click(() => {
				$('#teamID').show();
			});
			
			$('#hideTeamID').click(() => {
				$('#teamID').hide();
			});
	
			$('form').submit((formData) => {
				formData.preventDefault();
				var formArr = $(formData.target).serializeArray();
				let sentAlert = false
				let validationCheck = false
				if (formData.target.id == "addStudentForm") {
					formArr.forEach((data) => {
						tdArr = $('#studentTable').find("td").toArray();
						for (let xd=0; xd < tdArr.length - 1; xd++) {
							if (data.name == "stuID" && data.value == "") {
								alert("Student ID is Empty!");
								sentAlert = true;
								break;
							} else if (data.name == "stuForename" && data.value == "") {
								alert("Student Forename is Empty!");
								sentAlert = true;
								break;
							} else if (data.name == "stuSurname" && data.value == "") {
								alert("Student Surname is Empty!");
								sentAlert = true;
								break;
							} else if (data.name ==  "Team Name" && $('#teamID').is(":visible") && data.value == "") {
								alert("Team ID is Empty!");
								sentAlert = true;
								break;
							} else {
								validationCheck = true
							}
						}
						
						if (validationCheck) {
							const teamNames = [];
							if ($('#teamID').is(":visible")) {
								const teamTable = $('#teamsTable').find("td").toArray()

								for (let cd=0; cd < teamTable.length; cd++) {
									if (!teamNames.includes(teamTable[cd].innerHTML) && isNaN(teamTable[cd].innerHTML)) {
										teamNames.push(teamTable[cd].innerHTML);
									}
								}
								
								if (!teamNames.includes(data.value) && data.name == "Team Name") {
									alert("Team Name does not exist!");
									sentAlert = true;
								}
							}
						} 
					});
					
					const teams = $('#teamsTable').find("td").toArray();
					
					const teamValues = [];
					
					teams.forEach((team) => {
						teamValues.push(team.innerHTML);
					});
					
					if (!sentAlert) {
						let sql = `INSERT INTO tblStudents VALUES ("${formArr[0].value}", "${formArr[1].value}", "${formArr[2].value}", 'Individual', NULL)`
						
						if ($('#teamID').is(":visible")) {
							sql = `INSERT INTO tblStudents VALUES ("${formArr[0].value}", "${formArr[1].value}", "${formArr[2].value}", 'Team',"${teamValues[teamValues.indexOf(formArr[3].value) - 1]}")`
						}

						fetch("../scripts/database.php?sql="+sql, {method:"GET"}).then((res) => {
							if (res.status == 200) {
								window.location = window.location;
							} else {
								console.log(res)
							}
						});	
					}
					
				} else if (formData.target.id == "removeStudentForm") {
					let sql = `DELETE FROM 'tblStudents' WHERE "Student ID" = "${formArr[0].value}"`;
					fetch("../scripts/database.php?sql="+sql, {method:"GET"}).then((res)=>{
						if (res.status == 200) {
							window.location = window.location;
						} else {
							console.log(res);
						}
					});
				}
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
		
		<!-- Student Table -->
		<table id="studentTable">
			<tr id="studentColumnNames">
				<script type="text/javascript">
					const stuArray = <?=sqlFunction('SELECT "Student ID", "Student Forename", "Student Surname", IFNULL("Team Name", "Individual Participant") AS "Team Name" FROM tblStudents LEFT JOIN tblTeams ON tblStudents."Team ID" = tblTeams."Team ID";')?>;
					stuArray.forEach((e, i) => {
						if (typeof(e) === "string") {
							const newTH = document.createElement("th");
							newTH.innerHTML = e;
							$('#studentColumnNames').append(newTH);
							delete stuArray[i];
						}
					})
				</script>
			</tr>
			<script type="text/javascript">
				const stuhAmount = $('th').length;
				let stuNum = 0
				stuArray.forEach((e) => {
					for (let i = 0; i < e.length; i += stuhAmount) {
						const newTR = document.createElement("tr");
						$('#studentTable').append(newTR);
						for (let c = 0; c < stuhAmount; c++) {
							const newTD = document.createElement("td");
							newTD.innerHTML = e[stuNum];
							newTR.append(newTD);
							stuNum++;
						}
					}
				});
			</script>
		</table>
		
		<!-- Team Table -->
		<table id="teamsTable">
			<tr id="columnNames">
				<script type="text/javascript">
					const array = <?=sqlFunction('SELECT * FROM tblTeams;')?>;
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
				const hAmount = 2;
				let num = 0;
				array.forEach((e) => {
					for (let i = 0; i < e.length; i += hAmount) {
						const newTR = document.createElement("tr");
						$('#teamsTable').append(newTR);
						for (let c = 0; c < hAmount; c++) {
							const newTD = document.createElement("td");
							newTD.innerHTML = e[num];
							newTR.append(newTD);
							num++;
						}
					}
				});
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
						$('#StuID').attr({"min": Number($('#studentTable').find('td').toArray()[$('#studentTable').find("td").length - $('#studentTable').find('th').length].innerHTML) + 1});
						$('#StuID')[0].value = Number($('#studentTable').find('td').toArray()[$('#studentTable').find("td").length - $('#studentTable').find('th').length].innerHTML) + 1;
					</script>
					<p>Student Forename: <input type="text" placeholder="Enter Forename" class="stuInput" name="stuForename"></p>
					<p>Student Surname: <input type="text" placeholder="Enter Surname" class="stuInput" name="stuSurname"></p>
					<p>Student Type: <button type="button" id="showTeamID">Team</button><button type="button" id="hideTeamID">Individual</button></p>
					<p id="teamID" hidden="true">Team Name: <input type="text" placeholder="Enter Team ID" class="stuInput" name="Team Name"></p>
					<button type="submit" class="SubmitButton">Add Student</button>
				</form>
			</div>
			<div id="RemoveStudentDiv" hidden="false">
				<form id="removeStudentForm">
					<p>Student ID: <input type="number" id="removeStudentID" name="Student ID" placeholder="Enter Student ID"></p>
					<script>
						$('#removeStudentID').attr({"min": Number($('#studentTable').find('td').toArray()[0].innerHTML), "max": Number($('#studentTable').find('td').toArray()[$('#studentTable').find("td").length - $('#studentTable').find('th').length].innerHTML)});
						$('#removeStudentID')[0].value = Number($('#studentTable').find('td').toArray()[0].innerHTML);
					</script>
					<button type="submit" class="SubmitButton">Remove Student</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>