$(document).ready(function () {
  // Initialize a variable to keep track of the selected buttons
  var selectedButtons = {};

  // Add a click event listener to each thumbs up and thumbs down button
  $(".btn").on("click", function () {
    // Get the parent comment div
    var commentDiv = $(this).closest(".shadow");

    // Get the ID of the comment div
    var commentId = commentDiv.attr("id");
    console.log(commentId);

    // Get the type of button (thumbs up or thumbs down)
    var buttonType = $(this).find("i").hasClass("fa-thumbs-up")
      ? "thumbsUp"
      : "thumbsDown";

    // Check if the button is already selected for this comment
    if (
      selectedButtons.hasOwnProperty(commentId) &&
      selectedButtons[commentId] === buttonType
    ) {
      // Deselect the button
      $(this).removeClass("btn-primary");
      delete selectedButtons[commentId];
    } else {
      // Select the button and deselect the other button (if any)
      commentDiv.find(".btn").removeClass("btn-primary");
      $(this).addClass("btn-primary");
      selectedButtons[commentId] = buttonType;
      console.log(selectedButtons);
    }
  });

  // Add a click event listener to the "check ratings" button
  $(".btn-primary").on("click", function () {
    // Initialize variables to keep track of the number of thumbs up and thumbs down
    var thumbsUpCount = 0;
    var thumbsDownCount = 0;

    // Loop through each comment div
    $(".shadow").each(function () {
      // Get the ID of the comment div
      var commentId = $(this).attr("id");

      // Check if a thumbs up or thumbs down button is selected
      if (selectedButtons.hasOwnProperty(commentId)) {
        if (selectedButtons[commentId] === "thumbsUp") {
          thumbsUpCount++;
        } else if (selectedButtons[commentId] === "thumbsDown") {
          thumbsDownCount++;
        }
      }
    });

    // Show an alert with the total number of thumbs up and thumbs down
    alert("Thumbs up: " + thumbsUpCount + "\nThumbs down: " + thumbsDownCount);
  });
});
