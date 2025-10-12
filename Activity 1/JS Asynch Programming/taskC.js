// C. Reject if input is empty, resolve after 7 seconds with greeting


function runTaskC() {
  const input = document.getElementById("userInput").value.trim();
  const output = document.getElementById("output");

  new Promise((resolve, reject) => {
    if (!input) reject("Input is empty.");
    else setTimeout(() => resolve(`Good day, ${input}!`), 7000);
  })
  .then(msg => output.textContent = msg)
  .catch(err => output.textContent = err);
}

