// Setup the events only when document finished loading
window.addEventListener("load", function(){
  setUp();
}, true);

// Setup the events
function setUp() {
  var text = document.getElementById("country");
  text.addEventListener("keyup", countryChanged, false);
}

// Handler for change event on text input
function countryChanged(event) {
  var text = event.target;
  
  var request = new XMLHttpRequest();
  request.addEventListener("load", countriesReceived, false);
  request.open("get", "getcountries.php?name=" + text.value, true);
  request.send();
}

// Handler for ajax response received
function countriesReceived() {
  var countries = JSON.parse(this.responseText);
  var list = document.getElementById("suggestions");
  list.innerHTML = ""; // Clean current countries

  // Add new suggestions  
  for (country in countries) {
    var item = document.createElement("li");
    item.innerHTML = countries[country].name;
    list.appendChild(item);
  } 
}

