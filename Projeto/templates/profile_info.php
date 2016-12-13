<div class="profile_content">
	<div class="dashboard" id="left-dashboard">
		<div class="Curved_Edges Default_Info_Box">
			<div id="profile-photo">
				<img src="images/default_profile_picture.png" alt="profilePic" height="75" width="75">
			</div>
			<div id="profile-username">
				<h3>Username</h3>
			</div>
			<div class="profile-bio">
				<p>Super awesome bio cause I has best swag #YOLO</p>
			</div>
			
			<div style="clear: both;"></div>
			
			<div class="profile-stats">
				<ul class="Curved_Edges" id="Stat_Nav">
					<li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'reviews')" id="defaultOpen">
						<p align="right">Reviews</p>
						<p align="right">14</p>
					</a></li>
					<li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'favourites')">
						<p align="right">Favourites</p>
						<p align="right">2</p>
					</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="dashboard Curved_Edges Default_Info_Box" id="main">
		<div class="tabcontent" id="favourites">
<?php
	include ('templates/profile_favourite.php');
?>
<?php
	include ('templates/profile_favourite.php');
?>
		</div>
			
		<div class="tabcontent" id="reviews">
<?php
	include ('templates/profile_review.php');
?>
<?php
	include ('templates/profile_review.php');
?>
		</div>
	</div>

</div>


<script>
function openTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}
	
document.getElementById("defaultOpen").click();
</script>