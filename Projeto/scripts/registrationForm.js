function loadFile(event) {
    var image = document.getElementById('imgRegProfilePic');
    image.src = URL.createObjectURL(event.target.files[0]);
}

function Validate() {
	//Get the password values
	var password = document.forms['vform']['password'];
	var confirmPassword = document.forms['vform']['passwordConfirm'];

	//Get div for error display
	var passwordConfirmError = document.getElementById('passwordConfirmError');

	//Validate Password
	if(password.value != confirmPassword.value) {
		password.style.border = "1px solid red";
		confirmPassword.style.border = "1px solid red";
		passwordConfirmError.innerHTML = "The two passwords do not match.";
		return false;
	}
	return true;
}
