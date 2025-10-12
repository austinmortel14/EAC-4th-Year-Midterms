// A. Create a Promise that rejects if input is empty,
// and resolves with the input, greeting the user on the DOM

function runTaskA() {
  const input = document.getElementById("userInput").value.trim();
  const output = document.getElementById("output");

  new Promise((resolve, reject) => {
    input ? resolve(`Good day, ${input}!`) : reject("Input is empty.");
  })
  .then(msg => output.textContent = msg)
  .catch(err => output.textContent = err);
}

