  function get_vin_det()
  {
           var vin=$("#vin").val();
           $.get('/forms/del_pick/details_vin', {vin: vin}, function (product_det, textStatus, jqXHR) {
            //alert('vin');
                // console.log(product_det);
                              if(product_det.product_det_return.length===0)
                              {
                                $("#model").val("This VIN does not exist");
                              }
                              else
                              {

                              $("#model").val(product_det.product_det_return[0]['product_id'][1]);
                                
                              }
         
         // remove old options            
          //alert(JSON.stringify(data.data));

                                  
                       }
                                   
 
                   );
 
 
 }




 function get_dealer_add()
 {

 var dealerid=$("#dealerloc").val()
 $("#address").val("");





var dealerid=$("#dealerloc").val()

$.get('/forms/del_pick/dealers_address', {dealerid: dealerid}, function (dealers_add, textStatus, jqXHR) {
  //alert($("#issue1 option:selected" ).text());
  //alert('dealer');
  //console.log(dealers_add.dealers_add_return);

  if(dealers_add.dealers_add_return.length===0)
  {
          $("#address").val("No relevant data.");

  }
  else
  {

  var text=dealers_add.dealers_add_return[0]['contact_address'];
  var text_with_no_breakers=text.replace("\n", " ");
  $("#address").val(text_with_no_breakers);

  }
     
});










}



function get_dealers_locations()
{


var dealerid=$("#dealer").val()
$("#address").val("");
$("#phone").val("");
$("#dealerloc").empty();
$("#maila").val("");
$.get('/forms/del_pick/dealers_locations', {dealerid: dealerid}, function (dealers_loc, textStatus, jqXHR) {
     //alert($("#issue1 option:selected" ).text());
     //alert('dealer');
     //console.log(dealers_loc.dealers_loc_return);
     //alert(JSON.stringify(dealers_loc.dealers_loc_return));


      
      $.each( dealers_loc.dealers_loc_return, function( id, value )
      {
       
        var otext=value['display_name'];
        var ovalue=value['id'];


        $("#dealerloc").append(new Option(otext, ovalue));
  
       });

       
       $("#dealerloc").append(new Option('Choose Location..','0'));
       $("#dealerloc option[value='0']").attr("selected","selected");

        
});



$.get('/forms/del_pick/dealers_address', {dealerid: dealerid}, function (dealers_add, textStatus, jqXHR) {
  //alert($("#issue1 option:selected" ).text());
  //alert('dealer');
  //console.log(dealers_add.dealers_add_return);

  if(dealers_add.dealers_add_return.length===0)
  {
        
          $("#phone").val("No relevant data.");
          $("#maila").val("No relevant data.");
  }
  else
  {

  $("#phone").val(dealers_add.dealers_add_return[0]['phone']);
  $("#maila").val(dealers_add.dealers_add_return[0]['email']);
  }
     
});





}






function validateoptions() {
  var pickingtype=$("#pickingtype").val();
  var operationtype=$("#operationtype").val();
  //alert(operationtype);
  if(pickingtype=="Choose Type..") {
    alert("Please choose type before saving");
    $("#mainform").submit(function(e){
      e.preventDefault();
  });

 }
  else if(operationtype=="Choose Operation..")
 
 {
  alert("Please choose operation before saving");
  $("#mainform").submit(function(e){
    e.preventDefault();
});

 }




  return true;
}







  $("#finalize").click(function() {
    var pickdelid=$("#pickdelid").val();

    //pickdelid
    $('#pickdelform').submit();
    window.location.href="/sendemail/finalize?pickdelid="+pickdelid;

  });



  $("#cancel").click(function() {
    var pickdelid=$("#pickdelid").val();

    //pickdelid
    $('#pickdelform').submit();
    window.location.href="/sendemail/cancel?pickdelid="+pickdelid;

  });



  $("#refused").click(function() {
    var pickdelid=$("#pickdelid").val();
  
    //pickdelid
    $('#pickdelform').submit();
    window.location.href="/sendemail/refused?pickdelid="+pickdelid;

  });


