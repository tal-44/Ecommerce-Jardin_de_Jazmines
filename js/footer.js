function temp() {
    alert("Funcionalidad aun no implementada.");
}

document.addEventListener("DOMContentLoaded", function () {

    console.log("Footer de Jardín de Jazmines cargado");

    // Botón de registro
    const botonRegistro = document.getElementById("registerBtn");
    if (botonRegistro) {
        botonRegistro.addEventListener("click", function(e) {
            temp();
        });
    }

    // Búsqueda
    const botonBuscar = document.getElementById("searchBtn");
    const campoBusqueda = document.getElementById("searchInput");

    function buscar() {
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

    // Buscar con Enter
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

});

console.log("Footer JavaScript cargado - Versión simple");