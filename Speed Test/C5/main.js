const colorInput = document.getElementById("color-input");
const colorType = document.querySelector(".color-type");
const hexValue = document.querySelector(".hex-color-value");
const rgbValue = document.querySelector(".rgb-color-value");
const successResult = document.querySelector(".success-result");
const errorResult = document.querySelector(".error-result");

colorInput.addEventListener("input", () => {
  const inputColor = colorInput.value.trim();
  if (/^#(?:[0-9a-fA-F]{3}){1,2}$/.test(inputColor)) {
    colorType.textContent = "HEX";
    hexValue.textContent = inputColor.toUpperCase();
    rgbValue.textContent = hexToRgb(inputColor);
    successResult.style.display = "block";
    errorResult.style.display = "none";
  } else if (/^rgb((\d{1,3}),(\d{1,3}),(\d{1,3}))$/.test(inputColor)) {
    colorType.textContent = "RGB";
    rgbValue.textContent = inputColor;
    hexValue.textContent = rgbToHex(inputColor);
    successResult.style.display = "block";
    errorResult.style.display = "none";
  } else {
    successResult.style.display = "none";
    errorResult.style.display = "block";
  }
});

function hexToRgb(hex) {
  const shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
  hex = hex.replace(shorthandRegex, (m, r, g, b) => {
    return r + r + g + g + b + b;
  });

  const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  const r = parseInt(result[1], 16);
  const g = parseInt(result[2], 16);
  const b = parseInt(result[3], 16);

  return `rgb(${r}, ${g}, ${b})`;
}

function rgbToHex(rgb) {
  const result = /^rgb((\d{1,3}),(\d{1,3}),(\d{1,3}))$/.exec(rgb);
  const r = parseInt(result[1]);
  const g = parseInt(result[2]);
  const b = parseInt(result[3]);

  const hexR = r.toString(16).padStart(2, "0");
  const hexG = g.toString(16).padStart(2, "0");
  const hexB = b.toString(16).padStart(2, "0");

  return `#${hexR}${hexG}${hexB}`;
}
