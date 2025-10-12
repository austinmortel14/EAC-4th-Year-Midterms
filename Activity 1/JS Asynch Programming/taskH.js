// H. Reject if not integer, resolve after 5 seconds with cubed result


function runTaskH() {
  const input = document.getElementById("userInput").value.trim();
  const output = document.getElementById("output");
  const number = parseInt(input);

  new Promise((resolve, reject) => {
    if (isNaN(number)) reject("Input is not a valid integer.");
    else setTimeout(() => resolve(`${number} is ${number ** 3} when cubed`), 5000);
  })
  .then(msg => output.textContent = msg)
  .catch(err => output.textContent = err);
}

