function calc_cost()
 {

  var year_val=$("#year").val()
  var month_val=$("#month").val()
  
                         $.get('/current_stock/get_cost_per_cat', {year: year_val, month: month_val}, function (data, textStatus, jqXHR) {
                              //alert($("#issue1 option:selected" ).text());
                              var $bod = $("#bodega");
                              $bod.empty(); // remove old options            
                                           
                                             //alert(JSON.stringify(data.data));
                                              $.each( data.data, function( id, value )
                                                      {
                                                      $("#bodega").append(new Option(value.bodega,value.bodega));
                                                      }
                                                  );
                                                  $("#bodega").append(new Option("All",0));
                                                  $("#bodega").val(0);
                                 
                      }
                                  

                  );


}
