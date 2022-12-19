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
		<table>
			<tr>
				<th>Hello World</th>
			</tr>
			<td>Hello World</td>
			
		</table>
		<form class="studentForm">
			<p>Student ID: <input type="text"></p>
			<p>Student Forename: <input type="text"></p>
			<p>Student Surname: <input type="text"></p>
			<p>Student Individual: <input type="checkbox"></p>
			<button type="submit">Add Student</button>
			<button type="submit">Remove Student</button>
		</form>
	</div>
</body>
</html>
