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

function get_info_id ( opt_id ) {
	switch(opt_id) {
		case '#Rst_Menu_Ov':
			return '#Restaurant_Overview';
		case '#Rst_Menu_Mn':
			return '#Restaurant_Menu';
		case '#Rst_Menu_Rv':
			return '#Restaurant_Reviews';
		case '#Rst_Menu_Pht':
			return '#Restaurant_Photos';
		default:
			return '';
	}
}

function show_overview() {
	if( selected_tab == '#Rst_Menu_Ov' )
		return;

	$(selected_tab).children(".Selected_Item").attr("class","Unselected_Item");

	var div_id = get_info_id(selected_tab);
	$(div_id).fadeOut();
	$(div_id).hide();

	selected_tab = '#Rst_Menu_Ov';	

	div_id = get_info_id(selected_tab);
	$(div_id).fadeIn();
	$(div_id).show();

	$(selected_tab).children(".Unselected_Item").attr("class","Selected_Item");
}

function show_menu() {	
	if( selected_tab == '#Rst_Menu_Mn' )
		return;

	$(selected_tab).children(".Selected_Item").attr("class","Unselected_Item");

	var div_id = get_info_id(selected_tab);
	$(div_id).fadeOut();
	$(div_id).hide();

	selected_tab = '#Rst_Menu_Mn';

	div_id = get_info_id(selected_tab);
	$(div_id).fadeIn();
	$(div_id).show();

	$(selected_tab).children(".Unselected_Item").attr("class","Selected_Item");
}

function show_reviews() {
	if( selected_tab == '#Rst_Menu_Rv' )
		return;

	$(selected_tab).children(".Selected_Item").attr("class","Unselected_Item");

	var div_id = get_info_id(selected_tab);
	$(div_id).fadeOut();
	$(div_id).hide();

	selected_tab = '#Rst_Menu_Rv';

	div_id = get_info_id(selected_tab);
	$(div_id).fadeIn();
	$(div_id).show();

	$(selected_tab).children(".Unselected_Item").attr("class","Selected_Item");
}

function show_photos() {
	if( selected_tab == '#Rst_Menu_Pht' )
		return;

	$(selected_tab).children(".Selected_Item").attr("class","Unselected_Item");

	var div_id = get_info_id(selected_tab);
	$(div_id).fadeOut();
	$(div_id).hide();

	selected_tab = '#Rst_Menu_Pht';

	div_id = get_info_id(selected_tab);
	$(div_id).fadeIn();
	$(div_id).show();

	$(selected_tab).children(".Unselected_Item").attr("class","Selected_Item");
}
