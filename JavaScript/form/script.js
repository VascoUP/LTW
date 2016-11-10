var products = ['ABCD', 'DEFG'];

// Setup the events only when document finished loading
window.addEventListener("load", function(){
  setUp();
}, true);

// Setup the events
function setUp() {
  addProducts();
  var text = document.getElementById("button");
  text.addEventListener("click", addCart, false);
}

// Adds array products to the products' select
function addProducts() {
  var select = document.getElementById("select");
  
  for( var i = 0; i < products.length; i++ ) {
    var option = document.createElement("option");
    option.value = products[i];
    option.innerHTML = products[i];
    select.appendChild(option);
  }
}

function addCart(event) {
  var text = event.target;

  var product = document.getElementById("select").value;
  var quantity = parseInt( document.getElementById("quantity").value );

  if( quantity == '' || !quantity )
	return ;
  
  var select = document.getElementById("cart");

  if( select.getElementsByTagName("tr").length == 0 ) {
    var thead = document.createElement("thead");
    var head_tr = document.createElement("tr");

    var head_element = document.createElement("td");  
    head_element.innerHTML = "Products";
    head_tr.appendChild(head_element);

    head_element = document.createElement("td");
    head_element.innerHTML = "Quantity";  
    head_tr.appendChild(head_element);

    thead.appendChild(head_tr);
    select.appendChild(thead);
  }

  var tr = document.createElement("tr");  
  var product_element = document.createElement("td");
  product_element.innerHTML = product;
  var quantity_element = document.createElement("td");
  quantity_element.innerHTML = quantity;

  tr.appendChild(product_element);  
  tr.appendChild(quantity_element);

  select.appendChild(tr);
}




