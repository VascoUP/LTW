$(document).ready( function() { load_options(); } )

function load_options() {
	//Categories
	$(".Ov_Category img").on( "click", function () {
		delete_category($(this));
	});

	$("#Add_Category").click( function () {
		add_category($(this));
	});

	//Menu
	$(".Menu_Table img").on( "click", function () {
		delete_menu_item($(this));
	});	

	$("#Add_Menu_Item").click( function () {
		add_menu_item($(this));
	});
}


/*
	Categories
*/

function delete_category( category ) {
	category.parent().fadeOut();
	category.parent().remove();
}

function add_category( category ) {
	var categories = $("#Ov_Categories").children();
	var value = category.siblings("input").first().val();
	if( value == "" )
		return ;

	for( var i = 0; i < categories.length; i++ ) {
		if( value == $(categories[i]).children("h5").html() )
			return ;
	}

	
	$("#Ov_Categories").append("<li class='Ov_Category'><h5>"+ 
					value + 
					"</h5><img src='images/delete_icon.png' alt='Delete'></li>");	

	// Add click handler to the new element
	$(".Ov_Category img").last().on( "click", function () {
		delete_category($(this));
	});
}


/*
	Menu
*/

function delete_menu_item( item ) {
	item.parent().parent().fadeOut();
	item.parent().parent().remove();
}

function add_menu_item( item ) {
	console.debug("Oi?");

	var items = $(".Menu_Table").children().children();
	var food = item.siblings("#Menu_Item_Food").val();
	var price = item.siblings("#Menu_Item_Price").val();
	var category = item.siblings("#Menu_Item_Category").val();

	if( food == "" || category == "" || price <= 0 )
		return ;

	for( var i = 0; i < items.length; i++ ) {
		if( food == $(items[i]).children(".Menu_Food").html() ) 
			return ;
	}

	$(".Menu_Table").children().append("<tr><td class='Menu_Food'>" + food + "</td>" + 
					"<td class='Menu_Price'>"+ price + "</td>" + 
					"<td><img src='images/delete_icon.png' alt='Delete'></td></tr>");	

	// Add click handler to the new element
	$(".Menu_Table img").last().on( "click", function () {
		delete_menu_item($(this));
	});
}
