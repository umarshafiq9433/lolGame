$(document).ready(function () {
  console.log($("#amount5").val());
  var val3 = parseInt($("#amount5").val().slice(4));
  var price = 0;

  function count() {
    let val5 = 0;
    let val6 = 0;
    let val7 = 0;
    price = 2.1 * val3;
    if ($(".sc").is(":checked")) {
      val5 = price * 0.2;
    }
    if ($(".eo").is(":checked")) {
      val6 = price * 0.15;
    }
    if ($(".sb").is(":checked")) {
      val7 = price * 0.1;
    }
    price = price + val5 + val6 + val7;
    $(".tot").html(price.toFixed(2));
    $("#review_type").html("Normal Games Boosting");
    $("#review_price").html(price.toFixed(2));
    let review_boost = "Current Rank";
    $("#review_boost").html(review_boost);
    $("#review_server").html("All Servers");
  }
  count();

  $("#slider-range5").slider({
    change: function (event, ui) {
      val3 = parseInt($("#amount5").val().slice(4));
      count();
    },
  });

  $(".sc").on("change", function () {
    count();
  });

  $(".eo").on("change", function () {
    count();
  });

  $(".sb").on("change", function () {
    count();
  });
});
