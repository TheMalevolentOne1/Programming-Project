let sql = "SELECT * FROM tblStudents"
fetch("database.php?sql="+sql, {method:"GET"}).then(res => {
	if (!res.ok) { alert("Error, Something went wrong!"); }
}).catch(err => { console.log(err); })