var categories = [ 'Restaurants', 'Categories' ];

$(document).ready( function() { loadDocument() } )

function loadDocument () {
	var categories_select = $('#search_bar').children().children('select');
	console.debug(categories_select);
	loadCategories(categories_select);	

	/*$.getJSON('products.php', 
		function( data ) {
			products = data;

			loadProducts(products_select);	
		});

	window.alert($('#products input'));
	*/
}

function loadCategories ( select ) {
	for( var i = 0; i < categories.length; i++ ) {
		select.append($('<option></option>', {
			value : categories[i],
			text : categories[i]
		}));
	}
}


