$(document).ready(()=>{
	$('#checkTeam').click((checkbox) => {
		checkbox.target.checked ? $('#teamID').show() : $('#teamID').hide(); 
	});
});

$(document).submit((formData) => {
	formData.preventDefault()
	console.log(formData)
})