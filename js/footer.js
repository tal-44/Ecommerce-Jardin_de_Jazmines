/*
  js/footer.js
  Propósito: manejar la interacción del footer (registro, búsqueda, enlaces internos).
  Dependencias: espera `.footer-container` en el DOM; se carga tras insertar el partial.
  Por terminar o decidir si implementar en la version final
*/

function temp() {
    alert("Funcionalidad aun no implementada.");
}

// Inicializa handlers del footer.
function initFooter() {
    // Comprobación rápida de existencia y estado para evitar dobles enlaces
    const footerRoot = document.querySelector('.footer-container');
    if (!footerRoot) return;
    if (footerRoot.dataset.jsInitialized === 'true') return;
    footerRoot.dataset.jsInitialized = 'true';

    console.log("js Footer cargado");

    // Registro
    const botonRegistro = document.getElementById("registerBtn");
    if (botonRegistro) botonRegistro.addEventListener("click", function () { temp(); });

    // Búsqueda local
    const botonBuscar = document.getElementById("searchBtn");
    const campoBusqueda = document.getElementById("searchInput");

    function buscar() {
        if (!campoBusqueda) return;
        const termino = campoBusqueda.value.trim();

        if (termino === "") {
            alert("Por favor, introduce un término de búsqueda");
            campoBusqueda.focus();
            return;
        }

        alert(`Búsqueda próximamente.\nTérmino: "${termino}"`);
        campoBusqueda.value = "";
    }

    if (botonBuscar) botonBuscar.addEventListener("click", buscar);
    if (campoBusqueda) {
        // revisar: usar 'keypress' puede no capturar todos los casos; considerar 'keydown' o 'submit' del formulario
        campoBusqueda.addEventListener("keypress", function (e) {
            if (e.key === "Enter") buscar();
        });
    }

    // Enlaces internos que apuntan a temp.html
    const enlacesFooter = document.querySelectorAll('.footer-link');
    enlacesFooter.forEach(function (enlace) {
        const href = enlace.getAttribute("href");
        if (href && href.includes("temp.html")) {
            // revisar: basarse en 'includes' es frágil si cambian rutas; preferir clase o data-attribute
            enlace.addEventListener("click", function (e) { temp(); });
        }
    });
}

// Inicializar cuando DOM listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFooter);
} else {
    setTimeout(initFooter, 0);
}