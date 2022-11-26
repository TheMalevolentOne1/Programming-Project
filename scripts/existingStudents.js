let sql = "SELECT * FROM tblStudents"
fetch(`D:\XAMPP\htdocs\PHP Project File\New folder\database.php?sql=${sql}`, {method:"GET"}).then(res => {
	if (!res.ok) {
		alert("OKAY")
	} else {
		alert(res)
	}
})