(function ($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on("click", function (e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $(".sidebar .collapse").collapse("hide");
    }
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function () {
    if ($(window).width() < 768) {
      $(".sidebar .collapse").collapse("hide");
    }

    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
      $(".sidebar .collapse").collapse("hide");
    }
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $("body.fixed-nav .sidebar").on(
    "mousewheel DOMMouseScroll wheel",
    function (e) {
      if ($(window).width() > 768) {
        var e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
      }
    }
  );

  // Scroll to top button appear
  $(document).on("scroll", function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $(".scroll-to-top").fadeIn();
    } else {
      $(".scroll-to-top").fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on("click", "a.scroll-to-top", function (e) {
    var $anchor = $(this);
    $("html, body")
      .stop()
      .animate(
        {
          scrollTop: $($anchor.attr("href")).offset().top,
        },
        1000,
        "easeInOutExpo"
      );
    e.preventDefault();
  });

  // Landing Page hamburger
  $(document).ready(function () {
    // Function to handle sidebar toggle based on screen width
    function handleSidebarToggle() {
      var screenWidth = $(window).width();
      if (screenWidth <= 770) {
        // $("#homepage-sidebar").hide();
      } else {
        $("#homepage-sidebar").hide();
      }
    }

    // Initially hide or show the sidebar based on screen width
    handleSidebarToggle();

    // Toggle sidebar when the fa fa-bars button is clicked
    $("#sidebarToggleHomepage").click(function () {
      $("#homepage-sidebar").toggle();
    });

    // Check screen width on window resize
    $(window).resize(function () {
      handleSidebarToggle();
    });
  });

  // Slider indicator
  $(".carousel").on("slid.bs.carousel", function () {
    var slideIndex = $(".carousel-item.active").index();
    $(".carousel-indicators li").removeClass("active");
    $('.carousel-indicators li[data-slide-to="' + slideIndex + '"]').addClass(
      "active"
    );
  });

  $(document).ready(function () {
    // Check quantity on page load
    $("tr").each(function () {
      var quantity = parseInt($(this).find("td:eq(3)").text());
      if (quantity < 10) {
        $(this).addClass("low-quantity");
      }
    });
  });
})(jQuery); // End of use strict
