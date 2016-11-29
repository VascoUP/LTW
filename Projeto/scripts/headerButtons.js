$(document).ready( function() { loadDocument() } )

function loadDocument () {
	loadHeaderHandlers( $('header').children('ul').last().children('li') );
	$('.Black_Screen').first().click(
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
	$('.Black_Screen').first().hide();
	$('#Reg_Form').first().hide();
	$('#Login_Form').first().hide();
}

function registerButton () {
	$('.Black_Screen').first().show('hidden');
	$('#Reg_Form').first().show('hidden');
}

function loginButton () {
	$('.Black_Screen').first().show('hidden');
	$('#Reg_Form').first().show('hidden');
}

function logoutButton () {
	console.debug('Logout');
}

/*
function addLine () {
	var line = $('#products').children().first().html();
	$('#products').children('input').before( $('<div class=\"line\">' + line + '</div>') );
}*/
