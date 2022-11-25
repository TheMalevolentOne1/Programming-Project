window.onload = () => {
	document.getElementById("menubuttonscontainer").addEventListener("click", clickItem => {
		alert(clickItem.data)
	});
}