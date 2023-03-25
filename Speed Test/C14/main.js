// Get references to the HTML elements
const fileInput = document.getElementById("file-input");
const imageContainer = document.getElementById("image-container");
const colorInfo = document.getElementById("color-info");
const magnifyingCanvas = document.getElementById("magnifying-canvas");
const magnifyingContext = magnifyingCanvas.getContext("2d");

// Create variables to store the image and its dimensions
let image = null;
let imageWidth = 0;
let imageHeight = 0;

// Create variables to store the magnification position and radius
let magnifyingX = 0;
let magnifyingY = 0;
let magnifyingRadius = 7;

// Load the selected image and display it on the webpage
fileInput.addEventListener("change", function () {
  const file = fileInput.files[0];
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = function (event) {
    image = new Image();
    image.src = event.target.result;
    image.onload = function () {
      imageWidth = image.width;
      imageHeight = image.height;
      imageContainer.innerHTML = "";
      imageContainer.appendChild(image);
      imageContainer.style.width = `${imageWidth}px`;
      imageContainer.style.height = `${imageHeight}px`;
      magnifyingCanvas.width = magnifyingCanvas.height = magnifyingRadius * 2;
      magnifyingContext.fillStyle = "white";
      magnifyingContext.strokeStyle = "black";
      magnifyingContext.lineWidth = 1;

      // Create a small red square to indicate the pixel being recognized
      magnifyingContext.fillStyle = "red";
      magnifyingContext.fillRect(
        magnifyingRadius - 2,
        magnifyingRadius - 2,
        4,
        4
      );
    };
  };
});

// Add an event listener for mouse movement over the image
imageContainer.addEventListener("mousemove", function (event) {
  // Get the mouse position relative to the image
  const rect = imageContainer.getBoundingClientRect();
  const x = event.clientX - rect.left;
  const y = event.clientY - rect.top;

  // Create a canvas element and draw the image onto it
  const canvas = document.createElement("canvas");
  canvas.width = imageWidth;
  canvas.height = imageHeight;
  const context = canvas.getContext("2d");
  context.drawImage(image, 0, 0, imageWidth, imageHeight);

  // Get the color at the mouse position
  const pixel = context.getImageData(x, y, 1, 1).data;
  const color = `rgb(${pixel[0]}, ${pixel[1]}, ${pixel[2]})`;
  colorInfo.innerHTML = `Color code: ${color}<br>Color: <span style="background-color: ${color};">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>`;

  // Update the magnifying position
  magnifyingX = x;
  magnifyingY = y;

  // Draw the magnifying glass
  drawMagnifyingGlass();
});

// Add an event listener for mouse leaving the image
imageContainer.addEventListener("mouseleave", function (event) {
  // Clear the color info and hide the magnifying glass
  colorInfo.innerHTML = "";
  magnifyingCanvas.style.display = "none";
});

// Function to draw the magnifying glass
function drawMagnifyingGlass() {
  // Clear the magnifying canvas
  magnifyingContext.clearRect(
    0,
    0,
    magnifyingCanvas.width,
    magnifyingCanvas.height
  );

  // Draw the magnified area
  magnifyingContext.save();
  magnifyingContext.beginPath();
  magnifyingContext.arc(
    magnifyingRadius,
    magnifyingRadius,
    magnifyingRadius,
    0,
    2 * Math.PI
  );
  magnifyingContext.clip();
  magnifyingContext.drawImage(
    image,
    magnifyingX - magnifyingRadius,
    magnifyingY - magnifyingRadius,
    magnifyingRadius * 2,
    magnifyingRadius * 2,
    0,
    0,
    magnifyingRadius * 2,
    magnifyingRadius * 2
  );
  magnifyingContext.restore();

  // Draw the small red square outline to indicate the pixel being recognized
  magnifyingContext.strokeStyle = "red";
  magnifyingContext.lineWidth = 1;
  magnifyingContext.strokeRect(
    magnifyingRadius - 2,
    magnifyingRadius - 2,
    4,
    4
  );

  // Draw the magnifying glass outline
  magnifyingContext.beginPath();
  magnifyingContext.arc(
    magnifyingRadius,
    magnifyingRadius,
    magnifyingRadius,
    0,
    2 * Math.PI
  );
  magnifyingContext.stroke();

  // Set the position and display the magnifying glass
  magnifyingCanvas.style.left = `${magnifyingX + magnifyingRadius + 10}px`;
  magnifyingCanvas.style.top = `${magnifyingY + magnifyingRadius + 150}px`;
  magnifyingCanvas.style.display = "block";
}
