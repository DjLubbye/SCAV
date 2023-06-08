
// eliminar
function eliminarSucursal(element) {
  let idSucursal = element.dataset.id;
  let nameSucursal = element.dataset.nombre;

  var n = new Noty({
    text: "Esta seguro de eliminar este la informacion de esta Sucursal ?",nameSucursal,
    type: "error",
    theme: "bootstrap-v4",
    buttons: [
      Noty.button('SI', 'btn btn-info', async function () {
        // console.log("borrar");

        const datos = new FormData();

        datos.append("id", idSucursal);
        datos.append("nombre", nameSucursal);

        try {
          const url = `${base_url}/Sucursal/destroy`;
          const respuesta = await fetch(url, {
            method: "POST",
            body: datos,
          });
          const resultado = await respuesta.json();

          if (resultado) {
            console.log(resultado);
            new Noty({
              type: "error",
              text: "Eliminando Informacion de la sucursal",
              layout: "topCenter",
              theme: "metroui",
              timeout: 1500,
            }).show();
            setTimeout(() => {
              window.location.href = `${base_url}/sucursal`;
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