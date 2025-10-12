// B. Create a Promise that rejects if input is empty,
// and resolves after 5 seconds with a greeting on the DOM

function runTaskB() {
  const input = document.getElementById("userInput").value.trim();
  const output = document.getElementById("output");

  new Promise((resolve, reject) => {
    if (!input) reject("Input is empty.");
    else setTimeout(() => resolve(`Good day, ${input}!`), 5000);
  })
  .then(msg => output.textContent = msg)
  .catch(err => output.textContent = err);
}

