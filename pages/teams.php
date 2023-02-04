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
				if (formData.target.id == "fmAddTeam") {
					tdArr = $('td').toArray();
					vals = [];
					formArr.forEach((data) => {
						for (let i = 0; i < tdArr.length; i++) {
							if (data.value == tdArr[i].innerHTML && data.name == "Team Name") {
								alert("Team Name Already Exists!");
								window.location = window.location; //Prevents SQL from being run!
							} else if (data.value == "" && data.name == "Team Name") {
								alert("Team Name is Empty!")
								window.location = window.location;
							} else {
								if (!vals.includes(data.value)) {
									vals.push(data.value);
								}
							}
						}
					});
				
					if (!vals.includes("")) {
						let sql = "INSERT INTO 'tblTeams'('Team ID', 'Team Name') VALUES ("+vals[0]+`, "${vals[1]}"`
						console.log(sql)
						fetch("../scripts/database.php?sql="+sql, {method:"GET"}).then((res) => {
							if (res.status == 200) {
							window.location = window.location;
						} else {
							console.log(res);
						}
						});
					}
				}
				
				if (formData.target.id == "fmRemoveTeam") {
					tdArr = $('td').toArray();
					alertSent = false;
					if (formArr[0].value == "") {
						alert("Team ID is Empty!");
						return;
					} else {
						for (let i = 0; i < tdArr.length - 1; i++) {
							if (tdArr[i].innerHTML != formArr[0].value && i == tdArr.length - 2) {
								alert("Team ID is invalid!");
								alertSent = true;
							}
						}
					}
					
					if (!alertSent) {
						let rowRemove = formArr[0].value
						let sql = `DELETE FROM 'tblTeams' WHERE "Team ID" = "${rowRemove}"`;
						fetch("../scripts/database.php?sql="+sql, {method:"GET"}).then(res => {
							if (res.status == 200) {
								window.location = window.location;
							} else {
								console.log(res);
							}
						});
					} else {
						return;	
					}
 					
				}
			});
			
		});
	</script>
</head>

<body>
	<div class="container">
		<h1>Teams</h1>
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
				let num = 0;
				array.forEach((e) => {
					for (let i = 0; i < e.length; i += hAmount) {
						const newTR = document.createElement("tr");
						$('#table').append(newTR);
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
		<div id="FormButtons">
			<button id="AddForm">Add Team Form</button>
			<button id="RemoveForm">Remove Team Form</button>
			<div id="addTeamDiv">
				<form id="fmAddTeam">
					<p>Team ID: <input type="number" id="TeamIDInput" name="Team ID" placeholder="Enter ID"></p>
					<script type=text/javascript> 
						$('#TeamIDInput').attr({"min": Number($('td')[$('td').length - 2].innerHTML) + 1});
						$('#TeamIDInput')[0].value = Number($('td')[$('td').length - 2].innerHTML) + 1;
					</script>
					<p>Team Name: <input type="text" name="Team Name" placeholder="Enter Name"></p>
					<button type="submit">Add Team</button>
				</form>
			</div>
			<div id="removeTeamDiv" hidden>
				<form id="fmRemoveTeam">
					<p>Team ID: <input type="number" name="Team ID" id="teamIDInput"></p>
					<script type="text/javascript">
						$('#teamIDInput').attr({"min": $('td')[0].innerHTML});
					</script>
					<button type="submit">Remove Team</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>