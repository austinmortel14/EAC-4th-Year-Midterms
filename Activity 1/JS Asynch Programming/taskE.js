// E. Reject if input is empty or < 5 chars, resolve with uppercase greeting


function runTaskE() {
  const input = document.getElementById("userInput").value.trim();
  const output = document.getElementById("output");

  new Promise((resolve, reject) => {
    if (!input || input.length < 5) reject("Input is empty or too short.");
    else resolve(`Good day, ${input.toUpperCase()}!`);
  })
  .then(msg => output.textContent = msg)
  .catch(err => output.textContent = err);
}
