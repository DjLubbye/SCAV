let tblPermiso;
document.addEventListener(
  "DOMContentLoaded",
  function () {
    tblPermiso = new DataTable("tblPermiso", {

      // ocultar columnas
      columnDefs: [
        {
          targets: [0],
          visible: true,
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