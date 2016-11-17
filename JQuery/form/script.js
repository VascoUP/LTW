var products = [];

$(document).ready( function() { loadDocument() } )

function loadDocument () {
	var products_select = $('#products').children().children('select');

	$.getJSON('products.php', 
		function( data ) {
			products = data;

			loadProducts(products_select);	
		});

	window.alert($('#products input'));

	$('#products').children('input').last().click(
		function() {
			addLine();
		});
}

function loadProducts ( select ) {
	for( var i = 0; i < products.length; i++ ) {
		select.append($('<option></option>', {
			value : products[i],
			text : products[i]
		}));
	}
}

function addLine () {
	var line = $('#products').children().first().html();
	$('#products').children('input').before( $('<div class=\"line\">' + line + '</div>') );
}

