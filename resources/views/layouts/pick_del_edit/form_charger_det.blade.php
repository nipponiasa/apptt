        <!-- Line chart -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                    <h3 class="card-title">
                      <i class="fa fa-bolt"></i>
                    Lader {{--Charger--}}
                    </h3>
                      <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas "></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                    </div>
              </div>
            <div class="card-body">
                
            
            <div class="row">
                  <div class="col-md-12 ml-3 mb-2">
                                        <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="chargerpresent" role="switch" id="chargerpresent" {{$uii->chargerpresent==1  ? 'checked' : ''}}>
                                                <label class="form-check-label"  for="chargerpresent">Lader aanwezig {{--Charger present--}}</label>
                                        </div>

                    </div>
                </div>
            
            
                            <div class="row">
                                        <div class="col-md-9 mb-2">
                                            <div class="form-group">
                                                  <label for="chargernbr">Ladernummer {{--Charger Number--}}</label>
                                                  <input type="text" class="form-control" id="chargernbr" name="chargernbr" value="{{$uii->chargernbr}}" placeholder="Charger Number">
                                                  <small id="charger_nbrHelp" class="form-text text-muted">Ladernummer {{--Charger Number--}}.</small>
                                            </div>
                                        </div>
                            </div>






                <div class="row">
                  <div class="col-md-12 ml-3 mb-2">
                                        <div class="form-check form-switch">
                                                <input class="form-check-input" name="chargertested" type="checkbox" role="switch" id="chargertested" {{$uii->chargertested==1  ? 'checked' : ''}}>
                                                <label class="form-check-label"  for="chargertested">Lader getest {{--Charger tested--}}</label>
                                        </div>

                    </div>
                </div>


                



             
                  <!-- /.card-body-->
      </div>
        <!-- /.card -->
  
      </div>
      <!-- /.col -->
