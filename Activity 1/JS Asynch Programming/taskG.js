// G. Reject if not integer, resolve with squared result


function runTaskG() {
  const input = document.getElementById("userInput").value.trim();
  const output = document.getElementById("output");
  const number = parseInt(input);

  new Promise((resolve, reject) => {
    if (isNaN(number)) reject("Input is not a valid integer.");
    else resolve(`${number} is ${number ** 2} when doubled`);
  })
  .then(msg => output.textContent = msg)
  .catch(err => output.textContent = err);
}

