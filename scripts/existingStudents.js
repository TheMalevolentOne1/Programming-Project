let sql = "SELECT * FROM tblStudents"
fetch("../database.php?sql="+sql, {method:"GET"}).then(res => {
	if (!res.ok) { alert("Error, Something went wrong!"); console.log(res); return; }
}).catch(err => { alert(err); })

const sqlfunc = (data) => {
	const item = document.createElement("div");
	
	document.body.appendChild(item);
}