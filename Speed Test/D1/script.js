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

    var resultsDiv = document.querySelector("#results tbody");

    resultsDiv.innerHTML += `
      <tr>
        <td>${i + 1}</td>
        <td>${actual}</td>
        <td>${submitted}</td>
      </tr>
    `;
  }
  document.querySelector("#score").textContent = `${score}/${numRows}`;
}
