
// eliminar
function eliminarVehiculo(element) {
    let idvehiculo = element.dataset.id;
    let nameVehiculo = element.dataset.ecodl;

    var n = new Noty({
      text: "Esta seguro de eliminar este la informacion de este Vehiculo ?",
      type: "error",
      theme: "bootstrap-v4",
      buttons: [
        Noty.button('SI', 'btn btn-info', async function () {
          // console.log("borrar");
  
          const datos = new FormData();
  
          datos.append("id", idvehiculo);
          datos.append("eco_dl", nameVehiculo);
  
          try {
            const url = `${base_url}/Vehiculos/destroy`;
            const respuesta = await fetch(url, {
              method: "POST",
              body: datos,
            });
            const resultado = await respuesta.json();
  
            if (resultado) {
              //console.log(resultado);
              new Noty({
                type: "error",
                text: "Eliminando Informacion Vehicular",
                layout: "topCenter",
                theme: "metroui",
                timeout: 1500,
              }).show();
              setTimeout(() => {
             window.location.href = `${base_url}/vehiculos`;
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
  