<!doctype html>
<html>
<head>
	<?php include "../scripts/database.php"; ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<title>Teams Page</title>
	<link rel="stylesheet" href="../styles/menuStyle.css">
	<link rel="stylesheet" href="../styles/phpSiteStyle.css">
	<meta charset="utf-8">
	<script type="text/javascript">
		$(document).ready(() => {
			$('#AddForm').click((formClick) => {
				console.log($('#addTeamDiv').hidden)
				$('#addTeamDiv').show();
				$('#removeTeamDiv').hide();
			});
		
			$('#RemoveForm').click((formClick) => {
				$('#removeTeamDiv').show();
				$('#addTeamDiv').hide();
			});
			
			$('form').submit((formData) =>{
				formData.preventDefault();
				var formArr = $(formData.target).serializeArray();
				console.log(formArr)
				tdArr = $('td').toArray();
				formArr.forEach((data) => {
					for (let i = 0; i < tdArr.length; i++) {
						if (data.value == tdArr[i].innerHTML && data.name == "Team ID") {
							alert("Team ID Already Exists!");
						} else if (data.value == tdArr[i].innerHTML && data.name == "Team Name") {
							alert("Team Name Already Exists!");
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
			<a href="students.php"><button class="menubutton">Students</button></a>
			<a href="events.php"><button class="menubutton">Events</button></a>
			<a href="leaderboards.php"><button class="menubutton">Leaderboards</button></a>
			<a href="admin.html"><button class="menubutton">Admin</button></a>
		</div>
	</div>
	<div class="content">
		<div id="ImageContent">
			<img src="../images/Team-Sports.png" alt="Academic Sports" class="academic" width="500px" height="250px">
			<img src="../images/academic-sports.png" alt="Academic Sports" class="teams" width="500px" height="250px">
		</div>
		<table id="table">
			<tr id="columnNames">
				<script type="text/javascript">
					const array = <?=sqlFunction('SELECT * FROM tblTeams;')?>;
					array.forEach((e, i) => {
						if (typeof(e) === "string") {
							console.log(e)
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
		<div id="FormButtons">
			<button id="AddForm">Add Team Form</button>
			<button id="RemoveForm">Remove Team Form</button>
			<div id="addTeamDiv">
				<form id="fmAddTeam">
					<p>Team ID: <input type="number" name="Team ID"></p>
					<p>Team Name: <input type="text" name="Team Name"></p>
					<button type="submit">Add Team</button>
				</form>
			</div>
			<div id="removeTeamDiv" hidden>
				<form id="fmRemoveTeam">
					<p>Team ID: <input type="number" name="Team ID" id="teamIDInput"></p>
					<script type="text/javascript">
						$('teamIDInput').attr({"min": 1,"max": $('td').length / $('th').length})
					</script>
					<button type="submit">Remove Team</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>