
// eliminar
function eliminarVisita(element) {
    let id= element.dataset.id;
    let namerecep = element.dataset.nombre;

    var n = new Noty({
      text: "Esta seguro de eliminar la informacion de esta Visita ?",
      type: "error",
      layout: "topCenter",
      theme: "bootstrap-v4",
      buttons: [
        Noty.button('SI', 'btn btn-info', async function () {
          // console.log("borrar");
  
          const datos = new FormData();
  
          datos.append("id", id);
          datos.append("nombre", namerecep);
  
          try {
            const url = `${base_url}/recepcion/destroy`;
            const respuesta = await fetch(url, {
              method: "POST",
              body: datos,
            });
            const resultado = await respuesta.json();
  
            if (resultado) {
              //console.log(resultado);
              new Noty({
                type: "info",
                text: "Eliminando Informacion de la Visita",
                layout: "topCenter",
                theme: "bootstrap-v4",
                timeout: 1500,
              }).show();
              setTimeout(() => {
             window.location.href = `${base_url}/recepcion`;
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
  
  // Registrar Salida Visita Recepcion
function registrarSalida(element) {
  let id = element.dataset.id;

  var n = new Noty({
    text: "Esta seguro que desea registrar la salida de esta visita?",
    type: "info",
    theme: "bootstrap-v4",
    buttons: [
      Noty.button('SI', 'btn btn-info', async function () {
         console.log("borrar");

        const datos = new FormData();

        datos.append("id", id);

        try {
          const url = `${base_url}/Recepcion/salida`;
          const respuesta = await fetch(url, {
            method: "POST",
            body: datos,
          });
          const resultado = await respuesta.json();

          if (resultado) {
            console.log(resultado);
            new Noty({
              type: "info",
              text: "Registrando salida del visitante",
              layout: "topCenter",
              theme: "metroui",
              timeout: 1500,
            }).show();
            setTimeout(() => {
           window.location.href = `${base_url}/recepcion`;
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
