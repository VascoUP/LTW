$(document).ready( function() { hearder_buttons() } )

function hearder_buttons () {
	loadHeaderHandlers( $('#log_site').children('li') );
	$('.black_screen').first().click(
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
	$('.black_screen').first().hide();
	$('#Login_Form').first().hide();
}

function registerButton () {
	console.debug(window.location.href);
    var url = (window.location.href).substring( 0, (window.location.href).lastIndexOf( "/" ) + 1) + "RegForm.php"
    console.debug(url);
    window.location.href = url;
}

function loginButton () {
	$('.black_screen').first().show('hidden');
	$('#Login_Form').first().show('hidden');
}

function logoutButton () {
	console.debug('Logout');
}
