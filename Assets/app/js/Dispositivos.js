
// eliminar
function eliminar(element) {
    let idacceso = element.dataset.id;
    let code = element.dataset.codigo_barras;

    var n = new Noty({
      text: "Esta seguro de eliminar la informacion del acceso de este Dispositivo?",
      type: "error",
      theme: "bootstrap-v4",
      buttons: [
        Noty.button('SI', 'btn btn-info', async function () {
          // console.log("borrar");
  
          const datos = new FormData();
  
          datos.append("id", idacceso);
          datos.append("codigo_barras", code);
  
          try {
            const url = `${base_url}/dispositivos/destroy`;
            const respuesta = await fetch(url, {
              method: "POST",
              body: datos,
            });
            const resultado = await respuesta.json();
  
            if (resultado) {
              //console.log(resultado);
              new Noty({
                type: "error",
                text: "Eliminando Informacion del Dispositivo",
                layout: "topCenter",
                theme: "metroui",
                timeout: 1500,
              }).show();
              setTimeout(() => {
             window.location.href = `${base_url}/dispositivos`;
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
function registrarSalidaDispositivo(element) {
  let id = element.dataset.id;
  let horaSalida = document.getElementById("horatxt").value;

  var n = new Noty({
    text: "Desea registrar la salida del Dispositivo ?",
    type: "info",
    theme: "bootstrap-v4",
    buttons: [
      Noty.button('SI', 'btn btn-info', async function () {
        console.log("borrar");

        const datos = new FormData();

        datos.append("id", id);
        datos.append("horatxt", horaSalida);

        try {
          const url = `${base_url}/dispositivos/salida`;
          const respuesta = await fetch(url, {
            method: "POST",
            body: datos,
          });
          const resultado = await respuesta.json();

          if (resultado) {
            console.log(resultado);
            new Noty({
              type: "info",
              text: "Registrando salida de las instalaciones del dispositivo",
              layout: "topCenter",
              theme: "metroui",
              timeout: 1500,
            }).show();
            setTimeout(() => {
              window.location.href = `${base_url}/dispositivos`;
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
