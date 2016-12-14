var categories = [ 'Restaurants', 'Categories' ];

$(document).ready( function() { search_categories() } )

function search_categories() {
	var categories_select = $('#search_bar').children().children('select');
	loadCategories(categories_select);
}

function loadCategories ( select ) {
	for( var i = 0; i < categories.length; i++ ) {
		select.append($('<option></option>', {
			value : categories[i],
			text : categories[i]
		}));
	}
}


