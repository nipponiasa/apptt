        <!-- Line chart -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                    <h3 class="card-title">
                      <i class="fa fa-battery-full"></i>
                      Accu {{--Battery--}}
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
                                                <input class="form-check-input" type="checkbox" role="switch" name="batterypresent"   id="batterypresent">
                                                <label class="form-check-label" for="battery_present">Accu aanwezig {{--Battery present--}}</label>
                                        </div>

                    </div>
                </div>




                
             <div class="row">

                  <div class="col-md-12 mb-2">
                    <div class="form-group">
                          <label for="batterytype">Type</label>
                          <select id="batterytype" class="form-control" name="batterytype" aria-label="Default select example">
                            <option selected>Selecteer een type..</option>
                            <option value="Lead Acid">Lood-zuur {{--Lead Acid--}}</option>
                            <option value="Lithium">Lithium</option>
                           </select>
                          <small id="dealer3Help" class="form-text text-muted">Kies een accu type. {{--Choose a battery type.--}}</small>
                      </div>
                    </div>
                </div>

                        <div class="row">
                                    <div class="col-md-9 mb-2">
                                        <div class="form-group">
                                              <label for="batterynbr">Accunummer(s) {{--Battery Number(s)--}}</label>
                                              <input type="text" class="form-control" id="batterynbr" name="batterynbr" placeholder="Accunummer(s)">
                                              <small id="batterynbrHelp" class="form-text text-muted">indien meer dan één scheiden met komma's {{--If more than one separate with commas.--}}</small>
                                        </div>
                                    </div>
                        </div>





             
                  <!-- /.card-body-->
      </div>
        <!-- /.card -->
  
      </div>
      <!-- /.col -->
