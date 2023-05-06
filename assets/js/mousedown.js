const inputCodigo = document.getElementById("input-codigo");

let intervalId = null;
let lastValue = null;

inputCodigo.addEventListener("keydown", function(event) {
  const value = event.target.value;
  
  if (lastValue !== value) {
    clearInterval(intervalId);
  }

  intervalId = setInterval(function() {
    inputCodigo.value += value;
  }, 100);

  lastValue = value;
});

inputCodigo.addEventListener("keyup", function(event) {
  clearInterval(intervalId);
  lastValue = null;
});
