<!DOCTYPE html>
 <html>
 <head>
 <title>Moto Stock</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

 
<script>
//js gia to filtro

$(document).ready(function() {
  $('#brantcontainer button').click(function() {
    // fetch the id of the clicked item
    var ourid = $(this).attr('id');
//alert(ourid);
    // reset the active class on all the buttons
    $('#brantcontainer button').removeClass('active');
    // update the active state on our clicked button
    $(this).addClass('active');

    if(ourid == 'all') {
      // show all our items
      $('#mototable tr').show();
    }
    else {
      $('#mototable tr').show();
      // hide all elements that don't share ourClass
      $('#mototable tr').not('.'+ourid).not('.brantcontainerclass').hide();


    }
    return false;
  });
});

//js gia to filtro

</script>

<style>

/* Style the buttons */
.filterbtn {
  border: none;
  outline: none;
  padding: 12px 16px;
  background-color: #f1f1f1;
  cursor: pointer;
}

/* Add a light grey background on mouse-over */
.filterbtn:hover {
  background-color: #ddd;
}

/* Add a dark background to the active button */
.filterbtn.active {
  background-color: #666;
  color: white;
}


</style>


</head>

   <body>
     



 <div class="container">


 <h2 class="text-center">Moto Stock</h2>
     
  <table id="mototable" class="table">
    <thead>
    <tr colspan="2" class="brantcontainerclass">
        <th class="text-center">


  <div id="brantcontainer">
  <button id="all" class="btn filterbtn " > All</button>
  <button id="Nipponia" class="btn filterbtn" > Nipponia</button>
  <button id="Lifan" class="btn filterbtn" > Lifan</button>
  <button id="Doohan" class="btn filterbtn" > Doohan</button>

</div>
        </th>
        <th></th>
        <th></th>
      </tr>






    </thead>

    @php
                                                   
                     foreach($modelscat as $key=>$result) {
                                         $file_path=url('/')."/imagesup/".$key."_200p.jpg";
                                         echo '<tr class='.$result[1].'> <td class="align-middle text-center"><h4>'.$key.'</h4></td><td><img class="img-thumbnail" style="height:120px;" src="'.$file_path.'"></td><td class="align-middle"><a class="btn btn-success" href="odoo_stock?cat_id='.$result[0].'&model_name='.$key.'">Check Availability Status</a></td></tr>';

                                                                   }
                                           
    @endphp


    </tbody>
  </table>
</div>

  

       <footer>
        
      </footer>
  </body>
</html>



