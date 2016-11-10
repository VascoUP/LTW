// Setup the events only when document finished loading
window.addEventListener("load", function(){
  setUp();
}, true);

// Setup the events
function setUp() {
  var select = document.getElementById("colors");
  select.addEventListener("change", colorChanged, false);
  
  var button = document.getElementsByTagName("input")[1]; // We want the second input
  button.addEventListener("click", addColor, false);
}

// Handler for change event on color select
function colorChanged(event) {
  var paragraphs = document.getElementsByTagName("p"); // Get all paragraphs
  for (var i = 0; i < paragraphs.length; i++)
    paragraphs[i].style.color = event.target.value;    // event.target as the SelectElement
}

// Handler for add button click
function addColor() {
  var text = document.getElementsByTagName("input")[0];
  var select = document.getElementById("colors");
  
  var option = document.createElement("option");
  option.value = text.value;
  option.innerHTML = text.value;
  select.appendChild(option);
}
