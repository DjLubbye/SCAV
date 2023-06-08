let tblUsuarios;
document.addEventListener(
  "DOMContentLoaded",
  function () {
    tblUsuarios = new DataTable("#tblUsuarios", {
      aProcessing: true,
      aServerSide: true,
      responsive: true,
      // opciones de lenguaje
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
      },
      // consultar los datos a la api
      ajax: {
        url: `${base_url}/usuarios/all`,
        dataSrc: "",
      },
      // datos desde el servidor
      columns: [
        { data: "id_usuario" },
        { data: "nombre_usuario" },
        { data: "sucursal" },
        { data: "email" },
        { data: "rol" },
        { data: "is_activo" },
        {
          defaultContent:
            "<button type='button' class='editarFnt btn btn-warning btn-xs'><i class='fa fa-edit'></i></button><button type='button' class='eliminarFnt btn btn-danger btn-xs'><i class='fa fa-remove'></i></button>",
        },
      ],
      // ocultar columnas
      columnDefs: [
        {
          targets: [0],
          visible: false,
          serchable: false,
        },
      ],
      // mostrar botones de exportacion

      dom: "lBfrtip",
      buttons: [
        {
          extend: "copyHtml5",
          text: "<i class='fa fa-copy'></i>",
          titleAttr: "Copiar",
          className: "btn btn-info",
        },
        {
          extend: "excelHtml5",
          text: "<i class='fa fa-file-excel-o'></i>",
          titleAttr: "Exportar a Excel",
          className: "btn btn-success",
        },
        {
          extend: "pdfHtml5",
          text: "<i class='fa fa-file-pdf-o'></i>",
          titleAttr: "Exportar a PDF",
          className: "btn btn-danger",
        },

      ],
      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "Todos"],
      ],
      iDisplayLength: 10,
      order: [[0, "desc"]],
    });
  },
  false
);

// EDITAR
$("#tblUsuarios tbody").on("click", "button.editarFnt", async function () {

  let data_tabla = tblUsuarios.row($(this).parents("tr")).data();//traigo los datos de la tabla y con tr le indico la FILA
  console.log(data_tabla);
  let id_usuario = data_tabla.id_usuario;
  window.location.href = `${base_url} /usuarios/editar/${id_usuario}`;
});
// Eliminar
$("#tblUsuarios tbody").on("click", "button.eliminarFnt", async function () {

  let data_tabla = tblUsuarios.row($(this).parents("tr")).data();//traigo los datos de la tabla y con tr le indico la FILA
  //console.log(data_tabla);
  let id_usuario = data_tabla.id_usuario;
  console.log(id_usuario);
  //window.location.href = `${base_url} /usuarios/editar/${id_usuario}`;



  var n = new Noty({
    text: 'Esta seguro de eliminar el usuario seleccionado?',
    type: "error",
    theme: "bootstrap-v4",
    buttons: [
      Noty.button('SI', 'btn btn-info', async function () {

        const datos = new FormData();

        datos.append('id', id_usuario);

        try {
          const url = `${base_url} /Usuarios/destroy`;
          const respuesta = await fetch(url, {
            method: 'POST',
            body: datos,
          });
          const resultado = await respuesta.json();


          if (resultado) {
            //console.log(resultado);
            new Noty({
              type: "success",
              text: `${resultado.msg}`,
              layout: "topRight",
              theme: "mint",
              timeout: 1100,
            }).show();

            setTimeout(() => {
              window.location.href = `${base_url}/usuarios`;
            }, 1500);

          }
        } catch (error) {
          console.log(error);
        }



        n.close();
      },
      ),


      Noty.button('NO', 'btn btn-danger', function () {
        //console.log("no se borro");
        n.close();
      })
    ]
  });
  n.show();
});