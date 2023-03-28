const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");
const colors = document.querySelectorAll(".color");
const saveJpgButton = document.getElementById("save-jpg");
const savePngButton = document.getElementById("save-png");
let isDrawing = false,
  lastX = 0,
  lastY = 0,
  hue = 0,
  direction = true;

function draw(e) {
  if (!isDrawing) return;
  ctx.strokeStyle = colors[0].style.backgroundColor;
  ctx.lineJoin = ctx.lineCap = "round";
  ctx.lineWidth = 10;
  ctx.beginPath();
  ctx.moveTo(lastX, lastY);
  ctx.lineTo(e.offsetX, e.offsetY);
  ctx.stroke();
  [lastX, lastY] = [e.offsetX, e.offsetY];
}

canvas.addEventListener(
  "mousedown",
  (e) => ((isDrawing = true), ([lastX, lastY] = [e.offsetX, e.offsetY]))
);
canvas.addEventListener("mousemove", draw);
canvas.addEventListener("mouseup", () => (isDrawing = false));
canvas.addEventListener("mouseout", () => (isDrawing = false));

colors.forEach(
  (color) => (
    (color.style.backgroundColor = color.dataset.color),
    color.addEventListener(
      "click",
      () => (
        colors.forEach((c) => c.classList.remove("active")),
        color.classList.add("active")
      )
    )
  )
);

saveJpgButton.addEventListener("click", () =>
  download(canvas.toDataURL("image/jpeg"), "drawing.jpg")
);
savePngButton.addEventListener("click", () =>
  download(canvas.toDataURL("image/png"), "drawing.png")
);

function download(url, filename) {
  const link = document.createElement("a");
  link.href = url;
  link.download = filename;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

function resizeCanvas() {
  if (isDrawing) return;
  canvas.width = canvas.offsetWidth;
  canvas.height = canvas.offsetHeight;
  drawGrid();
}

function drawGrid() {
  ctx.strokeStyle = "#ccc";
  ctx.lineWidth = 1;
  for (let x = 0; x <= canvas.width; x += 10) {
    ctx.beginPath();
    ctx.moveTo(x, 0);
    ctx.lineTo(x, canvas.height);
    ctx.stroke();
  }
  for (let y = 0; y <= canvas.height; y += 10) {
    ctx.beginPath();
    ctx.moveTo(0, y);
    ctx.lineTo(canvas.width, y);
    ctx.stroke();
  }
}

drawGrid();

let dragging = false,
  startX,
  startY,
  startWidth,
  startHeight;

canvas.addEventListener(
  "mousedown",
  (e) =>
    e.target === canvas &&
    ((dragging = true),
    (startX = e.clientX),
    (startY = e.clientY),
    (startWidth = canvas.offsetWidth),
    (startHeight = canvas.offsetHeight))
);
canvas.addEventListener("mouseup", () => (dragging = false));
canvas.addEventListener(
  "mousemove",
  (e) =>
    dragging &&
    ((canvas.style.width = startWidth + e.clientX - startX + "px"),
    (canvas.style.height = startHeight + e.clientY - startY + "px"))
);
