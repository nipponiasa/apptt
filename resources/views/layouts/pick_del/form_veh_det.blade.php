<div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">
                                  <i class="far fa-fw fa-file"></i>
                                  Voertuig gegevens {{-- Vehicle Details --}}
                                </h3>

                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                  </button>
                                </div>
                              </div>

                                      <div class="card-body">
                                          <div class="row">


                                          <div class="col-md-9 mb-2">
                                        <div class="form-group">
                                              <label for="address">VIN</label>
                                              <input type="text" class="form-control shadow-lg bg-secondary" onchange="get_vin_det()" id="vin" name="vin" aria-describedby="vinHelp" placeholder="VIN">
                                              <small id="vinHelp" class="form-text text-muted">{{--Please import the VIN number to get the vehicle details.--}}  Vul hier het Vin nr. in voor de details van het voertuig. </small>
                                        </div>
                                    </div>



                                          </div>

                                          <div class="row">

                                          <div class="col-md-9 mb-2">
                                        <div class="form-group">
                                              <label for="model">Model</label>
                                              <input type="text" class="form-control" id="model" name="model"  aria-describedby="modelHelp" placeholder="Model">
                                              <small id="modelHelp" class="form-text text-muted">Model gegevens opgehaald uit Odoo. {{-- Model details are retrieved from Odoo--}} </small>
                                        </div>
                                    </div>



                                          </div>






                                          <div class="row">

                                          <div class="col-md-9 mb-2">
                                        <div class="form-group">
                                              <label for="modeldet">Model gegevens</label>
                                              <input type="text" class="form-control" id="modeldet" name="modeldet" style="background-color:#ffa50085;" aria-describedby="modeldetHelp" placeholder="">
                                              <small id="modeldetHelp" class="form-text text-muted">Model gegevens beschreven door dealer. {{--Model details as described by the creator.--}}</small>
                                        </div>
                                    </div>



                                          </div>




                                          <div class="row">
                                    <div class="col-md-9 mb-2">
                                        <div class="form-group">
                                              <label for="notesint">Interne notities {{-- Internal notes --}}</label>
                                                  <textarea id="notesint" name="notesint"  class="form-control"style="background-color:#ffa50085;"  aria-describedby="notesintHelp" rows="3"></textarea>
                                              <small id="notesintHelp" class="form-text text-muted">Interne notities over het voertuig. {{-- Internal notes regarding the vehicle--}}</small>
                                        </div>
                                    </div>
                        </div>









                                  <div class="row">


                                  <div class="col-md-5 mb-2">
                                  <div class="form-group">
                                      <label for="address">Kenteken  {{-- License --}}</label>
                                      <input type="text" class="form-control" id="licencenbr" name="licencenbr" aria-describedby="vinHelp" placeholder="Kenteken nmbr.">
                                      <small id="vinHelp" class="form-text text-muted">Kenteken indien afgegeven. {{-- License number if issued.  --}}</small>
                                  </div>
                                  </div>


                                  <div class="col-md-3 ml-4 mt-4">
                                        <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="vinplatematch" name="vinplatematch">
                                                <label class="form-check-label" for="vinplatematch">Typeplaatje overeenstemming {{-- Vinplate match --}}</label>
                                        </div>
                                  </div>












                                  </div>














                                      </div>
                                          <!-- /.card-body-->
                </div>
                    <!-- /.card -->

