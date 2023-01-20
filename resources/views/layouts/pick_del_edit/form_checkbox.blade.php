        <!-- Line chart -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                    <h3 class="card-title">
                      <i class="fa fa-check-double"></i>
                      Controleposten {{--Check Points--}}
                    </h3>
                      <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                    </div>
              </div>
            <div class="card-body">


                <div class="row">
                  <div class="col-md-12 ml-3 mb-2">
                                        <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" name="vehicleworks" id="vehicle_works"   {{$uii->vehicleworks==1  ? 'checked' : ''}}>
                                                <label class="form-check-label" for="vehicleworks">Voertuig is werkend {{--Vehicle works--}}</label>
                                        </div>

                    </div>
                </div>

                <div class="row">
                <div class="col-md-12 ml-3 mb-2">
                                        <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" name="keyspresent" id="keyspresent"  {{$uii->keyspresent==1  ? 'checked' : ''}}>
                                                <label class="form-check-label" for="keyspresent">Sleutels aanwezig {{--Keys present--}}</label>
                                        </div>

                    </div>
                </div>





                <div class="row">
                <div class="col-md-12 ml-3 mb-2">
                                        <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" name="remotepresent" id="remotepresent"  {{$uii->remotepresent==1  ? 'checked' : ''}}>
                                                <label class="form-check-label" for="remotepresent">Afstandsbediening aanwezig {{--Remote present--}}</label>
                                        </div>

                    </div>
                </div>



                <div class="row">
                <div class="col-md-12 ml-3 mb-2">
                                        <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" name="toolkitpresent" id="toolkitpresent" {{$uii->toolkitpresent==1  ? 'checked' : ''}}>
                                                <label class="form-check-label" for="toolkitpresent">Gereedschapsetje aanwezig {{--Toolkit present--}}</label>
                                        </div>

                    </div>
                </div>




                <div class="row">
                <div class="col-md-12 ml-3 mb-2">
                                        <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" name="casespresent" id="casespresent"  {{$uii->casespresent==1  ? 'checked' : ''}}>
                                                <label class="form-check-label" for="casespresent">Koffers aanwezig {{--Cases present--}}</label>
                                        </div>

                    </div>
                </div>



                <div class="row">
                <div class="col-md-12 ml-3 mb-2">
                                        <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" name="mirrorspresent" id="mirrorspresent" {{$uii->mirrorspresent==1  ? 'checked' : ''}}>
                                                <label class="form-check-label" for="mirrorspresent">Spiegels aanwezig {{--Mirrors present--}}</label>
                                        </div>

                    </div>
                </div>
          

                <div class="row">
                <div class="col-md-12 ml-3 mb-2">
                                        <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" name="damage" id="damage" {{$uii->damage==1  ? 'checked' : ''}}>
                                                <label class="form-check-label" for="damage">Schade {{--Damage--}}</label>
                                        </div>

                    </div>
                </div>
          





             
                  <!-- /.card-body-->
      </div>
        <!-- /.card -->
  
      </div>
      <!-- /.col -->
