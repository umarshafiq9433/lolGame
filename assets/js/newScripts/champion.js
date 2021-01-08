$(document).ready(function () {
  var tier1 = $(".tier1").val();
  var tier2 = $(".tier2").val();
  var serve = $(".tierRegion").val();
  const tier = [3, 6, 12, 15, 22, 27];
  const server = [100, 92, 110, 90, 90, 90, 90, 90, 100];
  var price = 0;
  function count() {
    let v1 = 0;
    let v2 = 0;
    let v3 = 0;
    let sum = 0;
    for (i = tier1 - 1; i < tier2 - 1; i++) {
      sum += tier[i];
    }
    price = sum * (server[serve] / 100);
    if ($(".sc3").is(":checked")) {
      v1 = price * 0.2;
    }
    if ($(".eo3").is(":checked")) {
      v2 = price * 0.15;
    }
    if ($(".sb3").is(":checked")) {
      v3 = price * 0.1;
    }
    price = price + v1 + v2 + v3;
    $(".tot").html(price.toFixed(2));
    $("#review_type").html("Champion Mastery Boosting");
    $("#review_price").html(price);
    let review_boost =
      $(".tier1 option:selected").text() +
      " to " +
      $(".tier2 option:selected").text() +
      " " +
      " Champion " +
      $(".champion option:selected").text();
    $(".desiredDivision option:selected").text();
    $("#review_boost").html(review_boost);
    $("#review_server").html($(".tierRegion option:selected").text());
  }
  count();
  $(".tier1").on("change", function () {
    tier1 = $(this).val();
    count();
  });
  $(".tier2").on("change", function () {
    tier2 = $(this).val();
    count();
  });
  $(".tierRegion").on("change", function () {
    serve = $(this).val();
    count();
  });
  $(".sc3").on("change", function () {
    count();
  });

  $(".eo3").on("change", function () {
    count();
  });

  $(".sb3").on("change", function () {
    count();
  });
  $(".champion").on("change", function () {
    $(".championImage").attr(
      "src",
      "./assets/image/champions/" +
        $(".champion option:selected").text() +
        ".png"
    );
    count();
  });
});
