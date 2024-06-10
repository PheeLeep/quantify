// Attach a click event listener to all elements with the 'card' class
$(".card").on("click", function () {
  // Get the product details from the clicked card
  var productName = $(this).find(".name").text();
  var productProgram = $(this).find(".program").text();
  var productCategory = $(this).find(".category").text();
  var productGender = $(this).find(".gender").text();
  var productPrice = $(this).find(".price").text();

  // Set the product details in the modal
  $("#productModal").find(".modal-title").text(productName);
  $("#productModal")
    .find(".modal-body")
    .html(
      "<p>Program: " +
        productProgram +
        "</p>" +
        "<p>Category: " +
        productCategory +
        "</p>" +
        "<p>Gender: " +
        productGender +
        "</p>" +
        "<p>Price: " +
        productPrice +
        "</p>"
    );

  // Show the modal
  $("#productModal1").modal("show");
});
