// Load the actual answers and submitted answers from CSV files
// This assumes that the CSV files are in the same directory as the HTML file
fetch("actualAnswers.csv")
  .then((response) => response.text())
  .then((actualAnswers) => {
    fetch("submittedAnswers.csv")
      .then((response) => response.text())
      .then((submittedAnswers) => {
        displayResults(actualAnswers, submittedAnswers);
      });
  });

// Display the results in the table and calculate the score
function displayResults(actualAnswers, submittedAnswers) {
  let actualArray = actualAnswers.split("\n");
  let submittedArray = submittedAnswers.split("\n");
  let score = 0;
  let numRows = Math.max(actualArray.length, submittedArray.length);
  for (let i = 0; i < numRows; i++) {
    let actual = actualArray[i] || "";
    let submitted = submittedArray[i] || "";
    if (actual === submitted) {
      score++;
    }
    let row = document.createElement("tr");
    let numCell = document.createElement("td");
    numCell.textContent = i + 1;
    let actualCell = document.createElement("td");
    actualCell.textContent = actual;
    let submittedCell = document.createElement("td");
    submittedCell.textContent = submitted;
    row.appendChild(numCell);
    row.appendChild(actualCell);
    row.appendChild(submittedCell);
    document.querySelector("#results tbody").appendChild(row);
  }
  document.querySelector("#score").textContent = `${score}/${numRows}`;
}
