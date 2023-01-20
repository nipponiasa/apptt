
        <!-- Line chart -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-fw fa-user"></i>
                    Dealer Verification
                    </h3>
                      <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas "></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                    </div>
              </div>
            <div class="card-body">

            




            @if ($message = Session::get('success'))
                        <div class="alert alert-success  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>  
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <label class="" for="">Signature:</label>
                            <br/>
                            <div id="sig" ></div>
                            <br/>
                          
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                           <button id="clear" class="btn btn-danger">Clear Signature</button>
                        </div>
                        <div class="col-md-3">
                        <button class="btn btn-success">Save</button>
                        </div>
                    </div>























             
                  <!-- /.card-body-->
      </div>
        <!-- /.card -->
  
      </div>
      <!-- /.col -->

































<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>