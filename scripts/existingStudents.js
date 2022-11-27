const sqlfunc = (data) => {
	const tab = document.createElement("div");
	tab.setAttribute("class", "PHPTEST");

	
}

window.onload = () => {
	let sql = "SELECT * FROM tblStudents"
	fetch("../database.php?sql="+sql, {method:"GET"}).then(res => {
		if (!res.ok) { alert("Error, Something went wrong!"); console.log(res); return; }
	}).catch(err => { alert(err); })
}