  <!-- footer content -->
  <footer>
    <div class="pull-right text-gray">
      Dudas o Aclaraciones - Contactanos por medio de esta liga <a href="mailto:osvaldo.bautista@elektra.com.mx><span class=" text-gray">Soporte tecnico</span></a>
    </div>
    <div class="clearfix"></div>
  </footer>
  <!-- /footer content -->
  </div>
  </div>



  <!-- javascripts -->

  <!-- jQuery -->
  <script src="<?= JS ?>/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?= JS ?>/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="<?= JS ?>/fastclick.js"></script>
  <!-- NProgress -->
  <script src="<?= JS ?>/nprogress.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="<?= JS ?>/custom.min.js"></script>

  <!-- plugin alertas -->
  <script src="<?= PLUGINS ?>/noty/noty.min.js"></script>
  <!-- plugin datatable -->
  <script src="<?= JS ?>/datatables.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>


  <!-- Url para JavaScrip-->
  <script>
    const base_url = "<?php echo base_url; ?>";
  </script>
  <!--cargar solo en la pagina page_functions_js personalizados desde el controlador-->
  <script src="<?= ASSETS ?>/app/js/<?= $data['function_js']; ?>"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      var t = $('#table').DataTable({
        aProcessing: true,
        aServerSide: true,
        responsive: true,
        // opciones de lenguaje
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        },

        // ocultar columnas
        columnDefs: [{
          targets: [0],
          visible: false,
          serchable: false,
        }, ],
        // mostrar botones de exportacion

        dom: "lBfrtip",
        buttons: [{
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
          [10, 25, 50, -1],
          [10, 25, 50, "Todos"],
        ],
        iDisplayLength: 10,
        order: [
          [0, "desc"]
        ],
      });
      
      //ordenar todos los campos consecutivamente
      t.on('order.dt search.dt', function() {
          t.column(0, {
            search: 'applied',
            order: 'applied'
          }).nodes().each(
            function(cell, i) {
              cell.innerHTML = i + 1;
            }
          );
        }).draw();
    })
  </script>
  </body>

  </html>