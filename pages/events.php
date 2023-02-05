<!doctype html>
<html>
<head>
	<?php include "../scripts/database.php"; ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<title>Events Page</title>
	<link rel="stylesheet" href="../styles/menuStyle.css">
	<link rel="stylesheet" href="../styles/phpSiteStyle.css">
	<meta charset="utf-8">
	<script type="text/javascript">
		$(document).ready(()=>{
			$('#addEventResultForm').click(()=>{
				$('#addFormDivResult').show();
				$('#removeFormDivResult').hide();
			});
			
			$('#removeEventResultForm').click(()=>{
				$('#addFormDivResult').hide();
				$('#removeFormDivResult').show();
			});
			
			$('#addEventForm').click(()=>{
				$('#addFormDiv').show();
				$('#removeFormDiv').hide();
			});
			
			$('#removeEventForm').click(()=>{
				$('#addFormDiv').hide();
				$('#removeFormDiv').show();
			});
			
			$('form').submit((formData) =>{
				formData.preventDefault();
				var formArr = $(formData.target).serializeArray();
				if (formData.target.id == "AddEvent") {
					tdArr = $('td').toArray();
					let sentAlert = false;
					vals = [];
					formArr.forEach((data) => {
						for (let i = 0; i < tdArr.length; i++) {
							if (data.value == "") {
								alert(data.name+" is Empty!");
								sentAlert = true;
								break;
							} else if (data.name == "Event Type" && !['Individual', 'Team'].includes(data.value)) {
								alert(data.name+" can only be either Individual or Team!");
								sentAlert = true;
								break;
							}
						}
					});
					
					if (!sentAlert) {
						let sql = `INSERT INTO "tblEvents" VALUES ("${formArr[0].value}", "${formArr[1].value}", "${formArr[2].value}", "${formArr[3].value}", "${formArr[4].value}", "${formArr[5].value}", "${formArr[6].value}")`
						fetch("../scripts/database.php?sql="+sql, {method:"GET"}).then(res => {
							if (res.status == 200) {
								console.log(res.url);
							} else {
								console.log(res);
							}
						});
					}
				} else if (formData.target.id == "RemoveEvent") {
					let sql = `DELETE FROM 'tblEvents' WHERE "Event ID" = "${formArr[0].value} AND "Student ID" = ${formArr[1].value}`;
					fetch("../scripts/database.php?sql="+sql, {method:"GET"}).then((res)=>{
						if (res.status == 200) {
							window.location = window.location;
						} else {
							console.log(res);
						}
					});
				} else if (formData.target.id == "AddEventResult") {
					tdArr = $('td').toArray();
					let sentAlert = false;
					vals = [];
					formArr.forEach((data) => {
						for (let i = 0; i < tdArr.length; i++) {
							if (data.value == "") {
								alert(data.name+" is Empty!");
								sentAlert = true;
								break;
							}
						}
					});
					
					if (!sentAlert) {
						let sql = `INSERT INTO "tblEventResults" VALUES ("${formArr[0].value}", "${formArr[1].value}", "${formArr[2].value}")`
						fetch("../scripts/database.php?sql="+sql, {method:"GET"}).then(res => {
							if (res.status == 200) {
								console.log(res.url);
							} else {
								console.log(res);
							}
						});
					}
				} else if (formData.target.id == "RemoveEventResult") {
					let sql = `DELETE FROM 'tblEventResults' WHERE "Event ID" = "${formArr[0].value}"`;
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
		<h1>Events</h1>
		<div id="menupagecontainer">
			<a href="../MainMenu.html"><button class="menubutton">Main Menu</button></a>
			<a href="students.php"><button class="menubutton">Students</button></a>
			<a href="leaderboards.php"><button class="menubutton">Leaderboards</button></a>
			<a href="teams.php"><button class="menubutton">Teams</button></a>
			<a href="admin.html"><button class="menubutton">Admin</button></a>
		</div>
	</div>
		<table id="table">
			<tr id="columnNames">
				<script type="text/javascript">
					const array = <?=sqlFunction('SELECT * FROM tblEvents;')?>;
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
		<table id="eventResultTable">
			<tr id="eventResultColumnNames">
				<script type="text/javascript">
					const eventResultArray = <?=sqlFunction('SELECT * FROM tblEventResults;')?>;
					eventResultArray.forEach((e, i) => {
						if (typeof(e) === "string") {
							const newTH = document.createElement("th");
							newTH.innerHTML = e;
							$('#eventResultColumnNames').append(newTH);
							delete eventResultArray[i];
						}
					})
				</script>
		  	</tr>
			<script type="text/javascript">
				const eventResultHAmount = 3;
				let eventNum = 0;
				eventResultArray.forEach((e) => {
					for (let i = 0; i < e.length; i += eventResultHAmount) {
						const newTR = document.createElement("tr");
						$('#eventResultTable').append(newTR);
						for (let c = 0; c < eventResultHAmount; c++) {
							const newTD = document.createElement("td");
							newTD.innerHTML = e[eventNum];
							newTR.append(newTD);
							eventNum++;
						}
					}
				});
			</script>
		</table>
	<div class="content">
		<img src="../images/academic-sports2.png" alt="Image of Students Doing Academic Event" width="200px" height="150px">
		<img src="../images/academic-sports3.png" alt="Image of Students Doing Academic Event" width="200px" height="150px">
		<div id="addOrRemoveEvent">
			<button type="button" id="addEventForm">Add Event Form</button>
			<button type="button" id="removeEventForm">Remove Event Form</button>
			<div id="addFormDiv">
				<form id="AddEvent">
					<p>Event ID: <input id="addEventID" type="number" name="Event ID" placeholder="Enter ID"></p>
					<script type="text/javascript">
						$('#addEventID').attr({"min": Number($('#table').find('td').toArray()[$('#table').find("td").length - $('#table').find('th').length].innerHTML) + 1});
						$('#addEventID')[0].value = Number($('#table').find('td').toArray()[$('#table').find("td").length - $('#table').find('th').length].innerHTML) + 1;
					</script>
					<p>Event Name: <input type="text" name="Event Name" placeholder="Event Name"></p>
					<p>Event Type: <input type="text" name="Event Type" placeholder="Enter Type"></p>
					<p>First Place Points: <input type="number" name="First Place" placeholder="Enter First Place Points"></p>
					<p>Second Place Points: <input type="number" name="Second Place" placeholder="Enter Second Place Points"></p>
					<p>Third Place Points: <input type="number" name="Third Place" placeholder="Enter Third Place Points"></p>
					<p>Other Place Points: <input type="number" name="Other Place" placeholder="Enter Other Place Points"></p>
					<button type="submit">Add Event</button>
				</form>
			</div>
			
			<div id="removeFormDiv" hidden=true>
				<form id="RemoveEvent">
					<p>Event ID: <input type="number" name="Event ID"></p>
					<button type="submit">Remove Event</button>
				</form>
			</div>
		</div>
		<div id="addOrRemoveEventResult">
			<button type="button" id="addEventResultForm">Add Event Result Form</button>
			<button type="button" id="removeEventResultForm">Remove Event Result Form</button>
			<div id="addFormDivResult">
				<form id="AddEventResult">
					<p>Event ID: <input id="EventID" type="number" name="Event ID" placeholder="Enter Event ID"></p>
					<script type="text/javascript">
						$('#EventID').attr({"min": 1});
						$('#EventID')[0].value = 1;
					</script>
					<p>Student ID: <input type="number" name="Student ID" placeholder="Enter Student ID"></p>
					<p>Position Placed: <input type="number" name="Position Placed" placeholder="Enter Type"></p>
					<button type="submit">Add Event Result</button>
				</form>
			</div>
			
			<div id="removeFormDivResult" hidden=true>
				<form id="RemoveEventResult">
					<p>Event ID: <input type="number" name="Event ID"></p>
					<p>Student ID: <input type="number" name="Student ID"></p>
					<button type="submit">Remove Event Result</button>
				</form>
			</div>
		</div>
</body>
</html>