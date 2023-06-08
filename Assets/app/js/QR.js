
// eliminar
function eliminar(element) {
    let id = element.dataset.id;
    let clave_vehiculo = element.dataset.clave_vehiculo;

    var n = new Noty({
      text: "Esta seguro de eliminar la informacion de este Acceso Vehicular?",
      type: "error",
      theme: "bootstrap-v4",
      buttons: [
        Noty.button('SI', 'btn btn-info', async function () {
          // console.log("borrar");
  
          const datos = new FormData();
  
          datos.append("id", id);
          datos.append("clave_vehiculo", clave_vehiculo);
  
          try {
            const url = `${base_url}/QR/destroy`;
            const respuesta = await fetch(url, {
              method: "POST",
              body: datos,
            });
            const resultado = await respuesta.json();
  
            if (resultado) {
              //console.log(resultado);
              new Noty({
                type: "error",
                text: "Eliminando Informacion del Acceso Vehicular",
                layout: "topCenter",
                theme: "metroui",
                timeout: 1500,
              }).show();
              setTimeout(() => {
             window.location.href = `${base_url}/qr`;
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

  
// Registrar Salida
function registrarSalidaVehiculos(element) {
  let id = element.dataset.id;
  let horaSalida = document.getElementById("horatxt").value;


  var n = new Noty({
    text: "Desea registrar la salida de este acceso vehicular ?",
    type: "info",
    theme: "bootstrap-v4",
    buttons: [
      Noty.button('SI', 'btn btn-info', async function () {
         console.log("borrar");

        const datos = new FormData();

        datos.append("id", id);
        datos.append("horatxt", horaSalida);


        try {
          const url = `${base_url}/QR/salida`;
          const respuesta = await fetch(url, {
            method: "POST",
            body: datos,
          });
          const resultado = await respuesta.json();

          if (resultado) {
            console.log(resultado);
            new Noty({
              type: "info",
              text: "Registrando salida de la unidad",
              layout: "topCenter",
              theme: "metroui",
              timeout: 1500,
            }).show();
            setTimeout(() => {
           window.location.href = `${base_url}/qr`;
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

  