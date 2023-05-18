const tbody_ofertas = document.getElementById("tbody_ofertas");
let posicion = 0;
let renderTablaOfertas = () => {
  while (tbody_ofertas.hasChildNodes()) {
    tbody_ofertas.removeChild(tbody_ofertas.firstChild);
  }
  fetch("http://localhost/cugat/Api/ApiVistaDescuento.php")
    .then((response) => response.json())
    .then((data) => {
        posicion++;
        console.log(posicion);
      if (data.length == 0) {
        const tr = document.createElement("tr");
        const td = document.createElement("td");
        td.textContent = "No Hay Productos en Oferta";
        td.colSpan = "8";
        tr.append(td);
        tbody_ofertas.append(tr);
      } else {
        for (let i = 0; i < data.length; i++) {
          const tr = document.createElement("tr");
          const td_codigo = document.createElement("td");
          const td_nombre = document.createElement("td");
          const td_precio_a = document.createElement("td");
          const td_precio_n = document.createElement("td");
          const td_expiracion = document.createElement("td");

          td_codigo.textContent = data[i].codigo_barra;
          td_nombre.textContent = data[i].nombre;
          td_precio_a.textContent = data[i].precio_antiguo;
          td_precio_n.textContent = data[i].precio_nuevo;
          td_expiracion.textContent = data[i].expiracion;

          tr.append(
            td_codigo,
            td_nombre,
            td_precio_a,
            td_precio_n,
            td_expiracion
          );
          tbody_ofertas.append(tr);
        }
      }
    })
    .catch((error) => console.error(error));
};

renderTablaOfertas();
setInterval(renderTablaOfertas, 30000);