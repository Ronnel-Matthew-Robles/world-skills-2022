$(document).ready(function () {
  var selectedButtons = {};

  $(".btn").on("click", function () {
    var commentDiv = $(this).closest(".shadow");
    var commentId = commentDiv.attr("id");

    var buttonType = $(this).find("i").hasClass("fa-thumbs-up")
      ? "thumbsUp"
      : "thumbsDown";

    if (
      selectedButtons.hasOwnProperty(commentId) &&
      selectedButtons[commentId] === buttonType
    ) {
      $(this).removeClass("btn-primary");
      delete selectedButtons[commentId];
    } else {
      commentDiv.find(".btn").removeClass("btn-primary");
      $(this).addClass("btn-primary");
      selectedButtons[commentId] = buttonType;
    }
  });

  $(".btn-primary").on("click", function () {
    var thumbsUpCount = 0;
    var thumbsDownCount = 0;

    $(".shadow").each(function () {
      var commentId = $(this).attr("id");
      if (selectedButtons.hasOwnProperty(commentId)) {
        if (selectedButtons[commentId] === "thumbsUp") {
          thumbsUpCount++;
        } else if (selectedButtons[commentId] === "thumbsDown") {
          thumbsDownCount++;
        }
      }
    });

    alert("Thumbs up: " + thumbsUpCount + "\nThumbs down: " + thumbsDownCount);
  });
});
