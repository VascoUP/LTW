var selected_tab = '#Rst_Menu_Ov';
var score_clicked = 'Score0';

$(document).ready( function() { load_restaurant(); } )

function load_restaurant () {
	menu_buttons();
	review_handlers();
	$(function() {
    		$(window).scroll(sticky_relocate);
    		sticky_relocate();
	});
}

function sticky_relocate() {
	var window_top = $(window).scrollTop();
	var div_top = $('#sticky-anchor').offset().top;
	if (window_top > div_top)
		$('#sticky-element').addClass('sticky');
	else
		$('#sticky-element').removeClass('sticky');
}

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

function get_score_color(id) {
	var color;
	switch(id) {
		case 'Score1':
			color = '#ff8806';
			break;
		case 'Score2':
			color = "#f4aa06";
			break;
		case 'Score3':
			color = "#eec606";
			break;
		case 'Score4':
			color = "#b5f406";
			break;
		case 'Score5':
			color = "#aaff06";
			break;
		default:
			color = "#aaa";
	}
	return color;
}

function get_score(id) {
	var score;
	switch(id) {
		case 'Score1':
			score = 1;
			break;
		case 'Score2':
			score = 2;
			break;
		case 'Score3':
			score = 3;
			break;
		case 'Score4':
			score = 4;
			break;
		case 'Score5':
			score = 5;
			break;
		default:
			score = 0;
	}
	return score;
}

function select_score(item, color) {
    	item.css("background-color", color);
}

function hover_score(hovered_li) {
	var id = hovered_li.attr("id");
	if( id == 'Total_Score' )
		return ;

	var isPastId = false;

	var listItems = $("#Add_Score li");
	listItems.each(function(idx, li) {
		if($(li).attr("id") != 'Total_Score') {
			if(isPastId)
				select_score( $(li), '#aaa' );
			else {
				select_score( $(li), get_score_color($(li).attr("id")) );
				if($(li).attr("id") == id)
					isPastId = true;
			}
		}
	});

	$('#Total_Score').html(get_score(id) + "");
}


function click_score(hovered_li) {
	score_clicked = hovered_li.attr("id");
}

function revert_hover_score() {
	var isPastId;
	if( score_clicked == 'Score0' ) {
		isPastId = true;
		$('#Total_Score').html("0");
	} else {
		isPastId = false;
		$('#Total_Score').html(get_score(score_clicked));
	}

	var listItems = $("#Add_Score li");
	listItems.each(function(idx, li) {
		if($(li).attr("id") != 'Total_Score') {			
			if(isPastId)
				select_score( $(li), '#aaa' );
			else {
				select_score( $(li), get_score_color($(li).attr("id")) );
				if($(li).attr("id") == score_clicked)
					isPastId = true;
			}
		}
	});
}

function score_buttons() {
	
	$('#Add_Score li').hover( function() {
			hover_score($(this));
		}, function() {	
			revert_hover_score();
		});

	$('#Add_Score li').click( function() {
			click_score($(this));
		});
}

function comment_area() {
	$('#Add_Score').show();
	$('#Submit_Review').show();
	$('#Review_Comment').attr('rows', '5');
}

function review_handlers() {
	console.debug($('#Review_Comment'));
	$('#Review_Comment').click( function() {
			comment_area();
		});
	score_buttons();
}
