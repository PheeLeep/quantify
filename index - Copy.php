<?php
session_start();
// Database connection
$conn = new mysqli("localhost", "root", "", "quantify");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//populating products
$sql = "SELECT p.*, c.Category_Name 
        FROM Product p
        LEFT JOIN Category c ON p.Category_ID = c.Category_ID";
$result = $conn->query($sql);

// Check if cart ID exists in session, if not create new cart
if (!isset($_SESSION['cartId'])) {
  $cartId = uniqid('cart_');
  $_SESSION['cartId'] = $cartId;
  $dateCreated = date('Y-m-d H:i:s');

  // Insert new cart into database
  $sql = "INSERT INTO cart (Cart_ID, Date_Created) VALUES ('$cartId', '$dateCreated')";
  if ($conn->query($sql) !== TRUE) {
      die("Error creating cart: " . $conn->error);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Quantify | Homepage</title>

    <!-- Custom fonts for this template-->
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <div id="homepage-sidebar" class="homepage-sidebar">
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="index.php"
        >
          <div class="sidebar-brand-icon">
            <img
              class="img-profile rounded-circle"
              src="img/sti-logo.svg"
              style="width: 54px; height: 51px"
            />
          </div>
          <!-- <div class="sidebar-brand-text mx-3">Quantify</div> -->
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <ul class="sidebar-nav homepage-btn">
          <li class="nav-item">
            <a class="nav-link" href="#"> <span>FAQ</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php"> <span>Login</span></a>
          </li> 
        </ul>
      </div>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="top-navbar navbar navbar-expand shadow sticky-top">
            <!-- Sidebar Toggle (Topbar) -->
            <button
              id="sidebarToggleHomepage"
              class="btn btn-link d-md-none rounded-circle mr-3"
            >
              <i class="fa fa-bars homepage-ham"></i>
            </button>

            <!-- Topbar Navbar -->
            <div class="nav-logo d-none d-md-block">
              <a
                class="sidebar-brand d-flex align-items-center justify-content-center"
                href="index.php"
              >
                <div class="sidebar-brand-icon">
                  <img
                    class="img-profile rounded-circle"
                    src="img/sti-logo.svg"
                    style="width: 50px; height: 50px"
                  />
                </div>
                <div class="display-text mx-3">Quantify</div>
              </a>
            </div>

            <ul class="navbar-button navbar-nav ml-auto">
              <li class="nav-item d-none d-md-block">
                <a class="nav-link" href="#">Campus Helpdesk</a>
              </li>
              <li class="nav-item d-none d-md-block">
                <a class="nav-link" href="#">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="alertsDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-shopping-cart shopping-cart"></i>
                  <!-- Counter - Alerts -->
                  <span class="badge badge-danger badge-counter">2</span>
                </a>
                <!-- Dropdown - Alerts -->
                <div
                  class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="alertsDropdown"
                >
                  <h6 class="dropdown-header">Shopping Cart</h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <!-- <div class="mr-3">
                      <img src="/img/undraw_profile.svg" class="img-thumbnail" style="width: 50px; height: 50px" alt="Product Image" />
                    </div> -->
                    <div>
                      <div>
                        <strong>BSIT | BSCS | BSCPE | Uniform</strong><br />
                        Price: P360.00<br />
                        Quantity: 3
                      </div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <img
                        src="/img/undraw_profile_2.svg"
                        class="img-thumbnail"
                        style="width: 50px; height: 50px"
                        alt="Product Image"
                      />
                    </div>
                    <div>
                      <div>
                        <strong>BSA Uniform</strong><br />
                        Price: P360.00<br />
                        Quantity: 1
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-footer text-center mt-4">
                    <button class="btn btn-primary">Checkout</button>
                  </div>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <div class="container-fluid content-bg">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between p-3">
              <h1 class="h3 mb-0 text-gray-800">Best Sellers</h1>
            </div>
          
            <!-- Best Seller Product -->
            <div id="best-sellers-carousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#best-sellers-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#best-sellers-carousel" data-slide-to="1"></li>
              </ol>
          
              <!-- Slides -->
              <div class="carousel-inner">
                <!-- Container 1 -->
                <div class="carousel-item active">
                  <div class="card-group">
                    <!-- Sample Product 1 -->
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                          BSIT | BSCS | BSCPE Uniform
                        </h6>
                      </div>
                      <div class="card-body">
                        <div class="text-center">
                          <img
                            class="img-fluid px-3 px-sm-4 mt-3 mb-4"
                            style="width: 12rem; height: 17rem"
                            src="img/uniform/bsit_bscs_bscpe-uniform.png"
                            alt="..."
                          />
                          <p>Gray 3/4 Polo</p>
                          <p>₱360.00</p>
                        </div>
                      </div>
                    </div>
                    <!-- Sample Product 2 -->
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                          BSTM Uniform
                        </h6>
                      </div>
                      <div class="card-body">
                        <div class="text-center">
                          <img
                            class="img-fluid px-3 px-sm-4 mt-3 mb-4"
                            style="width: 12rem; height: 17rem"
                            src="img/uniform/bstm-uniform.png"
                            alt="..."
                          />
                          <p>White Polo</p>
                          <p>₱360.00</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Container 2 -->
                <div class="carousel-item">
                  <div class="card-group">
                    <!-- Sample Product 3 -->
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                          BSA Uniform
                        </h6>
                      </div>
                      <div class="card-body">
                        <div class="text-center">
                          <img
                            class="img-fluid px-3 px-sm-4 mt-3 mb-4"
                            style="width: 12rem; height: 17rem"
                            src="img/uniform/bsa-uniform.png"
                            alt="..."
                          />
                          <p>Light Blue Polo</p>
                          <p>₱360.00</p>
                        </div>
                      </div>
                    </div>
                    <!-- Sample Product 4 -->
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                          BSHM Uniform
                        </h6>
                      </div>
                      <div class="card-body">
                        <div class="text-center">
                          <img
                            class="img-fluid px-3 px-sm-4 mt-3 mb-4"
                            style="width: 12rem; height: 17rem"
                            src="img/uniform/bshm-uniform.png"
                            alt="..."
                          />
                          <p>Blazer</p>
                          <p>₱360.00</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          
              <!-- Controls -->
              <a class="carousel-control-prev" href="#best-sellers-carousel" role="button" data-slide="prev" style="color: white">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#best-sellers-carousel" role="button" data-slide="next" style="color: white">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          
            <!-- Page Subheading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-0">
              <h1 class="h3 mb-0 text-gray-800">Products</h1>
            </div>
          
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <div class="w-100">
                <div class="row justify-content-end mt-4">
                  <!-- Sort -->
                  <div class="col-md-3">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="sortSelect">Sort by</label>
                      </div>
                      <select class="custom-select" id="sortSelect">
                        <option value="price-low-to-high">Price: Low to High</option>
                        <option value="price-high-to-low">Price: High to Low</option>
                        <option value="name-a-to-z">Name: A-Z</option>
                        <option value="name-z-to-a">Name: Z-A</option>
                      </select>
                    </div>
                  </div>
                  <!-- Filter -->
                  <div class="col-md-3">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="combinedFilter">Filter by</label>
                      </div>
                      <select class="custom-select" id="combinedFilter">
                        <option value="all">All Products</option>
                        <optgroup label="Program">
                          <option value="program-bsit">BSIT/BSCS/BSCpE/BSIS</option>
                          <option value="program-bstm">BSTM</option>
                          <option value="program-bshm">BSHM</option>
                          <option value="program-bshm">BSBA/BSA/BSAIS/BMMA/BSED</option>
                        </optgroup>
                        <optgroup label="Category">
                          <option value="category-pants">Pants</option>
                          <option value="category-blouse">Blouse</option>
                          <option value="category-polo">Polo</option>
                          <option value="category-coat">Coat</option>
                          <option value="category-shirt">Shirt</option>
                        </optgroup>
                        <optgroup label="Gender">
                          <option value="gender-male">Male</option>
                          <option value="gender-female">Female</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <!-- Search -->
                    <form class="mb-4">
                      <div class="input-group">
                        <input
                          type="text"
                          class="form-control bg-light border-2 small"
                          placeholder="Search for..."
                          aria-label="Search"
                          aria-describedby="basic-addon2"
                        />
                        <div class="input-group-append">
                          <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          
             <!-- Product -->
            <div class="container">
              <div class="row" id="products-container">
                  <?php if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) { ?>
                          <div class="col-lg-3 col-md-6 mb-4">
                              <div class="card shadow product-card" data-toggle="modal" data-target="#productDetailModal">
                                  <div class="card-header py-3">
                                      <h6 class="m-0 font-weight-bold text-primary"><?php echo $row['Category_Name']; ?></h6>
                                  </div>
                                  <div class="card-body text-center">
                                      <!-- Keeping static images for the products -->
                                      <img class="img-fluid px-3 px-sm-4 mt-3 mb-4 product-image" src="img/uniform/bstm-uniform.png" alt="White 3/4 Polo" />
                                      <p class="program d-none">BSTM</p>
                                      <p class="category d-none"><?php echo $row['Category_ID']; ?></p>
                                      <p class="gender d-none">Female</p>
                                      <p class="name"><?php echo $row['Name']; ?></p>
                                      <p class="price">₱<?php echo $row['Price']; ?></p>
                                      <p class="description d-none"><?php echo $row['Description']; ?></p>
                                  </div>
                              </div>
                          </div>
                  <?php } } else { ?>
                      <p>No products found</p>
                  <?php } ?>
              </div>
          </div>

          
            <!-- Pagination Controls -->
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center" id="pagination">
                <li class="page-item">
                  <a class="page-link" href="#" id="prev-btn" aria-label="Previous">
                    <span aria-hidden="true">Previous</span>
                  </a>
                </li>
                <!-- Numbered buttons will be inserted here by JavaScript -->
                <li class="page-item">
                  <a class="page-link" href="#" id="next-btn" aria-label="Next">
                    <span aria-hidden="true">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
          
            <!-- Content Row -->
            <div class="row"></div>
          </div>
          
        <!-- Product Detail Modal -->
          <div class="modal fade" id="productDetailModal" tabindex="-1" role="dialog" aria-labelledby="productDetailModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                              <h5 class="modal-title" id="productDetailModalLabel">Product Details</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                              <div class="row">
                                                <div class="col-md-5">
                                                <img id="modal-product-image" class="img-fluid" src="" alt="Product Image" />
                                                </div>
                                                <div class="col-md-7">
                                                <h3 id="modal-product-name"></h3>
                                                <p id="modal-product-price"></p>
                                                <p id="modal-product-description"></p>
                                              <form>
                                                <div class="form-group">
                                                <label for="product-size">Size</label>
                                                <select class="form-control" id="product-size">
                                                <option>Small</option>
                                                <option>Medium</option>
                                                <option>Large</option>
                                                <option>Extra Large</option>
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                <label for="product-quantity">Quantity</label>
                                                <input type="number" class="form-control" id="product-quantity" min="1" value="1" />
                                                </div>
                                              </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" id= "add-to-cart">Add to Cart</button>
                      </div>
                  </div>
              </div>
          </div>
          

          
      <script>
             document.querySelectorAll('.product-card').forEach(card => {
          card.addEventListener('click', function() {
            const productName = this.querySelector('.name').innerText;
            const productPrice = this.querySelector('.price').innerText;
            const productImage = this.querySelector('.product-image').src;
            const productDescription = this.querySelector('.description').innerText;
      
            document.getElementById('modal-product-name').innerText = productName;
            document.getElementById('modal-product-price').innerText = productPrice;
            document.getElementById('modal-product-image').src = productImage;
            document.getElementById('modal-product-description').innerText = productDescription; 
          });
        });
      </script>
        </div>
        <!-- End of Main Content -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/product/product-pagination.js"></script>
    <script src="js/product/product-sort-filter.js"></script>
    <script src="js/product/product-image.js"></script>
    <script src="js/product/product-details.js"></script>

    
  </body>
</html>

<?php
// Close connection
$conn->close();
?>
