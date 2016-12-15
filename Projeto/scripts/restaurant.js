var selected_tab = '#Rst_Menu_Ov';
var score_clicked = 'Score0';
var products = [];

$(document).ready( function() { load_restaurant(); } )

function load_restaurant () {
	load_profile_picture();

	var nSelected = get_type_value('opt');
	if( nSelected != "" )
		show_by_id(nSelected);

	menu_buttons();
	review_handlers();

	$(function() {
    		$(window).scroll(sticky_relocate);
    		sticky_relocate();
	});
}

function getRestaurantID() {
	$url = $(location).attr('href');
	return $url.substring($url.indexOf("id") + 3, $url.indexOf("id") + 4);
}

function load_profile_picture() {
	var id = getRestaurantID();
	$.ajax({
		type:"POST",
		url: "Database/restaurant.php",
		data: {
			action: 'getRestaurantProfilePicture',
			restaurantID: id
		},
		success: function(result) {
			if( !result )
				return ;
			$picture = JSON.parse(result).Name;
			var url = "Database/RestaurantPictures/Originals/".concat($picture);
			$('.Restaurant_Photo').css('background-image', "url("+url+")");
		}
	});
}

function get_type_value (type) {
	var hash = location.hash.replace(/^.*?#/, '');
	var pairs = hash.split('&');

	for( var i = 0; i < pairs.length; i++ ) {
		var split_pair = pairs[i].split('=');
		if( split_pair[0] == type )
			return '#' + split_pair[1];
	}
	return "";
}

function url_add_value (type, value) {

	var hash = location.hash.replace(/^.*?#/, '');
	if( hash == '' ) {
		window.location.href = window.location.href +
				"#" + type +
				"=" + value;
		return ;
	}

	var pairs = hash.split('&');
	var division_char = '';

	window.location.hash="";

	for( var i = 0; i < pairs.length; i++ ) {
		var split_pair = pairs[i].split('=');

		if( split_pair[0] != type ) {
			window.location.href = window.location.href +
						division_char + split_pair[0] +
						"=" + split_pair[1];
			if( division_char == '' )
				division_char = '&';
		}
	}

	window.location.href = window.location.href +
			division_char + type +
			"=" + value;
}

function menu_buttons () {
	$('#Restaurant_Nav li').click( function(event) {
			show_by_id('#' + $(this).attr("id"));
			event.preventDefault();
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

function show_by_id(id) {
	switch(id) {
		case '#Rst_Menu_Ov':
			return show_overview();
		case '#Rst_Menu_Mn':
			return show_menu();
		case '#Rst_Menu_Rv':
			return show_reviews();
		case '#Rst_Menu_Pht':
			return show_photos();
		default:
			return ;
	}
}

function show_overview() {
	if( selected_tab == '#Rst_Menu_Ov' )
		return;

	url_add_value('opt', 'Rst_Menu_Ov');

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

	url_add_value('opt', 'Rst_Menu_Mn');

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

	url_add_value('opt', 'Rst_Menu_Rv');

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

	url_add_value('opt', 'Rst_Menu_Pht');

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

function sticky_relocate() {
	var window_top = $(window).scrollTop();
	var div_top = $('#sticky-anchor').offset().top;
	if (window_top > div_top)
		$('#sticky-element').addClass('sticky');
	else
		$('#sticky-element').removeClass('sticky');
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
}

function review_handlers() {
	$('#Review_Comment').click( function() {
		comment_area();

	});
	$("textarea").click( function() {
		$(this).attr('rows', 5);
	})
	score_buttons();
}

function hidePopup() {
	$("#PopupImage").attr("src", "");
	$("#PopupWrapper").css("display", "none");
}

function showPicturePopUp($src, $alt) {
	$ImageName = $src.split("/").pop();
	$OriginalSrc = "Database/RestaurantPictures/Originals/".concat($ImageName);

	$("#PopupImage").attr("src", $OriginalSrc);
	$("PopupCaption").text($alt);
	$("#PopupWrapper").css("display", "block");
}

function updateReviews() {
	$score = $("#Total_Score").text();
	$review = $("#Review_Comment").val();
	$restaurantID = getRestaurantID();
	var $result;

	$.ajax({
		type:"POST",
		url: "Database/restaurant.php",
		async: false,
		data: {
			action: 'insertReviews',
			score: $score,
			content: $review,
			restaurantID: $restaurantID
		},
		success: function(result) {
			$result = JSON.parse(result);
		}
	});

/*
<div class="ReviewInfo">
	<p class="ReviewUsername">
	<?php
		echo $review['Username'];
	?>
	</p>
	<p class="ReviewScore">
	<?php
		echo $review['Score'];
	?>
	</p>
	<p class="GeneralDate">
	<?php
		echo $review['DateReview'];
	?>
	</p>
	<div class="GeneralContent">
	<?php
		echo $review['Content'];
	?>
	</div>
</div>

*/
	$insertHtml = "<div class='RestaurantReview'> \
						<div class='ReviewInfo'>\
							<p class='ReviewUsername'>\
								" + $result['username'] + "\
							</p>\
							<p class='ReviewScore'>\
								" + $score + "\
							</p>\
							<p class='GeneralDate'>\
								" + $result['Date'] + "\
							</p>\
						</div>\
						<div class='GeneralContent'>\
							" + $review + "\
						</div>\
					</div>";

	$("#Review_Form").before($insertHtml);

	$('#Add_Score .Unselected_Score').each(function() {
		$(this).css("background-color", "#aaa");
	});

	$('#Total_Score').text(0);
	$('#Review_Comment').val("").blur();
}

function updateReplys(elem) {
	$reviewID = $(elem).data("id");
	$showmoreButton = $("input[data-id="+$reviewID+"]");
	$content = $textarea.val();
	if( $content == "" )
		return ;
	var $result;

	$.ajax({
		type:"POST",
		url: "Database/restaurant.php",
		async: false,
		data: {
			action: 'insertReply',
			reviewID: $reviewID,
			content: $content
		},
		success: function(result) {
			$result = JSON.parse(result);
		}
	});

	$insertHtml = "<div class='ReviewReply'>\
						<div class='CommentInfo'>\
							<p class='CommentUsername'>\
								" + $result['username'] + " \
							</p>\
							<p class='GeneralDate'>\
								" + $result['Date'] + "\
							</p>\
						</div>\
						<div class='GeneralContent'>\
							" + $content + "\
						</div>\
					</div>";

	$showmoreButton.before($insertHtml).val("").blur();
}

function showReplyForm(elem) {
	$reviewID = $(elem).data("id");

	$("div[data-id="+$reviewID+"]").toggle(200);
}

function updateFavorite(elem) {
	$favoriteStar = $("#favoriteStar");
	$restaurantID = getRestaurantID();

	if($(elem).is(":checked")) {
		$favoriteStar.css("color", "yellow");

		$.ajax({
			type:"POST",
			url: "Database/user.php",
			data: {
				action: 'insertFavorite',
				restaurantID: $restaurantID
			}
		});
	}
	else {
		$favoriteStar.css("color", "black");

		$.ajax({
			type:"POST",
			url: "Database/user.php",
			data: {
				action: 'removeFavorite',
				restaurantID: $restaurantID
			}
		});
	}
}
