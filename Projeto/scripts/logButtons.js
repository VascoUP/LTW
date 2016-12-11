$(document).ready( function() { hearder_buttons() } )

function hearder_buttons () {
	loadHeaderHandlers( $('#log_site').children('li') );
	$('.black-screen').first().click(
		function() {
			hideForms();
		});
}

function loadHeaderHandlers ( liElems ) {
	for( var i = 0; i < liElems.length; i++ ) {	
		var type = $(liElems[i]).children('form').attr('id');
		if( type == 'Logout_Button' ) {
			$(liElems[i]).children('form').click(
				function() {
					logoutButton();
			});
		} else if( type == 'Login_Button') {
			$(liElems[i]).children('form').click(
				function() {
					loginButton();
			});
		} else if( type == 'Reg_Button') {
			$(liElems[i]).children('form').click(
				function() {
					registerButton();
			});
		}
	}
}

function hideForms () {
	$('.black-screen').first().fadeOut(300);
	$('#login-form').first().fadeOut(300);
}

function registerButton () {
    var url = (window.location.href).substring( 0, (window.location.href).lastIndexOf( "/" ) + 1) + "RegForm.php"
    console.debug(url);
    window.location.href = url;
}

function loginButton () {
	$('.black-screen').first().fadeIn(300);
	$('#login-form').first().fadeIn(300);
}

function logoutButton () {
	console.debug('Logout');
}

function loadFile(value) {
	var $profilePicture = $('#login-profile-picture');

    if(value != "") {
    	$.ajax({
			type:"POST",
			url: "Database/user.php",
			data: {
				action: 'getProfilePicture',
				username: value
			},
			success: function(data) {
				$picture = JSON.parse(data).ProfilePicture;
				var url = "Database/ProfilePictures/".concat($picture);
				if($picture && $picture != "NULL") {
					$profilePicture.fadeOut(0).attr('src', url).fadeIn(500);
				} else {
					if($profilePicture.attr('src') != 'images/no-user-image.jpg') {
    					$profilePicture.fadeOut(0).attr('src', 'images/no-user-image.jpg').fadeIn(250);
    				}
				}
			}
		});
    } else {
    	if($profilePicture.attr('src') != 'images/no-user-image.jpg') {
    		$profilePicture.fadeOut(0).attr('src', 'images/no-user-image.jpg').fadeIn(250);
    	}
    }
}
