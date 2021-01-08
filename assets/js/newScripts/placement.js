$(document).ready(function () {
  const placement = {
    unranked: 2,
    iron: 1.5,
    bronze: 1.7,
    silver: 2,
    gold: 2.9,
    platinum: 3.7,
    diamond: 5,
    master: 7,
    grandmaster: 8,
    challenger: 8,
  };

  const region2 = [100, 92, 110, 90, 90, 90, 90, 90, 100];
  var value = $(".netWinsRank2").val();
  var value3 = parseInt($("#amount6").val().slice(4));
  var value4 = $(".netWinsRegion2").val();
  var price1 = 0;

  function start2() {
    let value5 = 0;
    let value6 = 0;
    let value7 = 0;
    price1 = parseInt(placement[value]) * value3;
    price1 = price1 * (region2[value4] / 100);
    if ($(".sc2").is(":checked")) {
      value5 = price1 * 0.2;
    }
    if ($(".eo2").is(":checked")) {
      value6 = price1 * 0.15;
    }
    if ($(".sb2").is(":checked")) {
      value7 = price1 * 0.1;
    }
    price1 = price1 + value5 + value6 + value7;
    $(".tot").html(price1.toFixed(2));
    $("#review_type").html("Placement Boosting");
    $("#review_price").html(price1.toFixed(2));
    let review_boost =
      $(".netWinsRank2 option:selected").text() +
      " " +
      $(".netWinsDivision2 option:selected").text() +
      $("#amount6").val() +
      " Wins";
    $("#review_boost").html(review_boost);
    $("#review_server").html($(".netWinsRegion2 option:selected").text());
  }
  start2();

  $(".netWinsRank2").on("change", function () {
    value = $(this).val();
    setImage();
    start2();
  });

  $(".netWinsDivision").on("change", function () {
    setImage();
    start2();
  });

  $(".netWinsRegion2").on("change", function () {
    value4 = $(this).val();
    start2();
  });

  $("#slider-range6").slider({
    change: function (event, ui) {
      value3 = parseInt($("#amount6").val().slice(4));
      start2();
    },
  });

  $(".sc2").on("change", function () {
    start2();
  });

  $(".eo2").on("change", function () {
    start2();
  });

  $(".sb2").on("change", function () {
    start2();
  });
  function setImage() {
    let image = $(".netWinsRank2 option:selected").text();
    let div = $(".netWinsDivision").val();
    $(".rankImage").attr(
      "src",
      "assets/image/tiers/" + image + "" + div + ".png"
    );
    if (image == "Unranked") {
      $(".rankImage").attr("src", "assets/image/tiers/unranked.png");
    }
  }
});
