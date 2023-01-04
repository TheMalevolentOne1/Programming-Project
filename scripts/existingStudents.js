$(document).ready(()=>{
	$('.studentInd').click((checkbox) => {
		checkbox.target.checked && checkbox.target.id == "TeamCheck" ? $('#teamID').show() : $('#teamID').hide();
	});
	
	$('#ShowRemoveStudent').click(() => {
		$('#AddStudentDiv').hide()
		$('#RemoveStudentDiv').show()
	})
	
	$('#ShowAddStudent').click(() => {
		$('#AddStudentDiv').show()
		$('#RemoveStudentDiv').hide()
	})
});

$('#addStudentForm').submit((formData) => {
	formData.preventDefault()
	console.log(formData)
})