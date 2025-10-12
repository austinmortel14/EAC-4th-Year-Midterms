// D. Reject if input is empty, resolve with uppercase greeting


function runTaskD() {
  const input = document.getElementById("userInput").value.trim();
  const output = document.getElementById("output");

  new Promise((resolve, reject) => {
    input ? resolve(`Good day, ${input.toUpperCase()}!`) : reject("Input is empty.");
  })
  .then(msg => output.textContent = msg)
  .catch(err => output.textContent = err);
}
