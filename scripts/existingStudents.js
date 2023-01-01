$(document).ready(()=>{
	$('.studentInd').click((checkbox) => {
		checkbox.target.checked && checkbox.target.id == "TeamCheck" ? $('#teamID').show() : $('#teamID').hide();
	});
});

$('#studentForm').submit((formData) => {
	formData.preventDefault()
	console.log(formData)
})