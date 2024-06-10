document.addEventListener("DOMContentLoaded", function () {
  const productsContainer = document.getElementById("products-container");
  const products = Array.from(productsContainer.children);
  const itemsPerPage = 4;
  let currentPage = 1;
  const totalPages = Math.ceil(products.length / itemsPerPage);

  const paginationContainer = document.getElementById("pagination");
  const prevBtn = document.getElementById("prev-btn");
  const nextBtn = document.getElementById("next-btn");

  function showPage(page) {
    products.forEach((product, index) => {
      product.style.display =
        index >= (page - 1) * itemsPerPage && index < page * itemsPerPage
          ? "block"
          : "none";
    });

    currentPage = page;
    updatePaginationButtons();
  }

  function createPaginationButtons() {
    // Remove existing number buttons
    const existingButtons =
      paginationContainer.querySelectorAll(".page-number");
    existingButtons.forEach((button) => button.remove());

    // Create new number buttons
    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement("li");
      li.classList.add("page-item", "page-number");
      if (i === currentPage) li.classList.add("active");

      const a = document.createElement("a");
      a.classList.add("page-link");
      a.href = "#";
      a.textContent = i;
      a.addEventListener("click", function (e) {
        e.preventDefault();
        showPage(i);
      });

      li.appendChild(a);
      paginationContainer.insertBefore(li, nextBtn.parentElement);
    }
  }

  function updatePaginationButtons() {
    prevBtn.parentElement.classList.toggle("disabled", currentPage === 1);
    nextBtn.parentElement.classList.toggle(
      "disabled",
      currentPage === totalPages
    );

    // Update active class on number buttons
    const numberButtons = paginationContainer.querySelectorAll(".page-number");
    numberButtons.forEach((button) => button.classList.remove("active"));
    numberButtons[currentPage - 1].classList.add("active");
  }

  prevBtn.addEventListener("click", function (e) {
    e.preventDefault();
    if (currentPage > 1) {
      showPage(currentPage - 1);
    }
  });

  nextBtn.addEventListener("click", function (e) {
    e.preventDefault();
    if (currentPage < totalPages) {
      showPage(currentPage + 1);
    }
  });

  // Initial setup
  createPaginationButtons();
  showPage(currentPage);
});
