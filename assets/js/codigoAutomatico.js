// Obtener elementos del DOM
const inputCodigo = document.getElementById("input-codigo");

// Agregar evento input al input del código
inputCodigo.addEventListener("input", function() {
  const codigo = inputCodigo.value;
  
  // Verificar si el código tiene 13 dígitos y calcular el dígito verificador
  if (codigo.length === 13) {
    // Obtener los primeros 12 dígitos del código
    const primerosDigitos = codigo.substring(0, 12);

    // Multiplicar cada dígito por el factor correspondiente y sumar los resultados
    let suma = 0;
    for (let i = 0; i < 12; i++) {
      suma += parseInt(primerosDigitos.charAt(i)) * [1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3] [i];
    }

    // Calcular el dígito verificador
    const digitoVerificador = 10 - (suma % 10);
    const digitoVerificadorFinal = digitoVerificador < 10 ? digitoVerificador : 0;

    // Agregar el dígito verificador al final del código ingresado por el usuario
    inputCodigo.value = primerosDigitos + digitoVerificadorFinal;
  }
});
