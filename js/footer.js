function temp() {
    alert("Funcionalidad aun no implementada.");
}

function initFooter() {
    // Evitar inicialización duplicada
    const footerRoot = document.querySelector('.footer-container');
    if (!footerRoot) return;
    if (footerRoot.dataset.jsInitialized === 'true') return;
    footerRoot.dataset.jsInitialized = 'true';

    console.log("js Footer cargado");

    const botonRegistro = document.getElementById("registerBtn");
    if (botonRegistro) {
        botonRegistro.addEventListener("click", function(e) {
            temp();
        });
    }

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

    if (botonBuscar) {
        botonBuscar.addEventListener("click", function (e) {
            buscar();
        });
    }

    if (campoBusqueda) {
        campoBusqueda.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                buscar();
            }
        });
    }

    const enlacesFooter = document.querySelectorAll(".footer-link");
    enlacesFooter.forEach(function(enlace) {
        const href = enlace.getAttribute("href");
        if (href && href.includes("temp.html")) {
            enlace.addEventListener("click", function(e) {
                temp();
            });
        }
    });
}

// Inicializar inmediatamente si el DOM ya está listo, o esperar al evento si no
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFooter);
} else {
    setTimeout(initFooter, 0);
}