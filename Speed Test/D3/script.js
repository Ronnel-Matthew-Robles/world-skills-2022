const url = "backend.php";

// Get game state from backend
async function getGameState() {
  const response = await fetch(url);
  return response.json();
}

// Make move and update game state in backend
async function makeMove(index) {
  const response = await fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `index=${index}`,
  });
  return response.json();
}

// Reset game state in backend
async function resetGame() {
  const response = await fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "reset=true",
  });
  return response.json();
}

// Initialize game
async function initGame() {
  const gameState = await getGameState();
  updateBoard(gameState.board);
}

// Update board UI
function updateBoard(board) {
  const cells = document.querySelectorAll("td");
  for (let i = 0; i < cells.length; i++) {
    cells[i].textContent = board[i];
  }
}

// Handle click on cell
async function cellClicked(index) {
  const gameState = await makeMove(index);
  updateBoard(gameState.board);
  if (gameState.winner !== null) {
    // Show winner prompt
    document.querySelector("div").textContent = `${gameState.winner} Win!`;
  }
}

// Handle click on reset button
async function resetClicked() {
  const gameState = await resetGame();
  updateBoard(gameState.board);
  // Hide winner prompt
  document.querySelector("div").textContent = "";
}

// Add event listeners
document.addEventListener("DOMContentLoaded", initGame);
document.querySelectorAll("td").forEach((cell, index) => {
  cell.addEventListener("click", () => cellClicked(index));
});
document.querySelector("button").addEventListener("click", resetClicked);
