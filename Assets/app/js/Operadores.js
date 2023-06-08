
// eliminar
function eliminarOperador(element) {
    let idoperador = element.dataset.id;
    let nameOperador = element.dataset.nombre;

    var n = new Noty({
      text: "Esta seguro de eliminar la informacion de este Operador ?",
      type: "error",
      theme: "bootstrap-v4",
      buttons: [
        Noty.button('SI', 'btn btn-info', async function () {
          // console.log("borrar");
  
          const datos = new FormData();
  
          datos.append("id", idoperador);
          datos.append("nombre", nameOperador);
  
          try {
            const url = `${base_url}/Operadores/destroy`;
            const respuesta = await fetch(url, {
              method: "POST",
              body: datos,
            });
            const resultado = await respuesta.json();
  
            if (resultado) {
              //console.log(resultado);
              new Noty({
                type: "info",
                text: "Eliminando Informacion del Operador",
                layout: "topCenter",
                theme: "bootstrap-v4",
                timeout: 1500,
              }).show();
              setTimeout(() => {
             window.location.href = `${base_url}/operadores`;
            }, 1500);
            }
          } catch (error) {
            console.log(error);
          }
  
          n.close();
        }),
  
        Noty.button('NO', 'btn btn-danger', function () {
          // console.log("no se borro");
          n.close();
        }),
      ],
    });
    n.show();
  }
  