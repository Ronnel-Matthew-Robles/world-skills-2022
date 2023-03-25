const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");

// Create an array of ball objects
const balls = [];

// Define the number of balls to be generated
const numBalls = 20;

// Define the maximum radius of the balls
const maxRadius = 50;

// Define the colors of the balls
const colors = ["#FF6F61", "#6B5B95", "#88B04B", "#F7CAC9"];

// Define a function to generate a random number within a range
function getRandomNumber(min, max) {
  return Math.random() * (max - min) + min;
}

// Define a Ball class
class Ball {
  constructor(x, y, radius, color) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.color = color;
    this.alpha = 1;
  }

  // Define a method to draw the ball
  draw() {
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
    ctx.fillStyle = this.color;
    ctx.globalAlpha = this.alpha;
    ctx.fill();
    ctx.closePath();
  }

  // Define a method to update the ball's position and alpha value
  update() {
    this.y -= 2;
    this.alpha -= 0.02;

    if (this.alpha < 0) {
      this.alpha = 0;
    }
  }

  // Define a method to check if the ball is still visible
  isVisible() {
    return this.alpha > 0;
  }
}

// Define a function to generate new balls around the mouse position
function generateBalls(x, y) {
  for (let i = 0; i < numBalls; i++) {
    const radius = getRandomNumber(10, maxRadius);
    const color = colors[Math.floor(getRandomNumber(0, colors.length))];
    const ball = new Ball(x, y, radius, color);
    balls.push(ball);
  }
}

// Define an animation loop
function animate() {
  // Clear the canvas
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Update and draw the balls
  balls.forEach((ball) => {
    ball.update();
    ball.draw();
  });

  // Remove the balls that are no longer visible
  balls.filter((ball) => ball.isVisible());

  // Request the next animation frame
  requestAnimationFrame(animate);
}

// Add an event listener to the canvas
canvas.addEventListener("mousemove", (event) => {
  // Get the mouse position
  const x = event.clientX - canvas.offsetLeft;
  const y = event.clientY - canvas.offsetTop;

  // Generate new balls around the mouse position
  generateBalls(x, y);
});

// Start the animation loop
animate();
