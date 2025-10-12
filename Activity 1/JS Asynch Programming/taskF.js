// F. Reject if input is empty or < 5 chars, resolve with reversed greeting


function runTaskF() {
  const input = document.getElementById("userInput").value.trim();
  const output = document.getElementById("output");

  new Promise((resolve, reject) => {
    if (!input || input.length < 5) reject("Input is empty or too short.");
    else {
      const reversed = input.split("").reverse().join("");
      resolve(`Good day, ${reversed}!`);
    }
  })
  .then(msg => output.textContent = msg)
  .catch(err => output.textContent = err);
}
