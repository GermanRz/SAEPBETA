document.addEventListener("DOMContentLoaded", function () {
    const rutaJSON = "vistas/recursos/departamentos_ciudades.json";

    fetch(rutaJSON)
        .then(response => {
            if (!response.ok) throw new Error("No se pudo cargar el JSON");
            return response.json();
        })
        .then(data => {
            const pares = [
                { departamento: "departamento", ciudad: "ciudad" },
                { departamento: "updateDepartamento", ciudad: "updateCiudad" }
            ];

            pares.forEach(par => {
                const depSelect = document.getElementById(par.departamento);
                const ciuSelect = document.getElementById(par.ciudad);

                if (!depSelect || !ciuSelect) return; // si alguno no existe, salta

                // Llenar departamentos
                data.forEach(item => {
                    const option = document.createElement("option");
                    option.value = item.departamento;
                    option.textContent = item.departamento;
                    depSelect.appendChild(option);
                });

                // Precargar si hay valores
                const depActual = depSelect.getAttribute("data-value");
                const ciuActual = ciuSelect.getAttribute("data-value");

                if (depActual) {
                    depSelect.value = depActual;

                    const depObj = data.find(item => item.departamento === depActual);
                    if (depObj) {
                        ciuSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                        depObj.ciudades.forEach(ciudad => {
                            const option = document.createElement("option");
                            option.value = ciudad;
                            option.textContent = ciudad;
                            if (ciudad === ciuActual) {
                                option.selected = true;
                            }
                            ciuSelect.appendChild(option);
                        });
                    }
                }

                // Evento al cambiar el departamento
                depSelect.addEventListener("change", function () {
                    const seleccionado = this.value;
                    ciuSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';

                    const depObj = data.find(d => d.departamento === seleccionado);
                    if (depObj) {
                        depObj.ciudades.forEach(ciudad => {
                            const option = document.createElement("option");
                            option.value = ciudad;
                            option.textContent = ciudad;
                            ciuSelect.appendChild(option);
                        });
                    }
                });
            });
        })
        .catch(error => {
            console.error("Error al cargar el JSON:", error);
            alert("No se pudo cargar la lista de departamentos.");
        });
});
