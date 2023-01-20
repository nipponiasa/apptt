        <!-- Line chart -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                    <h3 class="card-title">
                      <i class="fa fa-battery-full"></i>
                      Accu
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
                                                <input class="form-check-input" type="checkbox" role="switch" name="batterypresent"   id="batterypresent" {{$uii->batterypresent==1  ? 'checked' : ''}}>
                                                <label class="form-check-label" for="battery_present">Accu aanwezig </label>
                                        </div>

                    </div>
                </div>




                
             <div class="row">

                  <div class="col-md-12 mb-2">
                    <div class="form-group">
                          <label for="batterytype">Type</label>
                          <select id="batterytype" class="form-control" name="batterytype" aria-label="Default select example">
                            <option value="Choose a type.."  {{$uii->batterytype=="Choose a type.."  ? 'selected' : ''}}>Choose a type..</option>
                            <option value="Lead Acid"  {{$uii->batterytype=="Lead Acid"  ? 'selected' : ''}}>Lead Acid</option>
                            <option value="Lithium"  {{$uii->batterytype=="Lithium"  ? 'selected' : ''}}>Lithium</option>
                           </select>
                          <small id="dealer3Help" class="form-text text-muted">Choose a battery type.</small>
                      </div>
                    </div>
                </div>

                        <div class="row">
                                    <div class="col-md-9 mb-2">
                                        <div class="form-group">
                                              <label for="batterynbr">Accunummer(s)</label>
                                              <input type="text" class="form-control" id="batterynbr" name="batterynbr" value="{{$uii->batterynbr}}" placeholder="Accunummer(s)">
                                              <small id="batterynbrHelp" class="form-text text-muted">If more than one separate with commas.</small>
                                        </div>
                                    </div>
                        </div>





             
                  <!-- /.card-body-->
      </div>
        <!-- /.card -->
  
      </div>
      <!-- /.col -->
