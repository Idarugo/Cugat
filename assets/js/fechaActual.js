var fechaActual = new Date().toISOString().split('T')[0];

// Establecer la fecha actual en los campos de fecha
document.getElementById('desde').value = fechaActual;
document.getElementById('hasta').value = fechaActual;