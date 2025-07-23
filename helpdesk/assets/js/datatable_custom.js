$(document).ready(function () {
  $("#tab_consulta").DataTable({
    
    dom:
      "<'row mb-3'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row mt-3'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 flex-wrap  justify-content-center 'p>>",
    scrollY: 200,
    buttons: [
      {
        text: "Excel",
        extend: "excel",
        className: "me-3",
      },
      {
        text: "PDF",
        extend: "pdf",
        className: "btn btn-danger",
        orientation: "landscape",
        portrait: "A1",
      },
    ],
    language: {
      lengthMenu: "Mostrar _MENU_ registros por página",
      zeroRecords: "Não encontramos nenhum chamado ❌",
      info: "Páginas _PAGE_ de _PAGES_",
      infoEmpty: "Nenhum registro disponível",
      infoFiltered: "(filtrado de _MAX_ registros)",
      search: "Buscar:",
      paginate: {
        previous: "Anterior",
        next: "Próxima",
      },
    },
  });
});
