const sortSelect = document.getElementById("sortSelect");
// const combinedFilter = document.getElementById("combinedFilter");
const productsContainer = document.getElementById("products-container");

sortSelect.addEventListener("change", () => {
  const sortValue = sortSelect.value;
  sortProducts(sortValue);
});

// combinedFilter.addEventListener("change", () => {
//   const filterValue = combinedFilter.value;
//   filterProducts(filterValue);
// });

function sortProducts(sortValue) {
  const products = Array.from(productsContainer.children);
  products.sort((a, b) => {
    const priceA = parseFloat(a.querySelector("p:nth-child(3)").textContent);
    const priceB = parseFloat(b.querySelector("p:nth-child(3)").textContent);
    const nameA = a.querySelector("p:nth-child(2)").textContent;
    const nameB = b.querySelector("p:nth-child(2)").textContent;

    if (sortValue === "price-low-to-high") {
      return priceA - priceB;
    } else if (sortValue === "price-high-to-low") {
      return priceB - priceA;
    } else if (sortValue === "name-a-to-z") {
      return nameA.localeCompare(nameB);
    } else if (sortValue === "name-z-to-a") {
      return nameB.localeCompare(nameA);
    }
  });

  products.forEach((product) => productsContainer.appendChild(product));
}

// function filterProducts(filterValue) {
//   const products = Array.from(productsContainer.children);

//   products.forEach((product) => {
//     const program = product
//       .querySelector("p.program")
//       .textContent.toLowerCase();
//     const category = product
//       .querySelector("p.category")
//       .textContent.toLowerCase();
//     const gender = product.querySelector("p.gender").textContent.toLowerCase();

//     if (filterValue === "all") {
//       product.style.display = "block";
//     } else if (
//       filterValue.startsWith("program-") &&
//       program.includes(filterValue.split("-")[1])
//     ) {
//       product.style.display = "block";
//     } else if (
//       filterValue.startsWith("category-") &&
//       category.includes(filterValue.split("-")[1])
//     ) {
//       product.style.display = "block";
//     } else if (
//       filterValue.startsWith("gender-") &&
//       gender.includes(filterValue.split("-")[1])
//     ) {
//       product.style.display = "block";
//     } else {
//       product.style.display = "none";
//     }
//   });
// }
