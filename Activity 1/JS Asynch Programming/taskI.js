// I. Reject if not between 1–10, allow 3 failures


let attempts = 0;

function runTaskI() {
  const input = document.getElementById("userInput").value.trim();
  const output = document.getElementById("output");
  const number = parseInt(input);

  new Promise((resolve, reject) => {
    if (number >= 1 && number <= 10) {
      resolve(`Yes ${number} is between 1 and 10`);
    } else {
      attempts++;
      if (attempts >= 3) reject("You already failed three times, so no chances anymore");
      else reject(`Attempt ${attempts}: ${number} is not between 1 and 10`);
    }
  })
  .then(msg => output.textContent = msg)
  .catch(err => output.textContent = err);
}
