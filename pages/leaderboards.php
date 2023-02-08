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
		
		const IDEarray = <?=sqlFunction('SELECT "tblStudents"."Student Forename", "tblStudents"."Student Surname", "tblEventResults"."Position Placed", "tblEvents"."Event Name" FROM tblStudents LEFT JOIN tblEventResults ON tblEventResults."Student ID" = tblStudents."Student ID" LEFT JOIN tblEvents ON "tblEvents"."Event ID" = "tblEventResults"."Event ID" WHERE "tblEvents"."Event Type" = "Individual" ORDER BY "tblEvents"."Event Name", "tblEventResults"."Position Placed";');?>;
		
		const TDEarray = <?=sqlFunction('SELECT "tblStudents"."Student Forename", "tblStudents"."Student Surname", "tblEventResults"."Position Placed", "tblEvents"."Event Name" FROM tblStudents LEFT JOIN tblEventResults ON tblEventResults."Student ID" = tblStudents."Student ID" LEFT JOIN tblEvents ON "tblEvents"."Event ID" = "tblEventResults"."Event ID" WHERE "tblEvents"."Event Type" = "Team" ORDER BY "tblEvents"."Event Name", "tblEventResults"."Position Placed";');?>;
		
		
		$(document).ready(()=>{
			const clearTable = () => {
				$('#leaderboardTable').find("*").toArray().forEach((tableItem)=>{
					if (tableItem.id != "leaderboardColumns") {
						tableItem.remove();
					}
				});
			}
			
			const createTable = (array) => {
				array.forEach((e, i) => {
					if (typeof(e) === "string") {
						const newTH = document.createElement("th");
						newTH.innerHTML = e;
						$('#leaderboardColumns').append(newTH);
						delete array[i];
					}
				});

				const stuhAmount = $('th').length;
				let stuNum = 0
				array.forEach((e) => {
					for (let i = 0; i < e.length; i += stuhAmount) {
						const newTR = document.createElement("tr");
						$('#leaderboardTable').append(newTR);
						for (let c = 0; c < stuhAmount; c++) {
							const newTD = document.createElement("td");
							newTD.innerHTML = e[stuNum];
							newTR.append(newTD);
							stuNum++;
						}
					}
				});
			}
			
			$('#IDE').click(()=>{
				if ($('#leaderboardColumns').find("th").length != 0) {
					clearTable();
				}
				
				createTable(IDEarray);
			});
			
			$('#TDE').click(()=>{
				if ($('#leaderboardColumns').find("*").length != 0) {
					clearTable();
				}
				
				createTable(TDEarray);
			});
		});
			
						
	</script>
</head>

<body>
	<div class="container">
		<h1>Leaderboards</h1>
		<div id="menupagecontainer">
			<a href="../MainMenu.html"><button class="menubutton">Main Menu</button></a>
			<a href="events.php"><button class="menubutton">Events</button></a>
			<a href="leaderboards.php"><button class="menubutton">Leaderboards</button></a>
			<a href="teams.php"><button class="menubutton">Teams</button></a>
			<a href="admin.html"><button class="menubutton">Admin</button></a>
		</div>
	</div>
	<div class="content">
		<img src="../images/event_leaderboard1.png" alt="Image of Student" width="350px" height="250px">
		<img src="../images/event_leaderboard2.png" alt="Image of Student" width="350px" height="250px">
		
		<div class="container">
			<button id="IDE">Individual Event Leaderboard</button>
			<button id="TDE">Team Event Leaderboard</button>
		</div>
		
		<table id="leaderboardTable">
			<tr id="leaderboardColumns">
			</tr>
		</table>
	</div>
</body>
</html>