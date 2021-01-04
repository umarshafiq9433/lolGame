(function ($) {
  "use strict";

  // scrollToTop activation
  $.scrollUp({
    scrollName: "scrollUp", // Element ID
    topDistance: "300", // Distance from top before showing element (px)
    topSpeed: 300, // Speed back to top (ms)
    animation: "fade", // Fade, slide, none
    animationInSpeed: 200, // Animation in speed (ms)
    animationOutSpeed: 200, // Animation out speed (ms)
    scrollText: '<i class="far fa-chevron-up"></i>', // Text for element
    activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
  });

  //mobile menu activation

  $(".menu-toggler").on("click", function () {
    $(".offcanves-menu, .offcanvas-overlay").addClass("active");
  });
  $(".close, .offcanvas-overlay").on("click", function () {
    $(".offcanves-menu, .offcanvas-overlay").removeClass("active");
  });

  //sticky header activation
  $("header .header-area").sticky({
    topSpacing: 0,
    className: "sticky",
  });

  //slick for slider area

  $(".slider-active").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    dots: true,
    arrows: false,
    vertical: true,
  });

  //slick for testimonial area

  $(".testimonial-active").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    //autoplay: true,
    autoplaySpeed: 3000,
    dots: false,
    arrows: false,
    centerMode: true,
    centerPadding: "0px",
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          dots: true,
        },
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 1,
          dots: true,
        },
      },
    ],
  });

  //slick for banner product slider

  $(".banner-product-active").slick({
    slidesToShow: 9,
    slidesToScroll: 1,
    //autoplay: true,
    autoplaySpeed: 3000,
    dots: false,
    arrows: true,
    centerMode: true,
    centerPadding: "0px",
    prevArrow: '<i class="fas fa-chevron-left left"></i>',
    nextArrow: '<i class="fas fa-chevron-right right"></i>',
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 6,
        },
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 5,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 4,
        },
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 3,
          centerPadding: "40px",
        },
      },
    ],
  });

  //slick for banner product slider

  $(".boost-product-active").slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    //autoplay: true,
    autoplaySpeed: 3000,
    dots: false,
    arrows: false,
    centerMode: true,
    centerPadding: "0px",
    prevArrow: '<i class="fas fa-chevron-left left"></i>',
    nextArrow: '<i class="fas fa-chevron-right right"></i>',
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 5,
        },
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 5,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 4,
        },
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 3,
          centerPadding: "40px",
        },
      },
    ],
  });

  //range slider activation

  $("#slider-range").slider({
    range: true,
    min: 0,
    max: 300,
    values: [0, 250],
    slide: function (event, ui) {
      $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
    },
  });
  $("#amount").val(
    "$" +
      $("#slider-range").slider("values", 0) +
      " - $" +
      $("#slider-range").slider("values", 1)
  );

  //range slider activation

  $("#slider-range2").slider({
    range: true,
    min: 0,
    max: 800,
    values: [0, 500],
    slide: function (event, ui) {
      $("#amount2").val("$" + ui.values[0] + " - $" + ui.values[1]);
    },
  });
  $("#amount2").val(
    "$" +
      $("#slider-range2").slider("values", 0) +
      " - $" +
      $("#slider-range2").slider("values", 1)
  );

  //range slider activation

  $("#slider-range3").slider({
    range: true,
    min: 0,
    max: 1000,
    values: [0, 700],
    slide: function (event, ui) {
      $("#amount3").val("$" + ui.values[0] + " - $" + ui.values[1]);
    },
  });
  $("#amount3").val(
    "$" +
      $("#slider-range3").slider("values", 0) +
      " - $" +
      $("#slider-range3").slider("values", 1)
  );

  //range slider activation

  $("#slider-range4").slider({
    range: true,
    min: 0,
    max: 10,
    values: [0, 7],
    slide: function (event, ui) {
      $("#amount4").val("" + ui.values[0] + " - " + ui.values[1]);
    },
  });
  $("#amount4").val(
    "" +
      $("#slider-range4").slider("values", 0) +
      " - " +
      $("#slider-range4").slider("values", 1)
  );

  //range slider activation

  $("#slider-range5").slider({
    range: true,
    min: 0,
    max: 30,
    values: [0, 15],
    slide: function (event, ui) {
      $("#amount5").val("" + ui.values[0] + " - " + ui.values[1]);
    },
  });
  $("#amount5").val(
    "" +
      $("#slider-range5").slider("values", 0) +
      " - " +
      $("#slider-range5").slider("values", 1)
  );
  //range slider activation

  $("#slider-range6").slider({
    range: true,
    min: 0,
    max: 10,
    values: [0, 7],
    slide: function (event, ui) {
      $("#amount6").val("" + ui.values[0] + " - " + ui.values[1]);
    },
  });
  $("#amount6").val(
    "" +
      $("#slider-range6").slider("values", 0) +
      " - " +
      $("#slider-range6").slider("values", 1)
  );
})(jQuery);
