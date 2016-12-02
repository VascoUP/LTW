var selected_tab = '#Rst_Menu_Ov';

$(document).ready( function() { menu_buttons(); } )

function menu_buttons () {
	$('#Rst_Menu_Ov').click( function() {
			show_overview();
		});
	$('#Rst_Menu_Mn').click( function() {
			show_menu();
		});
	$('#Rst_Menu_Rv').click( function() {
			show_reviews();
		});
	$('#Rst_Menu_Pht').click( function() {
			show_photos();
		});
}

function show_overview() {
	if( selected_tab == '#Rst_Menu_Ov' )
		return;

	$(selected_tab).children(".Selected_Item").attr("class","Unselected_Item");

	selected_tab = '#Rst_Menu_Ov';

	$(selected_tab).children(".Unselected_Item").attr("class","Selected_Item");
}

function show_menu() {	
	if( selected_tab == '#Rst_Menu_Mn' )
		return;

	$(selected_tab).children(".Selected_Item").attr("class","Unselected_Item");

	selected_tab = '#Rst_Menu_Mn';

	$(selected_tab).children(".Unselected_Item").attr("class","Selected_Item");
}

function show_reviews() {
	if( selected_tab == '#Rst_Menu_Rv' )
		return;

	$(selected_tab).children(".Selected_Item").attr("class","Unselected_Item");

	selected_tab = '#Rst_Menu_Rv';

	$(selected_tab).children(".Unselected_Item").attr("class","Selected_Item");
}

function show_photos() {
	if( selected_tab == '#Rst_Menu_Pht' )
		return;

	$(selected_tab).children(".Selected_Item").attr("class","Unselected_Item");

	selected_tab = '#Rst_Menu_Pht';

	$(selected_tab).children(".Unselected_Item").attr("class","Selected_Item");
}
