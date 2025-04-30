// Mostrar modal 
function openModal() {
  document.getElementById("infoModal").style.display = "block";
}

// Cerrar modal
function closeModal() {
  document.getElementById("infoModal").style.display = "none";
}

// Cerrar modal si hace click fuera del contenido
window.onclick = function (event) {
  const modal = document.getElementById("infoModal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
// Función para seleccionar el botón y aplicar la clase 'selected' en numero de asegurados
function selectButton(buttonId) {
  // Eliminar la clase 'selected' de todos los botones
  var buttons = document.querySelectorAll(".numero-asegurados button");
  buttons.forEach(function (button) {
    button.classList.remove("selected");
  });

  // Añadir la clase 'selected' al botón clicado
  var selectedButton = document.getElementById("btn_" + buttonId);
  selectedButton.classList.add("selected");
}

function selectDoc(tipo) {
  const tipoDocInput = document.getElementById('tipo_documento');
  const numeroDocInput = document.getElementById('numero_documento');
  const btnNIF = document.getElementById('btnNIF');
  const btnNIE = document.getElementById('btnNIE');
  const btnAceptar = document.getElementById('btnAceptar');

  tipoDocInput.value = tipo;
  btnNIF.classList.remove('active');
  btnNIE.classList.remove('active');

  if (tipo === 'NIF') {
      btnNIF.classList.add('active');
      numeroDocInput.placeholder = "12345678A"; // Cambiar placeholder NIF
  } else if (tipo === 'NIE') {
      btnNIE.classList.add('active');
      numeroDocInput.placeholder = "X1234567T"; // Cambiar placeholder NIE
  }

  // Limpiar el campo y desactivar el botón Aceptar
  numeroDocInput.value = "";
  btnAceptar.classList.add('disabled');
  btnAceptar.disabled = true;
}

document.getElementById('numero_documento').addEventListener('input', function() {
  const btnAceptar = document.getElementById('btnAceptar');
  if (this.value.trim().length > 0) {
      btnAceptar.classList.remove('disabled');
      btnAceptar.disabled = false;
  } else {
      btnAceptar.classList.add('disabled');
      btnAceptar.disabled = true;
  }
});
document.addEventListener('DOMContentLoaded', function () {
  selectDoc('NIF');

  const numeroDocInput = document.getElementById('numero_documento');
  const btnAceptar = document.getElementById('btnAceptar');

  if (numeroDocInput && btnAceptar) {
    numeroDocInput.addEventListener('input', function () {
      if (this.value.trim().length > 0) {
        btnAceptar.classList.remove('disabled');
        btnAceptar.disabled = false;
      } else {
        btnAceptar.classList.add('disabled');
        btnAceptar.disabled = true;
      }
    });
  }
});




// Inicializar el placeholder por defecto cuando carga la página
window.addEventListener('DOMContentLoaded', function() {
  selectDoc('NIF');
});



//modal resultados.php
function abrirModalInfo(card) {
  const modal = new bootstrap.Modal(document.getElementById('modalInfo'));
  const title = document.getElementById('modalInfoLabel');
  const body = document.getElementById('modalInfoBody');

  if (card === 1) {
    title.innerText = "CUADRO MÉDICO Con copago";
    body.innerText = "Pagando un precio por visita o consulta, puedes elegir entre todos los centros médicos o profesionales que tienen acuerdo con Muvraline.";
  } else if (card === 2) {
    title.innerText = "CUADRO MÉDICO Sin copago";
    body.innerText = "Sin pagar nada por cada visita o consulta, puedes elegir entre todos los centros médicos que tienen acuerdo con Muvraline.";
  } else if (card === 3) {
    title.innerText = "REEMBOLSO";
    body.innerText = "Tienes libre elección de médicos, independientemente de si tienen acuerdo o no con Muvraline. Después te reembolsarán parte.";
  }

  modal.show();
}
//modal hablar con un agente
function abrirModalAgente() {
  const modal = new bootstrap.Modal(document.getElementById('modalAgente'));
  modal.show();
}

function mostrarCliente(opcion) {
  if (opcion === 'si') {
    document.getElementById('form-si').style.display = 'block';
    document.getElementById('form-no').style.display = 'none';
  } else {
    document.getElementById('form-no').style.display = 'block';
    document.getElementById('form-si').style.display = 'none';
  }
}
//ultimos botones resultados.php
function mostrarModificar() {
  document.getElementById('tarjetasResultados').style.display = 'none';
  document.getElementById('modificarDatos').style.display = 'block';
  document.getElementById('comparativa').style.display = 'none';
  document.getElementById('volverResultados').style.display = 'block';
  document.getElementById('modificarDatos').scrollIntoView({ behavior: 'smooth' });
}

function mostrarComparativa() {
  document.getElementById('tarjetasResultados').style.display = 'none';
  document.getElementById('comparativa').style.display = 'block';
  document.getElementById('modificarDatos').style.display = 'none';
  document.getElementById('volverResultados').style.display = 'block';
  document.getElementById('comparativa').scrollIntoView({ behavior: 'smooth' });
}

function volverResultados() {
  document.getElementById('tarjetasResultados').style.display = 'block';
  document.getElementById('modificarDatos').style.display = 'none';
  document.getElementById('comparativa').style.display = 'none';
  document.getElementById('volverResultados').style.display = 'none';
  document.getElementById('tarjetasResultados').scrollIntoView({ behavior: 'smooth' });
}
