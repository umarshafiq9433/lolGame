$(document).ready(function () {
  const arr = {
    iron: [1.9, 1.9, 1.9, 1.9],
    bronze: [2, 2, 2, 2],
    silver: [2.2, 2.4, 2.6, 2.8],
    gold: [3, 3.2, 3.4, 3.6],
    platinum: [4.6, 5.6, 6.6, 7.7],
    diamond: [9.9, 12.1, 15.3, 18.5],
    master: [22],
    grandmaster: [26.6],
    challenger: [29],
  };

  const region = [100, 92, 110, 90, 90, 90, 90, 90, 100];
  var val = $(".netWinsRank").val();
  var val2 = $(".netWinsDivision").val();
  var val3 = parseInt($("#amount4").val().slice(4));
  var val4 = $(".netWinsRegion").val();
  var price = 0;

  function start() {
    let val5 = 0;
    let val6 = 0;
    let val7 = 0;
    price = arr[val][val2] * val3;
    price = price * (region[val4] / 100);
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
    $("#review_type").html("Net Win Boosting");
    $("#review_price").html(price.toFixed(2));
    let review_boost =
      $(".netWinsRank option:selected").text() +
      " " +
      $(".netWinsDivision option:selected").text() +
      " " +
      $("#amount4").val() +
      " Wins";
    $("#review_boost").html(review_boost);
    $("#review_server").html($(".netWinsRegion option:selected").text());
  }
  start();

  $(".netWinsRank").on("change", function () {
    val = $(this).val();
    setImage();
    if (val == "master" || val == "grandmaster" || val == "challenger") {
      $(".divi").addClass("d-none");
      $(".ran").addClass("wid");
      val2 = 0;
    } else {
      $(".divi").removeClass("d-none");
      $(".ran").removeClass("wid");
    }
    start();
  });

  $(".netWinsDivision").on("change", function () {
    val2 = $(this).val();
    setImage();
    start();
  });

  $(".netWinsRegion").on("change", function () {
    val4 = $(this).val();
    start();
  });

  $("#slider-range4").slider({
    change: function (event, ui) {
      val3 = parseInt($("#amount4").val().slice(4));
      start();
    },
  });

  $(".sc").on("change", function () {
    start();
  });

  $(".eo").on("change", function () {
    start();
  });

  $(".sb").on("change", function () {
    start();
  });
  function setImage() {
    let image = $(".netWinsRank option:selected").text();
    let div = $(".netWinsDivision").val();
    $(".rankImage").attr(
      "src",
      "assets/image/tiers/" + image + "" + div + ".png"
    );
  }
});
