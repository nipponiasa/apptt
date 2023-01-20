$(document).ready(function () {
  // add a text input to year and title
  $('#dealer').each(function () {
      var title = $(this).text();
      $(this).html('<input type="text" style="max-width:150px;"  placeholder="' + title + '" />');
  });

  $('#type').each(function () {
      var title = $(this).text();
      $(this).html('<input type="text" style="max-width:150px;" placeholder="' + title + '" />');
  });


  //$.fn.dataTable.ext.classes.sPageButtonActive = 'button dark_button'; //https://github.com/DataTables/DataTablesSrc/blob/master/js/ext/ext.classes.js#L7
  $.fn.dataTable.ext.classes.sPageButton = 'button primary_button';
  $('#pickdellist').dataTable( {

      initComplete: function () {
          // Apply the search
          this.api()
              .columns()
              .every(function () {
                  var that = this;

                  $('input', this.header()).on('keyup change clear', function () {
                      if (that.search() !== this.value) {
                          that.search(this.value).draw();
                      }
                  });
              });
      },
      
"lengthChange": false,
"ordering": false,
"pageLength": 20,
"responsive": true


    } );




});