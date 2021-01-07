$(document).ready(function () {
  const prices = [
    6,
    6.5,
    6.5,
    7,
    8,
    8.5,
    8.5,
    10,
    10.5,
    10.5,
    12,
    14.5,
    17.5,
    18.5,
    20,
    22,
    26.5,
    30,
    33,
    37.5,
    75,
    84.5,
    115,
    175,
  ];
  const region = [100, 92, 110, 90, 90, 90, 90, 90, 100];
  const lp = [100, 95, 80, 65, 55];
  const lpGain = [100, 110, 135, 160, 190, 190, 190, 190, 190];

  var currentRank = $(".currentRank").val();
  var currentDivision = $(".currentDivision").val();
  var desiredRank = $(".desiredRank").val();
  var desiredDivision = $(".desiredDivision").val();
  var lpVal = $(".lp").val();
  var lpGainVal = $(".lpGain").val();
  var regionVal = $(".region").val();
  function count() {
    let current = parseInt(currentRank) * 4 + parseInt(currentDivision);
    let desired = parseInt(desiredRank) * 4 + parseInt(desiredDivision);
    let val5 = 0;
    let val6 = 0;
    let val7 = 0;
    if (desired >= 24) {
      desired = 24;
    }
    let sum = 0;
    for (let i = current; i < desired; i++) {
      sum += prices[i];
    }
    let price = sum;
    price = price * (lp[lpVal] / 100);
    price = price * (lpGain[lpGainVal] / 100);
    price = price * (region[regionVal] / 100);
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
    $("#review_type").html("League Boosting");
    $("#review_price").html(price);
    let review_boost =
      $(".currentRank option:selected").text() +
      " " +
      $(".currentDivision option:selected").text() +
      " to " +
      $(".desiredRank option:selected").text() +
      " " +
      $(".desiredDivision option:selected").text();
    $("#review_boost").html(review_boost);
    $("#review_server").html($(".region option:selected").text());
    $(".days").html(desired - current);
    if (desired - current == 21) {
      $(".days").html("30");
    }
  }
  count();
  $(".currentRank").on("change", function () {
    currentRank = $(this).val();
    let image = $(".currentRank option:selected").data("name");
    $(".currentRankImage").attr("src", "assets/image/tiers/" + image + ".png");
    count();
  });
  $(".currentDivision").on("change", function () {
    currentDivision = $(this).val();
    count();
  });
  $(".desiredRank").on("change", function () {
    desiredRank = $(this).val();
    let image = $(".desiredRank option:selected").data("name");
    $(".desiredRankImage").attr("src", "assets/image/tiers/" + image + ".png");
    count();
  });
  $(".desiredDivision").on("change", function () {
    desiredDivision = $(this).val();
    count();
  });
  $(".lp").on("change", function () {
    lpVal = $(this).val();
    count();
  });
  $(".lpGain").on("change", function () {
    lpGainVal = $(this).val();
    count();
  });
  $(".region").on("change", function () {
    regionVal = $(this).val();
    count();
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
