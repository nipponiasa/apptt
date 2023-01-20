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
</head>

   <body>
     
      <div class="container">
  <h2>Availability Status</h2>
  <p></p>  
 









  <div class="card">
  <div class="card-header">
  {{$modelname}}
  </div>

  <img class="card-img-top" style="max-width:40%;display: block;margin-left: auto;margin-right: auto;" src="{{$modelphotopath}}" alt="Card image cap">


  <div class="card-body">
    
 
  @includeWhen(!$debug and $has_speed_version, 'layouts.model_stock_status_table')
  @includeWhen(!$debug and !$has_speed_version, 'layouts.modelns_stock_status_table')
  @includeWhen($debug, 'layouts.model_stock_status_table_check')


  <a style="color:white" href="/odoo_stock?cat_id={{$catid}}&model_name={{$modelname}}&debug=1">Check</a>

  </div>
</div>



</div>

       <footer>
      </footer>
  </body>
</html>

<script>
const parentDocument = window.parent.document;
const parentHeading = parentDocument.getElementById("content-menu");
console.log( parentHeading.textContent); 
</script>